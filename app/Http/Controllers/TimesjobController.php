<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateResponse;
use App\Models\JobPostingModel;
use App\Models\Jobs_to_timesjobs;
use App\Models\Portalresponse;
use App\Models\Position;
use App\Models\Times_area_of_specialization;
use App\Models\Times_functional_roles;
use App\Models\Times_graduation_specializations;
use App\Models\Times_post_graduation_specialization;
use Illuminate\Support\Facades\DB;

class TimesjobController extends Controller
{
    public function authenticate()
    {
        //$url= http://staginghire.timesjobs.com
        //$tokenid="aGFwcHlfc3RnOjgyMzUzNzM=";
        $url = $this->getUrl();
        $tokenid="aGFwcHk6ODQ5MDk2NA==&";
        $file=file_get_contents("$url/authenticate.html?tokenId=$tokenid");
        return $file;
    }


     protected function getUrl()
     {
         return "https://hire.timesjobs.com/employer";
     }

     public function times_jobs_text()
     {
         return view('position.timesjobtext');
     }

     public function times_farea()
     {
         $times_fareas = Times_area_of_specialization::where('parentId', request('times_farea_id'))->cursor();

         $times_roles = Times_functional_roles::where('parentId', request('times_farea_id'))->get();

         return view('backend.ajax_forms.times_farea', compact('times_fareas', 'times_roles'));
     }

     public function times_greduation()
     {

         $Times_graduation_specializations = Times_graduation_specializations::where('parentId', request('times_greduation_id'))->cursor();

         return view('backend.ajax_forms.times_graduation_specializations', compact('Times_graduation_specializations'));
     }

     public function times_post_greduation()
     {
         $times_post_greduations = Times_post_graduation_specialization::where('parentId', request('times_post_greduation_id'))->cursor();

         //dd($times_post_greduations);
         return view('backend.ajax_forms.times_post_greduation', compact('times_post_greduations'));
     }

     public function sendTotimesjobs($job_position_id)
     {

         try {

             $job = Position::find($job_position_id);

             $times = Jobs_to_timesjobs::where('job_id', $job_position_id)->first();

             $url = $this->getUrl();
             $tokenid="aGFwcHk6ODQ5MDk2NA==";
             $url = "https://hire.timesjobs.com/employer/atsJobAPI.html?tokenId=aGFwcHk6ODQ5MDk2NA==&";
             $auth=array(
                 "opType"=>"1"
             );
             $authjson= json_encode($auth);

             $location=json_decode($times->times_location);
             $industry= json_decode($times->times_industry) ;
             $farea=json_decode($times->times_farea);
             $post_Graduation=json_decode($times->times_post_graduation_course);
             $greduation_course=json_decode($times->times_graduation_course);
             $times_Graduation_Specialisation =json_decode($times->times_graduation_specialisation);
             $times_areaOfSpec=json_decode($times->times_area_of_spec);

             $times_FaRoles=json_decode($times->times_FaRoles);
             $description =$times->times_job_description;
             $skilset= $job->skill_set;
             $times_job_description = str_replace(array( '\'', '"',',' , ';', '<', '>' ,'&','●',':','-','%','!','@'), ' ', $description);

             $data = [
                 "designation" => $job->position_name,
                 "keySkills" =>  $skilset,
                 "minExp" => $times->times_min_year_exp,
                 "maxExp" => $times->times_max_year_exp,
                 "joblocation" =>  $location,
                 "joblocationOther"=>$times->times_location_others,
                 "currency"=>$times->times_currency,
                 "minSalary"=>$times->times_min_salary_lakh,
                 "maxSalary"=>$times->times_max_salary_lakh,
                 "minSalaryThousand"=>$times->times_min_salary_thousand,
                 "maxSalaryThousand"=>$times->times_max_salary_thousand,
                 "chkShowSalary"=>$times->times_show_salary,
                 "gender"=>"N",
                 "industry"=>  $industry,
                 "industryOther"=>$times->times_industry_others,
                 "funcArea"=> $farea,
                 "funcAreaOther"=>$times->times_farea_others,
                 "areaOfSpec"=> $times_areaOfSpec ?? [],
                 "areaOther"=> "test",
                 "cboFaRoles"=>  $times_FaRoles,
                 "jobDescription"=> $times_job_description,
                 "rdoCourse1"=>$times->times_post_graduation,
                 "rdoCourse2"=>$times->times_graduation,
                 "cboDegree1"=> $post_Graduation,
                 "cboDegree2"=> $greduation_course,
                 "cboSecAreaSpecial"=> $times_Graduation_Specialisation,
                 "cboHighAreaSpecial"=>$times->times_post_graduation_specialisation,
                 "cboDegree1Other"=> "",
                 "cboDegree2Other"=>"",
                 "cboSecAreaSpecialOther"=>"",
                 "cboHighAreaSpecialOther"=>"",
                 "hirngcompName"=> "White Force Outsourcing Pvt Ltd",
                 "hiringCompDetail"=> "White Force Outsourcing Pvt Ltd"
             ];
            //  return $data;

             $data_array= json_encode($data);
            //  return $data_array;
             $atspost = "params=".$data_array."&authJson=".$authjson;


             $authenticate = $this->authenticate();

             $curl = curl_init($url);
             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($curl, CURLOPT_POST, true);
             curl_setopt($curl, CURLOPT_POSTFIELDS, $atspost);

             $response = curl_exec($curl);

             $detail=json_decode($response);

             if($detail->JobId) {
                 $times->response_id = $detail->JobId;
                 $times->save();
                 DB::table("new_times_job_ids")->upsert(
                    [
                        'times_job_id' => $detail->JobId,
                        'position_id' => $job->id,
                    ],
                    ['times_job_id'], // Unique key or keys to check for existing records
                    ['times_job_id' => $detail->JobId, 'position_id' => $job->id] // Values to update if record exists
                );  
             }

             if($detail->statusMsg == "success") {
                 $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();

                 $job_posting->timesjobs = 1;

                 $job_posting->save();
             }


             curl_close($curl);
             $file=file_get_contents("$url/authenticate.html?tokenId=$tokenid");
             $response = new Portalresponse();
             $response->portal = 'timesjob';
             $response->is_success = 1;
             $response->response = 'Job Posted In TimesJob Portal';
             $response->job_id = $job->id;
             $response->save();
             return 1;
         } catch (\Exception $e) {
             $response = new Portalresponse();
             $response->portal = 'timesjob';
             $response->is_success = 0;
             $response->response = $e->getMessage();
             $response->job_id = $job->id;
             $response->save();
             return 0;
         }
     }


