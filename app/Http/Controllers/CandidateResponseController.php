<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateResponse;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use App\Models\Pipeline;
use App\Models\Position;
use App\Models\Industry;
use App\Models\User;
use App\Models\Source;
use App\Models\Degree;
use App\Models\Language;
use App\Models\Country;
use App\Models\Cities;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class CandidateResponseController extends Controller
{
    public function allResponses($id,$portal,Request $request){
        $currentUser=Auth::user()->id;
        $currentUser = User::find($currentUser);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers,$currentUser->id);
        $positionsId=Position::whereIn('created_by',$childUsers)->where('is_active',1)->pluck('id')->toArray();
      
        $currentUser=Auth::user()->role;
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $minExp = $request->input('minExp');
        $maxExp = $request->input('maxExp');
        $Min_Current_CTC = $request->input('minCtc');
        $Max_Current_CTC = $request->input('maxCtc');
        $min_Expected_Salary = $request->input('minExpectedCtc');
        $max_Expected_Salary = $request->input('maxExpectedCtc');

        // if (!empty($fromDate) || !empty($toDate) || !empty($minExp) || !empty($maxExp) || !empty($Min_Current_CTC) || !empty($Max_Current_CTC) || !empty($min_Expected_Salary) || !empty($max_Expected_Salary)) {
        //     $candidates = CandidateResponse::with(['candidate' => function ($query) use ($Min_Current_CTC, $Max_Current_CTC, $min_Expected_Salary, $max_Expected_Salary) {
        //         $query->where(function ($query) use ($Min_Current_CTC, $Max_Current_CTC) {
        //             $query->whereBetween('current_salary', [$Min_Current_CTC, $Max_Current_CTC]);
        //         })->orWhere(function ($query) use ($min_Expected_Salary, $max_Expected_Salary) {
        //             $query->whereBetween('expected_salary', [$min_Expected_Salary, $max_Expected_Salary]);
        //         });
        //     }])
        //     ->whereIn('job_id', $positionsId)
        //     ->orderBy('id', 'DESC')
        //     ->where('software_category', Auth::user()->software_category)
        //     ->paginate(30);
        //     // return $candidates;
        //     return view('pages.candidate.candidate_response',compact('candidates','currentUser'));
        // }


        if($portal=="all" && $id == 0){
            
            $candidates=CandidateResponse::with('candidate')->whereIn('job_id',$positionsId)->orderBy('id','DESC')->paginate(30);
            $candidateCount=CandidateResponse::with('candidate')->whereIn('job_id',$positionsId)->orderBy('id','DESC')->count();

            $candidates->each(function ($candidate) {
                if($candidate->publish_to != "shine") {
                    if (!empty($candidate->resume)) {
                        $disk = Storage::disk('s3');
                        $candidate->resume = $disk->temporaryUrl('candidate_resume/' . $candidate->resume, now()->addMinutes(5));
                    }
                }
            });
        }
        else if(!empty($id) && $portal=='all' ){
            $candidates=CandidateResponse::with('candidate')->where('job_id',$id)->orderBy('id','DESC')->paginate(30);
          
            $candidateCount=CandidateResponse::with('candidate')->where('job_id',$id)->orderBy('id','DESC')->count();
            $candidates->each(function ($candidate) {
                if($candidate->publish_to != "shine") {
                    if (!empty($candidate->resume)) {
                        $disk = Storage::disk('s3');
                        $candidate->resume = $disk->temporaryUrl('candidate_resume/' . $candidate->resume, now()->addMinutes(5));
                    }
                }
            });
        }
        else if(!empty($portal) && $id==0){
            $candidates=CandidateResponse::with('candidate')->where('publish_to',$portal)->orderBy('id','DESC')->paginate(30);
            $candidateCount=CandidateResponse::with('candidate')->where('publish_to',$portal)->orderBy('id','DESC')->count();
            $candidates->each(function ($candidate) {
                if($candidate->publish_to != "shine") {
                    if (!empty($candidate->resume)) {
                        $disk = Storage::disk('s3');
                        $candidate->resume = $disk->temporaryUrl('candidate_resume/' . $candidate->resume, now()->addMinutes(5));
                    }
                }
            });
        }
        return view('pages.candidate.candidate_response',compact('candidates','currentUser','candidateCount'));
    }

    public function appliedCandidate($jobId,$portalName){

        $sources=Source::get();
        $degrees=Degree::get();
        $languages=Language::get();
        $industries=Industry::get();
        $countries=Country::get();
        $cities=Cities::get();
        $position=Position::where('id',$jobId)->first();
        return view('pages.candidate.applied_candidate',compact('jobId','portalName','sources','degrees','languages','industries','countries','cities','position'));
    }

    public function candidateFromPortal(Request $request){
        $request->validate([
            "name"=> 'required',
            "contact"=> 'required',
            "email"=>'required',
            "expected_salary"=>'required',]);
            $candidate=new Candidate();
            $candidate->name=$request->name;
            $candidate->mobile=$request->contact;
            $candidate->email=$request->email;
            // $candidate->is_local=$request->nationality;
            $candidate->experience=$request->experience;
            $candidate->current_company=$request->company_name;
            $candidate->current_title=$request->designation;
            $city=Cities::where('id',$request->city)->first();
            $candidate->current_location=$city->name ?? '';
            $candidate->preferred_location=$request->location;
            $country=Country::where('id',$request->country)->first();
            $candidate->country=$country->name ?? '';
            $state=State::where('id',$request->state)->first();
            $candidate->state=$state->name ?? '';
            $candidate->city=$city->name ?? '';
            $candidate->address=$request->address;
            $candidate->pin_code=$request->postel_code;
            $candidate->highest_qualification=$request->education_name;
            $candidate->highest_qualification_type=$request->education_type;$candidate->highest_qualification_year=$request->education_year;
            // to calculate total experience //
            $experienceYear=$request->total_exp_year;
            $experienceMonth=$request->total_exp_month;
            $totalExperience=$experienceYear.'.'.$experienceMonth;
            $candidate->total_experience=$totalExperience;
            //*********************************************//
            $candidate->date_of_birth=$request->date_of_birth;$candidate->is_relocate=$request->relocate;
            $candidate->salary_type=$request->salary_type;

            //current salary save prosess //
            $currentSalaryInLakh=(int)$request->current_salary_lakh;
            $currentSalaryInThousand=(int)$request->current_salary_thousand;
            $result= $currentSalaryInLakh + $currentSalaryInThousand;
            $result=(string)$result;
            $candidate->current_salary=$result;
            //********************************** *//
            $candidate->expected_salary=$request->expected_salary;$candidate->marital_status=$request->marital_status;


            $candidate->industry=$request->industry;
            $language=implode(',',$request->language);
            $candidate->languages=$language;
            $candidate->notice_period=$request->notice_period;
            $candidate->gender=$request->gender;
            $candidate->communication=$request->communication;
            $skills=implode(',',$request->skills);
            $candidate->skills=$skills;
            $candidate->source=$request->source;
            //---------candidate resume save-------------------//
            if($request->hasFile('resume')){
                $filepath = time() . '_' . rand() . '.pdf';
                Storage::disk('s3')->put('candidate_resume/'.$filepath, file_get_contents($request->file('resume')), 'public');
                $candidate->resume_file = $filepath;
            }
            //-----------------------------------------//
            $candidate->last_company=$request->last_company;
            $candidate->last_ctc=$request->last_ctc;
            $candidate->pan_card=$request->pan;
            $candidate->aadhar_card=$request->aadhar;
            $candidate->resume_parser_json=$request->json_row;
            $candidate->save();

            $candidateResponse=new CandidateResponse();
            $candidateResponse->job_id=$request->job_id;
            $candidateResponse->publish_to=$request->portal_name;
            $candidateResponse->user_name=$request->name;
            $candidateResponse->user_email=$request->email;
            $candidateResponse->user_mobile=$request->contact;
            $candidateResponse->resume=$candidate->resume_file;
            $candidateResponse->candidate_id=$candidate->id;
            $candidateResponse->software_category=Auth::user()->software_category??'onrole';
            $candidateResponse->save();
            return back()->with('success',"Job Applied successfully");
    }

    public function getresponseshine(){
    $shines = DB::table('new_shine_job_ids')->orderBy('id', 'desc')->limit(100)->get();
        foreach ($shines as $keys => $x) {
        if (is_numeric($x->job_id)) {

            $shine_job_id = $x->job_id;
            $job_id = $shine_job_id;
            $ch = curl_init();
            $url = "https://recruiter.shine.com/api/v2/job/" . $shine_job_id . "/applications";
            $username = 'HSO';
            $password = 'White@1234';

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Basic " . base64_encode("$username:$password")
            ));

            $responses_json = curl_exec($ch);
            curl_close($ch);
            $responses_shine = json_decode($responses_json);

            if (!isset($responses_shine->details)) {
            if (!empty($responses_shine) && $responses_shine->count > 0) {
                foreach ($responses_shine->results as $key => $value) {
                $Response_candidates = CandidateResponse::where(['user_email' => $value->email, 'job_id' => $job_id, 'publish_to' => 'shine'])->first();
                $candidate=Candidate::where(['email' => $value->email,])->first();
                if ($Response_candidates == "" && $candidate=='') {
                    $Response_candidates = new CandidateResponse();
                    $candidate = new Candidate();
                }

                $Response_candidates->job_id = $x->position_id ?? 0;
                //$Response_candidates->shine_job_id = $shine_job_id;
                $Response_candidates->publish_to = 'shine';
                $Response_candidates->user_name = $value->name;
                $Response_candidates->user_email = $value->email;
                $Response_candidates->user_mobile = $value->phone;
                $Response_candidates->resume = $value->resume;
                $Response_candidates->software_category=Auth::user()->software_category??'onrole';

                if ($Response_candidates->candidate_id != "") {
                    $candidate = Candidate::where('id', $Response_candidates->candidate_id)->first();
                }

                $candidate->name = $value->name;
                $candidate->mobile = $value->phone;
                $candidate->email = $value->email;
                $candidate->current_company = $value->company;
                $candidate->current_location = $value->location;
                $candidate->total_experience = $value->total_work_experience;
                $candidate->industry = $value->industry;
                $candidate->current_title = $value->title;
                $candidate->current_salary = $value->salary;
                if ($value->dob != "NA") {
                    $candidate->date_of_birth = $value->dob;
                }
                $candidate->gender = $value->gender;
                $skills = $value->skills;
                $candidate->skills = implode(",", $skills);
                $candidate->resume_file= $value->resume;
                $preferred_locations = $value->preferred_locations;
                $candidate->preferred_location = implode(",", $preferred_locations);
                $candidate->notice_period = $value->notice_period;
                $candidate->highest_qualification = $value->highest_edulevel;
                $candidate->highest_qualification_type = $value->highest_edufield;
                $candidate->save();
                $Response_candidates->candidate_id = $candidate->id;
                $Response_candidates->save();
                }
            }
            } else {
            echo "job does not exists";
            }
        }
        }
  }

    public function candidateFromHappiest(Request $request){
            $request->validate([
                "name"=> 'required',
                "contact"=> 'required',
                "email"=>'required',
                "expected_salary"=>'required',]);

            try {
                   
              
                $candidate=new Candidate();
                $candidate->name=$request->name;
                $candidate->mobile=$request->contact;
                $candidate->email=$request->email;
                // $candidate->is_local=$request->nationality;
                $candidate->experience=$request->experience;
                $candidate->current_company=$request->company_name;
                $candidate->current_title=$request->designation;
                $city=Cities::where('id',$request->city)->first();
                $candidate->current_location=$city->name ?? '';
                $candidate->preferred_location=$request->location;
                $country=Country::where('id',$request->country)->first();
                $candidate->country=$country->name ?? '';
                $state=State::where('id',$request->state)->first();
                $candidate->state=$state->name ?? '';
                $candidate->city=$city->name ?? '';
                $candidate->address=$request->address;
                $candidate->pin_code=$request->postel_code;
                $candidate->highest_qualification=$request->education_name;
                $candidate->highest_qualification_type=$request->education_type;$candidate->highest_qualification_year=$request->education_year;
                // to calculate total experience //
                $experienceYear=$request->total_exp_year;
                $experienceMonth=$request->total_exp_month;
                $totalExperience=$experienceYear.'.'.$experienceMonth;
                $candidate->total_experience=$totalExperience;
                //*********************************************//
                $candidate->date_of_birth=$request->date_of_birth;$candidate->is_relocate=$request->relocate;
                $candidate->salary_type=$request->salary_type;

                //current salary save prosess //
                $currentSalaryInLakh=(int)$request->current_salary_lakh;
                $currentSalaryInThousand=(int)$request->current_salary_thousand;
                $result= $currentSalaryInLakh + $currentSalaryInThousand;
                $result=(string)$result;
                $candidate->current_salary=$result;
                //********************************** *//
                $candidate->expected_salary=$request->expected_salary;$candidate->marital_status=$request->marital_status;


                $candidate->industry=$request->industry;
                $language=implode(',',$request->language);
                $candidate->languages=$language;
                $candidate->notice_period=$request->notice_period;
                $candidate->gender=$request->gender;
                $candidate->communication=$request->communication;
                $skills=implode(',',$request->skills);
                $candidate->skills=$skills;
                $candidate->source=$request->source;
                //---------candidate resume save-------------------//
                if($request->hasFile('resume')){
                    $filepath = time() . '_' . rand() . '.pdf';
                    Storage::disk('s3')->put('candidate_resume/'.$filepath, file_get_contents($request->file('resume')), 'public');
                    $candidate->resume_file = $filepath;
                }
                //-----------------------------------------//
                $candidate->last_company=$request->last_company;
                $candidate->last_ctc=$request->last_ctc;
                $candidate->pan_card=$request->pan;
                $candidate->aadhar_card=$request->aadhar;
                $candidate->resume_parser_json=$request->json_row;
                $candidate->save();

                $candidateResponse=new CandidateResponse();
                $candidateResponse->job_id=$request->job_id;
                $candidateResponse->publish_to="happiest";
                $candidateResponse->user_name=$request->name;
                $candidateResponse->user_email=$request->email;
                $candidateResponse->user_mobile=$request->contact;
                $candidateResponse->resume=$candidate->resume_file;
                $candidateResponse->candidate_id=$candidate->id;
                $candidateResponse->software_category=Auth::user()->software_category??'onrole';
                $candidateResponse->save();
                return response(["success" => "candidate applied successfully"]);
            } catch (\Exception $e) {
                    return response(["error" => "some error occured "]);
            }
    
    }

}
