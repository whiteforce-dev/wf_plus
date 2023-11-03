<?php


namespace App\Http\Controllers;
use App\Models\FacebookToken;
use App\Models\Job_to_facebooks;
use App\Models\JobPostingModel;
use App\Models\Jobs_to_google;
use App\Models\JobsToClickIndia;
use App\Models\Jobstonoukri;
use App\Models\Jora;
use App\Models\MonsterPostedJob;
use App\Models\Portalresponse;
use App\Models\Position;
use App\Models\Send_Linkedin_jobs;
use App\Models\Shine;
use App\Models\ShineJobId;
use App\Models\User;
use App\Models\Ziprecruiter;
use App\Utils\AppConstant;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;


class CommonController extends Controller
{
    public function __construct()
    {
        $this->apply_button_url = "http://white-force.com/plus/apply_candidate_form/"; 
    }

    public function sendToClickIndia($job_position_id, $userId)
    {

        try{
            $job = Position::find($job_position_id);
            $click_india = JobsToClickIndia::where('job_id', $job_position_id)->first();
            $user = User::find($userId);
            // URL to send the JSON data to
                    $url = 'https://www.clickindia.com/cron/jobs_business_api.php';
                    $data = [
                        "job_id" => $job->id,
                        "job_title" => $job->position_name,
                        "designation" => $job->position_name,
                        "job_roles" => $job->position_name,
                        "expire_on" => $job->close_date,
                        "vacancies" => $job->openings,
                        "job_type" => $job->job_type,
                        "salary_type" => $job->salary_type,
                        "minimum_salary" => $job->min_salary,
                        "maximum_salary" => $job->max_salary,
                        "fix_salary" => "0",
                        "job_description" => $job->job_description,
                        "company_name" => "White Force",
                        "company_url" => "https://white-force.com/",
                        "company_description" => "Not Disclosed",
                        "company_location" => "Not Disclosed",
                        "apply_button_url" =>  $this->apply_button_url . $job->id . '/clickindia',
                        "skills" => $job->skill_set,
                        "contact_person_name" =>$user->name,
                        "contact_person_mobile" => $user->contact,
                        "contact_person_email" => $user->email,
                        "job_category" => $click_india->job_category_id,
                        "job_city_id" => $click_india->city_id,
                        "job_city_name" => null,
                        "minimum_qualification" => $click_india->minimum_qualification,
                        "minimum_experience" => $click_india->minimum_experience,
                        "required_candidate" => $click_india->required_candidate,
                        "click_india_working_days" => $click_india->working_days,
                        "hiring_process" => $click_india->hiring_process
                    ];
                //    return $data;
                    // Convert the data array to JSON format
                     $jsonData = json_encode($data);
                    // Initialize cURL session
                    $ch = curl_init($url);
    
                    // Set cURL options
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($jsonData),
                    ]);
                  $res = curl_exec($ch);
                    if (!empty($res)) {

                        $click_india->response=$res;
                        $click_india->save();
                        
                        $response = new Portalresponse();
                        $response->is_success = 1;
                        $response->portal = 'clickindia';
                        $response->response = 'Post is shared on clickindia successfully.';
                        $response->job_id = $job->id;
                        $response->save();
                        return 1;
                    }
                    curl_close($ch);           
            }catch(\Exception $e){
                $response = new Portalresponse();
                $response->portal = 'clickindia';
                $response->is_success = 0;
                $response->response = $e->getMessage();
                $response->job_id = $job->id;
                $response->save();
                return 0;
                // return $e->getMessage() ;
            }

    }

   
    public function curl($url, $parameters, $content_type, $post = true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($post) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        }
        curl_setopt($ch, CURLOPT_POST, $post);
        $headers = [];
        $headers[] = "Content-Type: {$content_type}";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        return $result;
    }


    public function sendToLinkedin($job_position_id)
    {
        // $job_position_id='2072';
        
        $job = Position::find($job_position_id);
        $linkedin = Send_Linkedin_jobs::where('job_id', $job_position_id)->first();

        $data = [
            'job_id' => $job->id,
            'job_title' => $job->positionName,
            'designation' => $job->positionName,

            'expire_on' => $job->closeDate,
            'vacancies' => $job->openings,
            'job_type' => $job->jobType,

            'minimum_salary' => $job->minSalary,
            'maximum_salary' => $job->maxSalary,
            'fix_salary' => '',
            // 'job_description' => $linkedin->job_description_linkedin,
            'job_description' => "sdfsadfasdfsafsafsadfsdaf",

        ];
        //echo json_encode($data);

        $company = "White Force Outsourcing Pvt Ltd";
        $postDescription = "
                             Company Name : $company \r\n
                             Job Title : $job->position_name \r\n 
                             Experience : $job->min_year_exp \r\n 
                             Salary : $job->min_salary \r\n 
                             Job Type : $job->job_type \r\n 
                             Person Email : $job->person_email \r\n 
                             Contact No : $job->person_contact  \r\n 
                             Job Description: $job->job_description \r\n 
                             Apply Now: $this->apply_button_url $job->id/linkedin' 
                             ";


        $link = 'https://happiestresume.com/';

        $access_token = 'AQUlG6NBjTvceRlpfn3ZOtnFG-p2EHKHuSyfxU2UB08uX4PBNz-97gdPHNS2buWcqzJKEesoQKxYWF25RNpbAnfzixeXkFGIpyOZTR818Qs_zWA_6-0ovJnJr9Vq1JxYdHKqQ3EIf6GwR6I_7g1tJXRy9lClTs6nJDBlAK_wd0xrYJlMUF9Hh4IY4L76RFs2j6FnyaKt4l0K35taTtd22NcNJxDJ5PSThiBctyHKcXkzIirdUMo6Mdw0VYp3kZj4cGQvCfffuxjdnCpvCJBJq3l6Bhv2kXJ7NY7KrrjWAQIl0fA0YeOe9pmeZJj0FYyRi29gZ2vPWIt7xShUWBsmE0d3bgEKCw';

        $url = "https://api.linkedin.com/v2/me?oauth2_access_token=$access_token";
        $params = [];

        $response = $this->curl($url, http_build_query($params), "application/x-www-form-urlencoded", false);
        // dd($response);
        // die();
        // return $response;
        $personId = json_decode($response)->id;

        $linkedin_id = $personId;
        $body = new \stdClass();
        $body->content = new \stdClass();
        $body->content->contentEntities[0] = new \stdClass();
        $body->text = new \stdClass();
        $body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
        $body->content->contentEntities[0]->entityLocation = $link;
        $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "THUMBNAIL_URL_TO_POST";
        $body->content->title = 'YOUR_POST_TITLE';
        $body->owner = 'urn:li:person:' . $linkedin_id;
        $body->text->text =  $postDescription;
        $body_json = json_encode($body, true);

        try {
            $client = new Client(['base_uri' => 'https://api.linkedin.com']);
            $response = $client->request('POST', '/v2/shares', [
                'headers' => [
                    "Authorization" => "Bearer " . $access_token,
                    "Content-Type"  => "application/json",
                    "x-li-format"   => "json"
                ],
                'body' => $body_json,
            ]);

            if ($response->getStatusCode() !== 201) {
                echo 'Error: ' . $response->getLastBody()->errors[0]->message;
            }

            $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
            $job_posting->linkedin = 1;
            $job_posting->save();
            $response = new Portalresponse();
            $response->is_success = 1;
            $response->portal = 'linkedin';
            $response->response = 'Post is shared on LinkedIn successfully.';
            $response->job_id = $job->id;
            $response->save();
            return 1;
            // echo 'Post is shared on LinkedIn successfully.';
        } catch (\Exception $e) {
            // echo $e->getMessage() . ' for link ' . $link;
            $response = new Portalresponse();
            $response->portal = 'linkedin';
            $response->is_success = 0;
            $response->response = $e->getMessage() . ' for link ' . $link;
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendToShine($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $shine = Shine::where('job_id', $job_position_id)->first();

            $outputArray = [];
            $shineField = explode(",", $shine->study_field_grouping_id);
            $outputArray[] = (int)$shineField[0];
            $shineStudy = explode(",", $shine->study_id);
            $outputArray[] = array_map('intval',$shineStudy);

            $shineCity=explode(",", $shine->city_id);
            $shineFunctional=explode(",", $shine->functional_area_id);

            $ch = curl_init();
            $url = "https://recruiter.shine.com/api/v4/job/";
            $username = 'HSO';
            $password = 'White@1234';

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            // $skils = json_encode($job->skillSet);
            $data = [
                "jobtitle" => $job->position_name,
                "description" => $job->job_description,
                "industry" => (int)$shine->industry_id,
                "minexperience" => (int)$shine->min_experience_id, 
                "maxexperience" => (int)$shine->max_experience_id,  
                "salarymin" => (int)$shine->min_salary_id,
                "combo_flag"=>5,
                "salarymax" => (int)$shine->max_salary_id,
                "location" => array_map('intval', $shineCity),
                "functional_area" => array_map('intval', $shineFunctional),
                "skills" =>  json_encode($job->skill_set),
                "qualification_level_1" => $outputArray,
                'externalapplyurl' =>$this->apply_button_url . $job->id . '/shine',
            ];
            
            $data = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
            ));
            $response = curl_exec($ch);
            // return $response;
            $data = json_decode($response, true);
              if ($data && isset($data['detail'])) {
                  $detailText = $data['detail'];
                  if (preg_match('/(\d+)/', $detailText, $matches)) {
                      $numericValue = (int)$matches[0]; // Corrected index to $matches[1]
                      DB::table("new_shine_job_ids")->insert([
                        'job_id' => $numericValue,
                        'position_id' => $job_position_id,
                    ]);
                  }
              } elseif ($data && isset($data['errors']['combo'][0])) {
                  $errorText = $data['errors']['combo'][0];
                  if (preg_match('/(\d+)/', $errorText, $matches)) {
                      $numericValue = (int)$matches[0]; // Corrected index to $matches[1]
                      $dataToInsertOrUpdate = [
                        'job_id' => $numericValue,
                        'position_id' => $job_position_id,
                    ];
                    DB::table("new_shine_job_ids")->updateOrInsert(['job_id' => $numericValue], $dataToInsertOrUpdate);
                  }
              }
           
            curl_close($ch);
            $response = new Portalresponse();
            $response->portal = 'shine';
            $response->is_success = 1;
            $response->response = 'Job Posted In Shine Portal';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'shine';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendToMonster($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $monster = MonsterPostedJob::where('job_id', $job_position_id)->first();
            $url = 'https://white-force.com/publisher/api/sendToMonster';
            $data = [
                'job_id' => $monster->job_id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' =>  $this->apply_button_url . $monster->job_id . '/monster',
                'skillSet' => $job->skill_set,
                'category_function_id' => $monster->category_function_id,
                'industry_id' => $monster->industry_id,
                'category_role_id' => $monster->category_role_id,
                'monster_education_level_id' => $monster->monster_education_level_id,
                'monster_education_stream_id' => $monster->monster_education_stream_id,
                'locations' => $monster->monster_location_id,
                'minYearExp' => $job->min_year_exp,
                'maxYearExp' => $job->max_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
                // 'level' => $job->level,

            ];
            // return $data;
            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->monster = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'monster';
                $response->is_success = 1;
                $response->response = 'Job Posted In Monster Job Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'monster';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
   
    }



    public function sendToJobisjob($job_id)
    {
        try {
            $job = Position::find($job_id);
            $url = 'https://white-force.com/publisher/api/sendTojobisjob';
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'company_name'  => $job->clientname,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'apply_button_url' =>  $this->apply_button_url . $job->id . '/jobisjob',
                'skillSet' => $job->skill_set,
                'location' => $job->locations,
                'country_name' => $job->countries ?? 'India',
                'postal_code' => $job->postal_code,
                'industry_id' => $job->industry,
                'education_level_id' => $job->edu_qualification,
                'minYearExp' => $job->min_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            echo $response;
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->jobisjob = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'jobIsJob';
                $response->is_success = 1;
                $response->response = 'Job Posted In Job is Job Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'jobIsJob';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendToCareerjet($job_id)
    {
        try {
            $job = Position::find($job_id);
            $url = 'https://white-force.com/publisher/api/sendToCareerjet';

            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' =>  $this->apply_button_url . $job->id . '/Careerjet',
                'skillSet' => $job->skill_set,
                'locations' => $job->locations,
                'minYearExp' => $job->min_year_exp,
                'maxYearExp' => $job->max_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->careerjet = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'careerJet';
                $response->is_success = 1;
                $response->response = 'Job Posted In CareerJet Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'careerJet';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendToPostjobsfree($job_id)
    {
        try {
            $job = Position::find($job_id);

            $url = 'https://white-force.com/publisher/api/sendToPostjobsfree';
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' =>  $this->apply_button_url . $job->id . '/postjobsfree',
                'skillSet' => $job->skill_set,
                'city' => $job->city,
                'state' => $job->states,
                'country' => $job->countries ?? 'India',
                'postal_code' => $job->postal_code,
                'industry_id' => $job->industry,
                'education_level_id' => $job->edu_qualification,
                'minYearExp' => $job->min_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            // return $data;



            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->postjobfree = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'post_job_free';
                $response->is_success = 1;
                $response->response = 'Job Posted In Post Job Free Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'post_job_free';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendTonoukri($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $noukri = Jobstonoukri::where('jobs_id', $job_position_id)->first();
            $url = 'https://white-force.com/publisher/api/sendToNoukri';
            $data = [
                'job_id' => $noukri->jobs_id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'Minimum_Salary' => $noukri->Minimum_Salary,
                'Maximum_Salary' => $noukri->Maximum_Salary,
                'job_description' => $noukri->noukri_job_description,
                'apply_button_url' => $this->apply_button_url . $noukri->jobs_id . '/noukri',
                'skillSet' => $job->skill_set,
                'Industry_Mapping' => $noukri->Industry_Mapping,
                'Functional_Area' => $noukri->Functional_Area,
                'Functional_role' => $noukri->Functional_role,
                'Minimum_Experience' => $noukri->Minimum_Experience,
                'Maximum_Experience' => $noukri->Maximum_Experience,
                'UG_Qualifications' => $noukri->UG_Qualifications,
                'UG_Specializations' => $noukri->UG_Specializations,
                'PG_Qualifications' => $noukri->PG_Qualifications,
                'PG_Specializations' => $noukri->PG_Specializations,
                'noukri_City' => $noukri->noukri_City,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'naukri_job_type' => $noukri->naukri_job_type,
            ];
            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            $res_json = json_encode($response);
            $res_json_real = str_replace('"', "", $res_json);
            if ($res_json_real) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->noukri = 1;
                $job_posting->save();
            }

            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'naukri';
            $response->is_success = 1;
            $response->response = 'Job Posted In Naukri Job Portal';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'naukri';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendtoftp()
    {

        $ch = curl_init();

        $filename = '/home/admin/web/white-force.com/public_html/publisher/feeds/naukri.xml';

        $fp = fopen($filename, 'r');
        $user = 'saisun';
        $pass = 'S@!sun_098';

        $ch = curl_init("sftp://$user:$pass@feeds.naukri.com:2525/.$filename");

        curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_SFTP);

        curl_setopt($ch, CURLOPT_INFILE, $fp);

        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($filename));

        curl_exec($ch);

        $error_no = curl_errno($ch);
        print_r($error_no);
        curl_close($ch);

        if ($error_no == 0) {

            $error = 'File uploaded succesfully.';
        } else {

            $error = 'File upload error.';
        }


        $url = "https://white-force.com/publisher/feeds/test.xml";
        //echo $url;
        $post_string = '
    <?xml version="1.0" encoding="UTF-8"?>
    <rootNode>
    <innerNode>
    </innerNode>
    </rootNode>';


        $header = "POST HTTP/1.0 \r\n";
        $header .= "Content-type: text/xml \r\n";
        $header .= "Content-length: " . strlen($post_string) . " \r\n";
        $header .= "Content-transfer-encoding: text \r\n";
        $header .= "Connection: close \r\n\r\n";
        $header .= $post_string;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);

        $data = curl_exec($ch);
        print_r($data);
        if (curl_errno($ch)) {
            print curl_error($ch);
        } else {

            curl_close($ch);
            return 1;
        }
    }

    public function sendToJora($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $postjobsfrees = Jora::where('job_id', $job_position_id)->first();
            $url = 'https://white-force.com/publisher/api/sendToJora';

            $data = [
                'job_id' => $postjobsfrees->job_id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' => $this->apply_button_url . $postjobsfrees->job_id . '/jora',
                'skillSet' => $job->skill_set,
                'city' => $job->city,
                'state' => $job->states,
                'country' => $job->countries,
                'postal_code' => $job->postal_code,
                'category_function_id' => $postjobsfrees->category_function_id,
                'industry_id' => $postjobsfrees->industry_id,
                'education_level_id' => $postjobsfrees->education_level_id,
                'minYearExp' => $job->min_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            // return $data;
          

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->jora = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'jora';
                $response->is_success = 1;
                $response->response = 'Job Posted In jora Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'jora';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendToCAREERSGLOBAL()
    {

        //$company = Company::first();
        $reference_no = rand();

        $careerglobal = DB::table('careers_global_jobs')
            ->join('positions', 'positions.id', "=", "careers_global_jobs.job_id")

            ->join('global_category_role_mappings', 'careers_global_jobs.globalIndustryrole', "=", "global_category_role_mappings.id")
            ->get();
        $xml = '
<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<jobs>';

        foreach ($careerglobal as $careerglobals) {

            $contact_person_name = isset($careerglobals->contact_person_name) ? $careerglobals->contact_person_name : '';
            $person_contact = isset($careerglobals->person_contact) ? $careerglobals->person_contact : '';
            $person_email = isset($careerglobals->person_email) ? $careerglobals->person_email : '';
            $company_description = isset($careerglobals->company->about) ? $careerglobals->company->about : 'Not Disclosed';
            $xml .= '<job>';
            $xml .= '<company>
            <![CDATA[White Force Outsourcing Pvt Ltd]]>
        </company>';
            $xml .= '<reference>
            <![CDATA[' . $reference_no . ']]>
        </reference>';
            $xml .= '<title>
            <![CDATA[' . $careerglobals->positionName . ']]>
        </title> ';
            $xml .= '<sector>
            <![CDATA[' . $careerglobals->industry_name . ']]>
        </sector> ';
            $xml .= '<profession>
            <![CDATA[' . $careerglobals->role_name . ']]>
        </profession>';
            $xml .= '<url>
            <![CDATA[' . $this->apply_button_url . $careerglobals->job_id . '/careersglobal' . ']]>
        </url> ';
            $xml .= '<country>
            <![CDATA[' . $careerglobals->country . ']]>
        </country> ';
            $xml .= '<state>
            <![CDATA[' . $careerglobals->state . ']]>
        </state> ';
            $xml .= '<city>
            <![CDATA[' . $careerglobals->city . ']]>
        </city> ';
            $xml .= ' <postcode>
            <![CDATA[' . $careerglobals->postal_code . ']]>
        </postcode>';
            $xml .= '<brief_description>
            <![CDATA[' . $careerglobals->job_description . ']]>
        </brief_description> ';
            $xml .= '<description>
            <![CDATA[ <p>' . $careerglobals->job_description . ' </p>]]>
        </description> ';
            $xml .= '<contract_type>
            <![CDATA[' . $careerglobals->jobType . ' ]]>
        </contract_type> ';
            $xml .= '<salary>
            <![CDATA[' . $careerglobals->minSalary . ']]>
        </salary> ';
            $xml .= '<salary_frequency>
            <![CDATA[' . $careerglobals->jobType . ']]>
        </salary_frequency> ';
            $xml .= '<currency>
            <![CDATA[INR]]>
        </currency> ';
            $xml .= '<application_email>
            <![CDATA[' . $person_email . ']]>
        </application_email>';
            $xml .= '<phone>
            <![CDATA[' . $person_contact . ']]>
        </phone>';
            $xml .= '<apply_url>
            <![CDATA[' . $this->apply_button_url . $careerglobals->job_id . '/careersglobal' . ']]>
        </apply_url>';

            $xml .= '</job>';
            $job_posting = JobPostingModel::where('job_id', $careerglobals->job_id)->first();
            $job_posting->careerglobal = 1;
            $job_posting->save();
        }
        $xml .= '</jobs>';

        try {

            $careerglobal_job_file_name = "/home/admin/web/white-force.com/public_html/publisher/careersglobal/careersglobal.xml";

            $myfile = fopen($careerglobal_job_file_name, "w") or die("Unable to open file!");
            fwrite($myfile, $xml);
            fclose($myfile);



            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function sendToJooble($job_position_id, $currency)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://white-force.com/publisher/api/sendToJooble';
            $data = [
                'job_id' => $job_position_id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' => $this->apply_button_url . $job_position_id . '/Jooble',
                'skillSet' => $job->skill_set,
                'country' => $job->country ?? 'India',
                'state' => $job->states,
                'city' => $job->city,
                'currency' => $currency ?? 'r',
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];
            // return $data;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->jooble = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'jooble';
                $response->is_success = 1;
                $response->response = 'Job Posted In Jooble Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'jooble';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendToziprecruiter($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);

            $job_post = Ziprecruiter::where('job_id', $job_position_id)->first();
            $url = 'https://white-force.com/publisher/api/sendToziprecruiter';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'closeDate' => $job->close_date,
                'skillSet' => $job->skill_set,
                'created_at' => $job->created_at,
                'apply_button_url' => $this->apply_button_url . $job->id . '/ziprecruiter',
                'address_address' => $address,
                'jobType' => $job->job_type,
                'experience' => $job_post->experience,
                'education' => $job_post->education,
                'pay_type' => $job_post->pay_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
            ];
            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->message == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->ziprecruiter = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'ziprecruiter';
                $response->is_success = 1;
                $response->response = 'Job Posted In Ziprecruiter Portal';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'ziprecruiter';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }



    public function getPageToken($accessToken, $pageId, $version)
    {
           
        try {
            $client = new Client();
            $url= "https://graph.facebook.com/$version/$pageId/feed";
            try {
                $accounts = $client->get($url, [
                    'query' => [
                        // 'limit' => 3,
                        'fields' => 'id,access_token',
                        'access_token' => $accessToken
                    ]
                ]);
                // return $accounts;
            } catch (\Exception $e) {
                // echo 'Caught exception: ', $e->getMessage(), "\n";
                return false;
            }
            // dd(json_decode($accounts->getBody(),true));
            $statusCode = $accounts->getStatusCode();
            // dd($statusCode);
            $body = json_decode($accounts->getBody(), true);

            if ($statusCode == 200) {
                if (isset($body['data'])) {
                    foreach ($body['data'] as $page) {
                        try {
                            if ($pageId == $page['id']) {
                                return $page['id'];
                            }
                        } catch (\Exception $e) {
                            \Log::error('getPageToken : ', [$e->getMessage()]);
                            continue;
                        }
                    }
                }
                $isNext = false;
                $nextURL = '';
                if (isset($body['paging']['next'])) {
                    $isNext = true;
                    $nextURL = $body['paging']['next'];
                }

                $tries = 0;
                while (true) {
                    try {
                        $nextPage = $client->get($nextURL);

                        if ($nextPage->getStatusCode() == 200) {
                            $body = json_decode($nextPage->getBody(), true);

                            if (isset($body['data'])) {
                                foreach ($body['data'] as $page) {
                                    try {
                                        if ($pageId == $page['id']) {
                                            return $page['id'];
                                        }
                                    } catch (\Exception $e) {
                                        continue;
                                    }
                                }
                            }
                            if (isset($body['paging']['next'])) {
                                $nextURL = $body['paging']['next'];
                            } else {
                                break;
                            }
                        } else {
                            if ($tries == 3) {
                                break;
                            } else {
                                $tries++;
                            }
                        }
                    } catch (\Exception $e) {
                        \Log::error('getPageToken : ', [$e->getMessage()]);
                        if ($tries == 3) {
                            break;
                        } else {
                            $tries++;
                            continue;
                        }
                    }
                }
            }
            return true;
        } catch (\Exception $e) {
            \Log::error('getPageToken : ', [$e->getMessage()]);
            Session::flash('error', $e->getMessage());
            return false;
        }
    }
    public function uploadImage($File, $targetDir = 'post_images', $extention = null)
    {
        try {

            $TargetImage = $targetDir;

            if (!File::exists($TargetImage)) {
                File::makeDirectory($TargetImage, $mode = 0777, true, true);
            }

            $FilePath = '';
            $image = $File;
            if (!empty($image)) {

                $imageName = $extention ? time() . uniqid() . '.' . $extention : time() . uniqid() . '.' . $image->getClientOriginalExtension();

                if ($image->move($TargetImage, $imageName)) {
                    // $FilePath = $TargetImage.'/'.$imageName;

                    return $imageName;
                }
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
    public function facebookShare($postDescription, $postImages, $facebookPages)
    {
        // set_time_limit(1200);
        $facebookToken = FacebookToken::with('facebookPages')->orderBy('id', 'DESC')->first();
        //$facebookToken =
        FacebookToken::with('facebookPages')->where(['status' => 1])->where('expiry_date', '>', date('Y-m-d
H:i:s'))->orderBy('id', 'DESC')->first();
        // dd($facebookToken);
        if ($facebookToken) {
            $version = AppConstant::FACEBOOK_API_VERSION;
            $pageId = AppConstant::FACEBOOK_PAGE_ID;
            $accessToken = AppConstant::FACEBOOK_ACCESS_TOKEN;

            foreach ($facebookPages as $pageId) {
                try {
                    $pageToken = $this->getPageToken($accessToken, $pageId, $version);
                    if ($pageToken != false) {
                        $attached_media = [];
                        if (!empty($postImages)) {
                            $attached_media = $this->facebookPagePhotoUpload($pageId, $pageToken, $postImages);
                        }
                        \Log::info('attached_media: ', $attached_media);
                        if (!empty($attached_media)) {
                            $client = new Client;
                            $feed = $client->post('https://graph.facebook.com/v13.0/' . $pageId . '/feed', [
                                'form_params' => [
                                    'message' => $postDescription,
                                    'attached_media' => $attached_media,
                                    'access_token' => $pageToken
                                ]
                            ]);

                            $body = json_decode($feed->getBody(), true);
                            \Log::info('feed post: ', [$body]);
                        } else {
                            $client = new Client;
                            $feed = $client->post('https://graph.facebook.com/v13.0/' . $pageId . '/feed', [
                                'form_params' => [
                                    'message' => $postDescription,
                                    'access_token' => $pageToken
                                ]
                            ]);
                            $body = json_decode($feed->getBody(), true);
                            \Log::info('feed post: ', [$body]);
                        }
                    }
                } catch (\Exception $e) {
                    \Log::error('facebookShare', [$e->getMessage()]);
                    continue;
                }
            }
        }
    }
    public function sendToFacebookGroup($job_id)
    {
        $version = AppConstant::FACEBOOK_API_VERSION;
        $pageId = AppConstant::FACEBOOK_PAGE_ID;
        // $accessToken = AppConstant::FACEBOOK_ACCESS_TOKEN;
        $accessToken ="EAANAr6rRFUYBOyrzVmzZCs2edyQKWQBhW4xbI24X5LdZApAZBWGbgvONnfphhfe6ELenPDcDK973fkpdM1ppGIZCfwYWF4bR5vuUl5g1KJhsZAqyTdwa5KSIwFCP5X5wokFt9i4BJAiXmKH5TMZCMPXzZB06m9QBO5FWpNzPDfgu1KImvgCJ9pmP4qgPp3EMJg67dVGLCNcRDijeJyMjuFhUBM5gfKrjGX2sZB1HcZBf902gZD";
        if ($accessToken) {
            try {
                $pageToken = $this->getPageToken($accessToken, $pageId, $version);
                if ($pageToken != false) {

                    $Job_to_faecbook = new Job_to_facebooks();
                    $Job_to_faecbook->job_id = $job_id;

                    $Job_to_faecbook->save();
                    $job = Position::find($job_id);

                    $company = "White Force Outsourcing Pvt Ltd";
                    $postDescription = "Company Name : $company \r\n Job Title : $job->positionName \r\n Experience : $job->minYearExp \r\n Salary : $job->minSalary \r\n Job Type : $job->jobType \r\n Person Email : $job->person_email \r\n Contact No : $job->person_contact  \r\n Job Description: $job->job_description \r\n Apply Now: $this->apply_button_url.$job->id/facebook' ";

                    $client = new Client;

                    $feed = $client->post('https://graph.facebook.com/v13.0/' . $pageId . '/feed', [
                        'form_params' => [
                            'message' => $postDescription,
                            'access_token' => $accessToken
                        ]
                    ]);

                    $body = json_decode($feed->getBody(), true);

                    \Log::info('feed post: ', [$body]);

                    $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                    $job_posting->facebook = 1;
                    $job_posting->save();


                    $response = new Portalresponse();
                    $response->portal = 'facebook';
                    $response->is_success = 1;
                    $response->response = 'Job Posted In Facebook Portal';
                    $response->job_id = $job_id;
                    $response->save();
                    // return "response";
                    return 1;
                } else {
                    $response = new Portalresponse();
                    $response->portal = 'facebook';
                    $response->is_success = 0;
                    $response->response = 'Facebook Token Error / Dev Error';
                    $response->job_id = $job_id;
                    $response->save();
                    // return "tokern error";
                    return 1;
                }
            } catch (\Exception $e) {
                $response = new Portalresponse();
                $response->portal = 'facebook';
                $response->is_success = 0;
                $response->response = $e->getMessage();
                $response->job_id = $job_id;
                $response->save();
                // return  $response->response;
                return 1;
            }
        } else {
            $response = new Portalresponse();
            $response->portal = 'facebook';
            $response->is_success = 0;
            $response->response = "Facebook Token Error";
            $response->job_id = $job_id;
            $response->save();
            // return "unknown error";
            return 1;
        }
    }

    public function sendToIndeed($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://white-force.com/publisher/api/sendToIndeed';

            $data = [
                'job_id' => $job_position_id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' => $this->apply_button_url . $job_position_id . '/indeed',
                'skillSet' => $job->skill_set,
                'city_indeed' => $job->city,
                'state_indeed' => $job->states,
                'country_indeed' => $job->countries ?? 'India',
                'postal_code_indeed' => $job->postal_code,
                'industry' => $job->industry,
                'eduQualification' => $job->edu_qualification,
                'minYearExp' => $job->min_year_exp,
                'maxYearExp' => $job->max_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'job_service' => null,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];
            // return $data;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->indeed = 1;
                $job_posting->save();
            }

            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'indeed';
            $response->is_success = 1;
            $response->response = 'Job Posted In Indeed Portal';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'indeed';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendTofile()
    {
        $ch = curl_init();
        $localfile = '/home/admin/web/white-force.com/public_html/onrole/feeds/naukri.xml';

        $fp = fopen($localfile, 'r');
        $user = 'saisun';
        $pass = "S@!sun_098";
        try {

            $ch = curl_init("sftp://feeds.naukri.com:2525/home/saisun/" . $localfile);

            curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass);

            curl_setopt($ch, CURLOPT_UPLOAD, true);

            curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_SFTP);

            curl_setopt($ch, CURLOPT_INFILE, $fp);

            curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));

            curl_setopt($ch, CURLOPT_VERBOSE, true);

            curl_exec($ch);


            $error_no = curl_errno($ch);
            echo $error_no;
            curl_close($ch);

            if ($error_no == 0) {

                $error = 'File uploaded succesfully.';
            } else {

                $error = 'File upload error.';
            }
        } catch (\Exception $e) {

            die($e->getMessage());
        }
    }


    public function SendTogoogle($job_id)
    {
        try {
            $job = Position::find($job_id);
            $google = Jobs_to_google::where('job_id', $job_id)->first();

            $url = "https://happiestresume.com/api/google-job-posting";

            $data = [
                'job_id' => $google->job_id,
                'positionName' => $job->position_name,

                'closeDate' => $job->close_date,

                'job_type' => $job->job_type,

                'minimum_salary' => $job->min_salary,
                'maximum_salary' => $job->max_salary,

                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',

                'apply_button_url' => $this->apply_button_url . $job->job_id . '/google',
                'skillSet' => $job->skill_set,
                'locations' => $job->locations,

                'created_at' => $job->created_at,


                'minYearExp' => $job->min_year_exp,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'employment_type' => $google->employment_type

            ];

           
            // create curl resource
            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($curl);
            $numberC = (int)$response;
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->google = 1;
                $job_posting->save();
            }
            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'google';
            $response->response = 'Job Posted In Google Portal';
            $response->job_id = $job_id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'google';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job_id;
            $response->save();
            return 0;
        }
    }
    public function sendToJobsSwitch()
    {
        //$job_position_id=1716;
        //$job = Position::find($job_position_id);
        $jobs = Position::orderBy('id', 'desc')->take(10)->get();
        // $monster = MonsterPostedJob::where('job_id', $job_position_id)->first();
        foreach ($jobs as $job) {
            $url = 'https://white-force.com/publisher/api/sendToJobsSwitch';


            $data = [
                'job_id' => $job->id,
                'positionName' => $job->positionName,
                'locations' => $job->locations,
                'job_description' => $job->job_description,
                'minYearExp' => $job->minYearExp,
                'maxYearExp' => $job->maxYearExp,
                'minSalary' => $job->minSalary,
                'maxSalary' => $job->maxSalary,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'apply_button_url' => $this->apply_button_url . $job->id . '/jobsSwitch',
                'qualifications' => $job->eduQualification,
                'keyword' => $job->positionName,
                'jobcode' => 'jobsSwitch' . $job->id,


            ];

            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            print_r($response);
            curl_close($curl);
        }
    }

    public function sendtohelper($job_position_id)
    { 
        // return $job_position_id;
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/my_job_helper';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'address_address' => $address,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'closeDate' => $job->close_date,
                'minYearExp' => $job->min_year_exp,
                'job_description' => $job->job_description,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id/my_job_helper",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];
            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->true == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->my_job_helper = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'my_job_helper';
                $response->is_success = 1;
                $response->response = 'Job Posted In My Job Helper Portal';
                $response->job_id = $job_position_id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'my_job_helper';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job_position_id;
            $response->save();
            return 0;
        }
    }
    public function sendTojobvertise($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);

            $url = 'https://happiestresume.com/api/sendTojobvertise';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id/job_vertise",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at

            ];
            // return $data;
            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);



            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->true == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->job_vertise = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'job_vertise';
                $response->is_success = 1;
                $response->response = 'Job Posted In Job Vertise Portal';
                $response->job_id = $job_position_id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'job_vertise';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job_position_id;
            $response->save();
            return 0;
        }
    }
    public function sendtowhatsjob($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/sendtoWhatsjobIndia';
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            // create curl resource
            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($curl);

            $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
            $job_posting->whatsjob = 1;
            $job_posting->save();

            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'whatsjob india';
            $response->is_success = 1;
            $response->response = 'Job Posted Successfully in WhatsJob India';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'whatsjob india';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendtodrjobs($job_id)
    {
        try {
            $job = Position::find($job_id);
            $url = 'https://white-force.com/publisher/api/sendtodrjobs';

            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' => $this->apply_button_url . $job->id . '/drjobs',
                'skillSet' => $job->skill_set,
                'city' => $job->city,
                'state' => $job->states,
                'country' => $job->countries ?? 'India',
                'postal_code' => $job->postal_code,
                'address_address' => $address ?? null,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
                'minYearExp' => $job->min_year_exp,
                'maxYearExp' => $job->max_year_exp,
                'industry' => $job->industry,

            ];
            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($curl);
            $numberC = (int)$response;
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->drjobs = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Drjobs india';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in DrJobs India';
                $response->job_id = $job_id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'DrJobs india';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job_id;
            $response->save();
            return 0;
        }
    }

    public function sendtoadzuna($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/sendtoadzunaIndia';

            $address = "$job->city, $job->states, $job->countries";


            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at

            ];
            // return $data;

            // create curl resource
            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));


            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->true == 1) {

                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->adzuna = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Adzuna india';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Adzuna India Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'Adzuna india';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendtohappiest($job_position_id)
    {

        // $job_position_id="2420";

        $job = Position::find($job_position_id);


        $url = 'https://happiestresume.com/api/sendtohappiestIndia';

        $data = [
            'job_id' => $job->id,
            'positionName' => $job->position_name,
            'job_description' => $job->job_description,
            'country' => $job->countries,
            'state' => $job->states,
            'city' => $job->city,
            'minSalary' => $job->min_salary,
            'maxSalary' => $job->max_salary,
            'skills' => $job->skill_set,
            'minYearExp' => $job->min_year_exp,
            'expire_on' => $job->close_date,
            'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
            'contact_person_name' => $job->contact_person_name,
            'person_contact' => $job->person_contact,
            'person_email' => $job->person_email,
            'created_at' => $job->created_at,
            'updated_at' => $job->updated_at

        ];

        // create curl resource
        $curl = curl_init($url);

        // 1. Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // 2. Set the CURLOPT_POST option to true for POST request
        curl_setopt($curl, CURLOPT_POST, true);
        // 3. Set the request data as JSON using json_encode function
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));


        $response = curl_exec($curl);

        $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
        $job_posting->happiest = 1;
        $job_posting->save();

        curl_close($curl);
        return 1;
    }

    public function sendtowhiteforce($job_position_id)
    {

        // $job_position_id="2420";

        $job = Position::find($job_position_id);


        $url = 'https://white-force.com/publisher/api/sendtowhiteforceIndia';

        $data = [
            'job_id' => $job->id,
            'positionName' => $job->positionName,

            'address_address' => $job->address_address,
            'jobType' => $job->jobType,

            'minSalary' => $job->minSalary,
            'maxSalary' => $job->maxSalary,
            'skills' => $job->skillSet,

            'closeDate' => $job->closeDate,
            'minYearExp' => $job->minYearExp,

            'job_description' => $job->job_description,

            'apply_button_url' => $this->apply_button_url . $job->id . '/whiteforce',

            'contact_person_name' => $job->contact_person_name,
            'person_contact' => $job->person_contact,
            'person_email' => $job->person_email,
            'created_at' => $job->created_at,
            'updated_at' => $job->updated_at

        ];

        // create curl resource
        $curl = curl_init($url);

        // 1. Set the CURLOPT_RETURNTRANSFER option to true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // 2. Set the CURLOPT_POST option to true for POST request
        curl_setopt($curl, CURLOPT_POST, true);
        // 3. Set the request data as JSON using json_encode function
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));


        $response = curl_exec($curl);

        $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
        $job_posting->whiteforce = 1;
        $job_posting->save();

        curl_close($curl);
        return 1;
    }

    public function sendtoCvlibrary($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/sendtoCvlibrary';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at

            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->true == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->CVLibaray = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Cv Library';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Cv Library Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'Cv Library';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendtoadzunaUSA($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/sendtoadzunaUSA';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id/job_vertise",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at

            ];

            // create curl resource
            $curl = curl_init($url);
            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($curl);

            $res = json_decode($response);

        if ($res->true == 1) {
            $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
            $job_posting->adzunausa = 1;
            $job_posting->save();

            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'adzuna usa';
            $response->is_success = 1;
            $response->response = 'Job Posted Successfully in adzuna usa Jobs';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'adzuna usa';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

     public function sendtowhatsjobUSA($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://happiestresume.com/api/sendtoWhatsjobUSA';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);

            $res = json_decode($response);

            if ($res->true == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->whatsjobusa = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'whatsjob USA';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in whatsjobs USA Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'whatsjob USA';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendtotimesascent($job_position_id)
    {
        try {
            $job = Position::where('id', $job_position_id)->with(['findClientGet'])->first();
            $url = 'https://happiestresume.com/api/sendtotimesascentUsa';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'clientImage' => $job->findClientGet->clientImage,
                'aboutClient' => $job->findClientGet->aboutClient,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];
            $curl = curl_init($url);

            // 1. Set the CURLOPT_RETURNTRANSFER option to true
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // 2. Set the CURLOPT_POST option to true for POST request
            curl_setopt($curl, CURLOPT_POST, true);
            // 3. Set the request data as JSON using json_encode function
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));


            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res->true == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->timesascent = 1;
                $job_posting->save();


                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Times Ascent USA';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Times Ascent USA Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'Times Ascent USA';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function sendtotanqeeb($job_position_id)
    {
        try {
            $job = Position::where('id', $job_position_id)->with(['findClientGet'])->first();
            $url = 'https://happiestresume.com/api/sendtotanqeeb';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'job_description' => $job->job_description,
                'country' => $job->countries,
                'state' => $job->states,
                'city' => $job->city,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'clientImage' => $job->findClientGet->clientImage,
                'aboutClient' => $job->findClientGet->aboutClient,
                'skills' => $job->skill_set,
                'minYearExp' => $job->min_year_exp,
                'expire_on' => $job->close_date,
                'apply_button_url' => "https://happiestresume.com/job-description/$job->id",
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $response = curl_exec($curl);
            $res = json_decode($response);

        if ($res->true == 1) {
            $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
            $job_posting->tanqeeb = 1;
            $job_posting->save();

            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'Tanqeeb UAE';
            $response->is_success = 1;
            $response->response = 'Job Posted Successfully in Tanqeeb UAE Jobs';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'Tanqeeb UAE';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }


    public function LinkedinAts($job_position_id)
    {
        try {
            $job = Position::find($job_position_id);
            $url = 'https://white-force.com/publisher/api/sendToLinkedinAts';
            $address = "$job->city, $job->states, $job->countries";
            $data = [
                'job_id' => $job->id,
                'positionName' => $job->position_name,
                'closeDate' => $job->close_date,
                'jobType' => $job->job_type,
                'minSalary' => $job->min_salary,
                'maxSalary' => $job->max_salary,
                'job_description' => $job->job_description,
                'company_name' => 'White Force Outsourcing Pvt Ltd',
                'apply_button_url' => $this->apply_button_url . $job->id . '/linkedin_ats',
                'skillSet' => $job->skill_set,
                'city' => $job->city,
                'state' => $job->states,
                'country' => $job->countries,
                'postal_code' => $job->postal_code,
                'address_address' => $address ?? null,
                'contact_person_name' => $job->contact_person_name,
                'person_contact' => $job->person_contact,
                'person_email' => $job->person_email,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
                'minYearExp' => $job->min_year_exp,
                'maxYearExp' => $job->max_year_exp,
                'industry' => $job->industry,

            ];
            // return $data;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

            $response = curl_exec($curl);
            $numberC = (int)$response;
            if ($response == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_position_id)->first();
                $job_posting->linkedin_paid = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Linkedin Ats';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Linkedin Ats Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            $response = new Portalresponse();
            $response->portal = 'Linkedin Ats';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }
  
}