     public function sendTotimesjobs_test()
     {
         $job_position_id="3160";
         try {

             $job = Position::find($job_position_id);

             $times = Jobs_to_timesjobs::where('job_id', $job_position_id)->first();
             $url = $this->getUrl();
             $tokenid="aGFwcHk6ODQ5MDk2NA==";
             $url = "https://hire.timesjobs.com/employer/atsJobAPI.html?tokenId=aGFwcHk6ODQ5MDk2NA==&";
             $auth=array(
                 "opType"=>"1"
             );
             $authjson= json_encode($auth);

             $location=json_decode($times->times_location);
             $industry= json_decode($times->times_industry) ;
             $farea=json_decode($times->times_farea);
             $post_Graduation=json_decode($times->times_post_Graduation_Course);
             $greduation_course=json_decode($times->times_Graduation_Course);
             $times_Graduation_Specialisation =json_decode($times->times_Graduation_Specialisation);
             $times_areaOfSpec=json_decode($times->times_areaOfSpec);

             $times_FaRoles=json_decode($times->times_FaRoles);
             if($times_FaRoles == null) {
                 $times_FaRoles = [];
             }
             //  dd($times_FaRoles);
             $description =$times->times_job_description;
             $skilset=implode(",", $job->skillSet);
             $times_job_description = str_replace(array( '\'', '"',',' , ';', '<', '>' ,'&','●',':','-','%'), ' ', $description);

             $data = [
                 "designation" => $job->positionName,
                 "keySkills" =>  $skilset,
                 "minExp" => $times->times_minYearExp,
                 "maxExp" => $times->times_maxYearExp,
                 "joblocation" =>  $location,
                 "joblocationOther"=>$times->times_location_others,
                 "currency"=>$times->times_currency,
                 "minSalary"=>$times->times_min_salary_lakh,
                 "maxSalary"=>$times->times_max_salary_lakh,
                 "minSalaryThousand"=>$times->times_min_salary_thousand,
                 "maxSalaryThousand"=>$times->times_max_salary_thousand,
                 "chkShowSalary"=>$times->times_show_salary,
                 "gender"=>"N",
                 "industry"=>  $industry,
                 "industryOther"=>$times->times_industry_others,
                 "funcArea"=> $farea,
                 "funcAreaOther"=>$times->times_farea_others,
                 "areaOfSpec"=>$times_areaOfSpec,
                 "areaOther"=> "test",
                 "cboFaRoles"=>  $times_FaRoles,
                 "jobDescription"=> $times_job_description,
                 "rdoCourse1"=>$times->times_post_Graduation,
                 "rdoCourse2"=>$times->times_Graduation,
                 "cboDegree1"=> $post_Graduation,
                 "cboDegree2"=> $greduation_course,
                 "cboSecAreaSpecial"=> $times_Graduation_Specialisation,
                 "cboHighAreaSpecial"=>$times->times_post_Graduation_Specialisation,
                 "cboDegree1Other"=> "",
                 "cboDegree2Other"=>"",
                 "cboSecAreaSpecialOther"=>"",
                 "cboHighAreaSpecialOther"=>"",
                 "hirngcompName"=> "White Force Outsourcing Pvt Ltd",
                 "hiringCompDetail"=> "White Force Outsourcing Pvt Ltd"
             ];

             $data_array= json_encode($data);
             //return $data_array;

             $atspost = "params=".$data_array."&authJson=".$authjson;


             $authenticate = $this->authenticate();

             $curl = curl_init($url);
             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($curl, CURLOPT_POST, true);
             curl_setopt($curl, CURLOPT_POSTFIELDS, $atspost);

             $response = curl_exec($curl);
             return $response;
             $detail=json_decode($response);

             $times->response_id = $detail->JobId;

             $times->save();
             if($detail->statusMsg == "success") {

                 $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                 $job_posting->timesjobs = 1;
                 $job_posting->save();
             }


             curl_close($curl);
             $file=file_get_contents("$url/authenticate.html?tokenId=$tokenid");
             return $file;
         } catch (\Throwable $th) {
             dd(' Job is not posted, Exception:  ' . $th);
             return $th;
         }
     }

