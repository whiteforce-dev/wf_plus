<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Pipeline;
use Auth;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Jobs\RelatedCandidateMailJob;
use App\Models\RelatedCandidateToken;

class RelatedCandidateController extends Controller
{
    public function related_candidate(Request $request,$position_id){
        $position = Position::find($position_id);

        $already_in_pipeline = Pipeline::where('position_id',$position_id)->pluck('candidate_id')->toArray();

        $pattern = implode('|', array_map('preg_quote', explode(',', $position->skill_set)));
        
        $candidates = Candidate::select('id','name','mobile','email','current_company','current_title','current_location','preferred_location','highest_qualification','total_experience','current_salary','expected_salary','industry','skills','last_company','software_category')->where('current_title','like','%'.$position->position_name.'%')->whereNotIn('id',$already_in_pipeline)->orWhere('industry',$position->industry)->whereRaw("skills REGEXP '{$pattern}'")->whereNotIn('id',$already_in_pipeline);
        
        if($request->current_location){
            $candidates = $candidates->where('current_location',$position->locations);
        }

        if($request->pref_location){
            $candidates = $candidates->where('preferred_location',$position->locations);
        }

        if($request->education){
            $candidates = $candidates->where('highest_qualification',$position->edu_qualification);
        }

        if($request->expected_salary){
            $candidates = $candidates->whereBetween('expected_salary',[$position->min_salary,$position->max_salary]);
        }
        
        $candidates = $candidates->get()->toArray();
        
        $searched_candidate = [];
        $all_searched_candidate_ids = [];
        foreach($candidates as $candidate){
            $overall_percentage = $position_percentage = $skills_percentage = $location_percentage = $experience_percentage = 0;
            
            if(!empty($candidate['current_title'])){
                $position_name_arr = changeStringToArray($position->position_name);
                $matched_name_words = count(array_intersect(changeStringToArray($candidate['current_title']),$position_name_arr));
                $position_percentage = round(($matched_name_words / count($position_name_arr)) * 100);
            }

            if(!empty($candidate['skills'])){
                $position_skill_arr = explode(",",$position->skill_set);
                $matched_skill_words = count(array_intersect(explode(',',$candidate['skills']),$position_skill_arr));
                $skills_percentage = round(($matched_skill_words / count($position_skill_arr)) * 100);
                
            }

            if(!empty($candidate['current_location']) && ($candidate['current_location'] == $position->locations)){
                $location_percentage = 50;
            }

            if(!empty($candidate['preferred_location']) && ($candidate['preferred_location'] == $position->locations)){
                $location_percentage = $location_percentage + 50;
            }

            if(!empty($candidate['total_experience']) && ($candidate['total_experience'] >= $position->min_year_exp) && ($candidate['total_experience'] <= $position->max_year_exp)){
                $experience_percentage = 100;
            }

            $overall_percentage = ($position_percentage + $skills_percentage + $location_percentage + $experience_percentage) / 4 ;

            $candidate['position_percentage'] = $position_percentage;
            $candidate['skills_percentage']= $skills_percentage;
            $candidate['location_percentage'] = $location_percentage;
            $candidate['experience_percentage'] = $experience_percentage;
            $candidate['overall_percentage'] = round($overall_percentage);
            if(!empty($request->skill_percentage) && ($candidate['skills_percentage'] < $request->skill_percentage)){
                continue;
            }
            if(!empty($request->overall_percentage) && ($candidate['overall_percentage'] < $request->overall_percentage)){
                continue;
            }
            if(empty($request->overall_percentage) && $candidate['overall_percentage'] < 30){
                continue;
            }
            $searched_candidate[] = $candidate;
            $all_searched_candidate_ids[] = $candidate['id'];
        }
        
        usort($searched_candidate, function ($a, $b) {
            return $b['overall_percentage'] <=> $a['overall_percentage'];
        });
        $total_candidate_count = count($searched_candidate);
        $searched_candidate = $this->paginate($searched_candidate);
        return view('pages.related_candidate.related_candidate',compact('searched_candidate','position','total_candidate_count','request','all_searched_candidate_ids'));
        
    }