     public function timesjobCandidateResponse()
     {

         $times = DB::table('new_times_job_ids')->get();
         $all = [];
         foreach ($times as $keys => $x) {

             if(is_numeric($x->times_job_id)) {
                 $times_job_id = $x->times_job_id;
                 
                //  $job_id = $x->times_job_id;
                //  $job = Position::find($times_job_id);
                //  $times = Jobs_to_timesjobs::where('job_id', $times_job_id)->first();

                 $url = $this->getUrl();
                 $tokenid="aGFwcHk6ODQ5MDk2NA==";
                 $url = "http://hire.timesjobs.com/employer/atsJobAPI.html?tokenId=aGFwcHk6ODQ5MDk2NA==&";
                 $auth=array(
                     "opType"=>"4"
                 );

                 $authjson= json_encode($auth);

                 $params= [
                     "jobId" => $times_job_id,
                     "pageNo" => "1",
                     "sortType" => "2"
                 ];
                 $data_array= json_encode($params);
                 $atspost = "params=".$data_array."&authJson=".$authjson;
                 $authenticate = $this->authenticate();
                 $curl = curl_init($url);
                 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                 curl_setopt($curl, CURLOPT_POST, true);
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $atspost);

                 $response = curl_exec($curl);
                 curl_close($curl);
                 $responses_timesjobs=json_decode($response);
                 $all[$keys] = $responses_timesjobs;
                //  if(!empty($responses_timesjobs->applicationList)) {
                //      foreach ($responses_timesjobs->applicationList as $value) {
                //          $Response_candidates = CandidateResponse::where(['user_email' => $value->email,'job_id'=>$job_id,'publish_to'=>'timesjob'])->first();
                //          if(!isset($candidates) || $Response_candidates == "") {
                //              $Response_candidates = new CandidateResponse();
                //              $candidate = new Candidate();
                //          }

                //          $Response_candidates = new CandidateResponse();
                //          $Response_candidates->job_id = $job_id;
                //          $Response_candidates->publish_to = 'timesjob';
                //          $Response_candidates->user_name = $value->name;
                //          $Response_candidates->user_email = $value->email;
                //          $Response_candidates->user_mobile = $value->mobile;
                //          $Response_candidates->save();

                //          if($Response_candidates->candidate_id != "") {
                //              $candidate = Candidate::where('id', $Response_candidates->candidate_id)->first();
                //          }
                //          $candidate->name = $value->name;
                //          $candidate->mobile = $value->mobile;
                //          $candidate->email = $value->email;
                //          $candidate->currentCompany = $value->currEmp;
                //          $candidate->currentLocation = $value->currLoc;
                //          $candidate->totalExperience = $value->exp;
                //          $candidate->experience = $value->exp;
                //          $candidate->industry = $value->designation;
                //          $candidate->currentTitle = $value->title;
                //          $candidate->currentSalary = $value->ctc;
                //          $candidate->skills= $value->skills;
                //          $candidate->highestQualification = $value->postGraduation;
                //          $candidate->save();
                //          $Response_candidates->candidate_id = $candidate->id;
                //          $Response_candidates->save();

                //      }
                //  }

             }
         }
         return $all;
     }
}