    public function paginate($items, $perPage = 25, $page = null){
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
        'path' => Paginator::resolveCurrentPath(),
        'pageName' => 'page',
        ]);
    }

    public function send_related_candidate_mail(Request $request){
        try{
            $selected_candidates_data = !empty($request->selectedCandidate) ? array_unique(explode(',',$request->selectedCandidate)) : [];
            $selected_candidates_percentage = $selected_candidates = [];
            foreach($selected_candidates_data as $candidate){
                $data_array = explode("__",$candidate);
                $selected_candidates_percentage[$data_array[0]] = $data_array[1];
                array_push($selected_candidates,$data_array[0]);
            }
            $mail_date =  date('Y-m-d h:i:s');
            $candidates = Candidate::select('id','name','email')->whereIn('id',$selected_candidates)->get()->toArray();
            $position = Position::select('id','position_name','min_year_exp','max_year_exp','min_salary','max_salary','job_type','skill_set','job_description')->find($request->positionId);
            if(!empty($candidates)){
                foreach($candidates as $candidate){
                    $token = base64_encode($candidate['id'].'_'.$request->positionId.'_'.$mail_date);
                    $from_date = strtotime(date('Y-m-d',strtotime($mail_date)));
                    $expire_date = date('Y-m-d',strtotime(' 15 days',$from_date));
                    $details = [
                        'name' => $candidate['name'],
                        'email' => $candidate['email'],
                        'position_name' => $position->position_name,
                        'exp_range' => $position->min_year_exp. ' To'.$position->max_year_exp.' Years',
                        'salary_range' => $position->min_salary. ' To'.$position->max_salary,
                        'job_type' => $position->job_type,
                        'skillSet' => $position->skill_set,
                        'auth_email' => Auth::user()->email,
                        'auth_name' => Auth::user()->name,
                        'auth_number' => Auth::user()->contact,
                        'job_description' => $position->job_description,
                        'link' => url('prescreening').'?token='.$token,
                        'percentage' => $selected_candidates_percentage[$candidate['id']],
                        'expire_date' => $expire_date
                    ];
                    // RelatedCandidateMailJob::dispatch($details)->delay(now()->addMinutes(70));
                    RelatedCandidateMailJob::dispatch($details);
                    $related_candidate_token = RelatedCandidateToken::where(['candidate_id'=>$candidate['id'],'position_id'=>$request->positionId,'mail_send_by_id'=>Auth::user()->id])->first();
                    if(empty($related_candidate_token)){
                        $related_candidate_token = new RelatedCandidateToken();
                    }
                    $related_candidate_token->token = $token;
                    $related_candidate_token->candidate_id = $candidate['id'];
                    $related_candidate_token->position_id = $request->positionId;
                    $related_candidate_token->mail_send_by_id = Auth::user()->id;
                    $related_candidate_token->expire_date = $expire_date;
                    $related_candidate_token->percentage = $selected_candidates_percentage[$candidate['id']];
                    $related_candidate_token->save();
                }
            }
            return 1;
        } catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function prescreening(Request $request){
        $candidate_data = RelatedCandidateToken::where('token',$request['token'])->with('candidate','sendBy','position:id,position_name')->first();
        if(!empty($candidate_data)){
            $current_date = date('Y-m-d');
            if($candidate_data->expire_date >= $current_date ){
                if(!empty($candidate_data->candidate->gender) && in_array($candidate_data->candidate->gender,['female','FEMALE','Female'])){
                    $candidate_image = url('images/femaleimage.jpg');
                } else {
                    $candidate_image = url('images/maleimage.jpg');
                }
                return view('pages.related_candidate.prescreening.form',compact('candidate_data','candidate_image'));
            } else {
                $message = "This link is expired. You can contact to our executive though mail";
                $mail = $candidate_data->sendBy->email;
                $phone_number = $candidate_data->sendBy->contact;
                return view('pages.related_candidate.prescreening.error_page',compact('message','mail','phone_number'));
            }
        } else {
            $message = "Invalid Request";
            return view('pages.related_candidate.prescreening.error_page',compact('message'));
        }
    }

    public function prescreeningStoreData(Request $request,$id){
        if(empty($id)){
           $message = "Invalid Request";
           return view('pages.related_candidate.prescreening.error_page',compact('message'));
        }
        $candidate_data = RelatedCandidateToken::where('id',$id)->first();
        if(empty($candidate_data)){
            $message = "Candidate Not Found";
            return view('pages.related_candidate.prescreening.error_page',compact('message'));
        }
        $current_date = date('Y-m-d');
        if($candidate_data->expire_date < $current_date ){
            $message = "This link is expired. You can contact to our executive though mail";
            $mail = $candidate_data->sendBy->email;
            $phone_number = $candidate_data->sendBy->contact;
            return view('pages.related_candidate.prescreening.error_page',compact('message','mail','phone_number'));
        }
        $candidate_data->is_interested = $request->is_interested;
        $candidate_data->is_experienced = $request->is_exp;
        $candidate_data->experience_range = $request->exp_year;
        $candidate_data->relocate = $request->relocate;
        $candidate_data->current_ctc = $request->current_ctc;
        $candidate_data->expected_ctc = $request->exp_ctc;
        $candidate_data->revert_date = date('Y-m-d');
        $candidate_data->notice_period = $request->notice_period;
        $candidate_data->changed_email = $request->changed_email;
        $candidate_data->changed_mobile = $request->changed_mobile;
        $candidate_data->save();
        return redirect('prescreening/thank-you');
    }

    public function view_mail_revert($position_id){
        $candidate_data = RelatedCandidateToken::where('position_id',$position_id);
        $total_mail_send_count = $candidate_data->count();
        $candidate_data = $candidate_data->whereNotNull('is_interested')->with('candidate')->paginate(25);
        $total_revert_count = RelatedCandidateToken::where('position_id',$position_id)->whereNotNull('is_interested')->count();
        return view('pages.related_candidate.view_mail_revert',compact('candidate_data','total_revert_count','total_mail_send_count','position_id'));
    }

    public function view_mail_revert_search(Request $request){
        $position_id = $request->position_id;
        $candidate_data = RelatedCandidateToken::where('position_id',$position_id);
        if(!empty($request->is_exp)){
            $candidate_data = $candidate_data->where('is_experienced',$request->is_exp);
        }
        if(!empty($request->exp_range)){
            $candidate_data = $candidate_data->where('experience_range',$request->exp_range);
        }
        if(!empty($request->current_ctc)){
            $candidate_data = $candidate_data->where('current_ctc',$request->current_ctc);
        }
        if(!empty($request->expected_ctc)){
            $candidate_data = $candidate_data->where('expected_ctc',$request->expected_ctc);
        }
        if(!empty($request->notice_period)){
            $candidate_data = $candidate_data->where('notice_period',$request->notice_period);
        }
        if(!empty($request->relocate)){
            $candidate_data = $candidate_data->where('relocate',$request->relocate);
        }
        $candidate_data = $candidate_data->paginate(25);
        
        $total_revert_count = 0;
        $total_mail_send_count = 0;
        return view('pages.related_candidate.view_mail_revert_search',compact('candidate_data','total_revert_count','total_mail_send_count','position_id'));
    }
    
    function compareJsonToTable(){
        $position = Position::find(47);
        $similarityPercentages = [];

        // Retrieve the JSON data from the table and compare with the given JSON
        $query = \DB::table('candidates')
            // ->whereRaw('JSON_CONTAINS(resume_parser_json, ?)', [$position->jd_json])
            ->whereNotNull('resume_parser_json')
            ->select('resume_parser_json')
            ->get();
        foreach ($query as $row) {
            $tableJson = $row->resume_parser_json;
            $similarityPercentage = $this->calculateJsonSimilarity($position->jd_json, $tableJson);
            $similarityPercentages[] = $similarityPercentage;
        }

        return $similarityPercentages;
    }

    function calculateJsonSimilarityOld($json1, $json2)
    {
        $decodedJson1 = json_decode($json1, true);
        $decodedJson2 = json_decode($json2, true);

        $matchingKeys = count(array_intersect_key($decodedJson1, $decodedJson2));
        $totalKeys = count($decodedJson1) + count($decodedJson2);

        $similarityPercentage = ($matchingKeys / $totalKeys) * 100;

        return $similarityPercentage;
    }

    function calculateJsonSimilarity($jsonArray1, $jsonArray2)
    {
        $array1 =  $this->flattenArray(json_decode($jsonArray1, true));
        $array2 =  $this->flattenArray(json_decode($jsonArray2, true));
        $JD = collect($array1);
        $Candidate = collect($array2);
        $count = $JD->intersect($Candidate)->count();
        $percentage = ($count / $JD->count()) * 100;

        return $percentage;
    }
    
    public function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val->$key, $key_array)) {
                $key_array[$i] = $val->$key;
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    function test()
    {
        $jsonArray2 = '{"Skills":["Platforms","Windows/Linux","Python","Web Technologies","HTML","CSS","JavaScript","JQuery","Bootstrap","Material","Django","Django","Rest Framework","Angular","VSCode","Sublime Text","MySQL","Sqlite3","PSQL","Postman"],"Additional_Skills":[],"Education":[{"Level":"Bachelor of Technology(CSE)","term":"2019","percentage":"69.76","college_school":"Unknown"},{"college_school":"ABES Engineering College","term":"2015","percentage":"81","Level":"Unknown"},{"college_school":"Harihar Singh Academy","Level":"Matriculation(CBSE","term":"2013","percentage":"9.4"},{"college_school":"ST. Joseph School","Level":"Unknown","term":"Unknown","percentage":"Unknown"}],"work_experience":[{"Work_Exp_Summary":"I Have 3+ years of professional IT experience in Python & Django. Good Extensive experience in Developing/Handling highly interactive web-based applications, especially using Python & Django. Basic understanding of front-end technologies, such as HTML, CSS, Javascript, and JQuery. Having good knowledge of Object-oriented programming concepts. Familiarity with MySQL/Sqlite3/Postgres databases and their declarative query languages. Proficient understanding of code versioning tools, such as Git and Gitlab. Excellent analytical, problem-solving, and programming skills. Committed, goal-oriented & has the zeal to learn new things & technologies. Possess good problem-solving skills, having the capability to work alone. Ability to learn new technologies and also to deliver outputs within short deadlines","Work_Desgination":"Unknown","Work_Organisation":"Unknown","Work_Duration":"Unknown"},{"Work_Duration":"Aug 2019 - Till Date","Work_Organisation":"VVDN Technologies","Work_Desgination":"Software Developer","Work_Exp_Summary":"Unknown"}],"Interest":[],"Current_designation":[],"Achievements":["Project Details Project 4: Human Resource Management System (HRMS) Technologies/Framework - Python, Django, Postgresql, HTML, CSS, Bootstrap, JQuery, Angularjs, JavaScript Description: The application is developed for the management of employee data and the joining process. It has Talent Acquisition(TA) module for shortlisting candidate profiles and giving offers. OnBoarding module onboards the offered candidate into organization, Employee Salary module for managing salary of the employees. Dashboard for getting reports for different modules . Import module to import bulk data on the tool","Project 3: Nexus Technologies/Framework - Python, Django, Postgresql, Django rest framework,HTML, CSS, JQuery, JavaScript, Bootstrap,Social Auth Description: The application is developed for managing travel, reimbursement and courier requests . Its web and mobile app . Here employee can raise their requests and RM will approve/deny those requests and then the admin will process the raised ticket . Rest API is created for the mobile app","Project 2: VVDN Appraisal Recognition Dashboard (VARD) Technologies/Framework - Python, Django, Mysql,HTML, CSS, JQuery, Angularjs, JavaScript, Bootstrap Description: The application is developed for conducting the appraisal process smoothly . Employees fill the form sharing his/her contribution in the development of the organization, respective reporting manager(RM) reviews against those contributions and give his/her feedback . Dashboard implemented for getting the reports","Project 1: Expense Manager Technologies/Framework - Angular , Django Rest Framework,Mysql,HTML, CSS, JQuery, JavaScript, Bootstrap Description: The application is developed for collecting all the expenses at one place . Users from different departments create expense tickets and are approved/denied by the ticket admin"],"Work_duration_T2":[]}';




        $jsonArray1 = '{"Tools_and_technologies":["python","Django","Flask","SOA","MongoDB","MySQL","Kafka","Rabbit MQ","Hadoop","Python","AWS","AWS","Hadoop","AWS Datawarehouse","Python","AWS","S3","python","Python","Hadoop","DynamoDB"],"Concept":["ecosystem","data collection","APIs","Design","develop","API based architectures","micro-services","Data ETL","Data Quality","Relational DB","Business Intelligence applications","Agile SDLC framework","Deployment","troubleshooting","Healthcare","Product Development ecosystem","design architecture","Educational Qualification","Data Mapping","ETL programming","cloud","analytics","Big Data","File System","Lambda","cloud solutions","warehouse","File System","closure","productivity"],"Role":["Python Developer","Python Developer","Python Developer","Senior Developer"],"Yrs_of_Exp":["4+ Years"],"Education":["Bachelor"],"Domain":["Computer science"],"Certifications":[]}';


        return $this->compareJsonArrays($jsonArray1, $jsonArray2);
    }


    function compareJsonArrays($jsonArray1, $jsonArray2)
    {
        $array1 =  $this->flattenArray(json_decode($jsonArray1, true));
        $array2 =  $this->flattenArray(json_decode($jsonArray2, true));
        $JD = collect($array1);
        $Candidate = collect($array2);
        $count = $JD->intersect($Candidate)->count();
        $jd_count = !empty($JD) ? $JD->count() : 0;
        $percentage = 0;
        if(!empty($jd_count)){
            $percentage = ($count / $JD->count()) * 100;
        }

        return $percentage;
    }


    function flattenArray($array)
    {
        $result = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenArray($value));
            } else {
                $result[] = $value;
            }
        }
        return ($result);
    }
}
