<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewShineCities;
use App\Models\NewShineEducation;
use App\Models\NewShineEducationStream;
use App\Models\NewShineExperience;
use App\Models\NewShineFunctionalArea;
use App\Models\NewShineIndustries;
use App\Models\NewShineSalary;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ShineTestController extends Controller
{
    public function shineForm()
    {
        $cities = NewShineCities::get();
        $industries = NewShineIndustries::get();
        $fields = NewShineFunctionalArea::get();
        $educations = NewShineEducation::get();
        $streams = NewShineEducationStream::get();
        $experience = NewShineExperience::get();
        $salary = NewShineSalary::get();
        return view('shine_job_test', compact('cities', 'industries', 'fields', 'educations', 'streams', 'experience', 'salary'));
    }

    public function shineFormSubmit(Request $request)
    {
        try {

            $outputArray = [];
            $outputArray[] = (int)$request->shine_study_field_grouping_id[0];
            $outputArray[] = array_map('intval', $request->shine_study_id);

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
                "jobtitle" => "java developer",
                "description" => "candidate should have experience in java, eclipse, with 3 years experience. Should have hands in testing.",
                "industry" => (int)$request->shine_industries_id,
                "minexperience" => (int)$request->shine_min_experience_id,
                "maxexperience" => (int)$request->shine_max_experience_id,
                "salarymin" => (int)$request->shine_min_salary_id,
                "combo_flag"=>5,
                "salarymax" => (int)$request->shine_max_salary_id,
                "location" => array_map('intval', $request->shine_cities_id),
                "functional_area" => array_map('intval', $request->shine_functional_areas_id),
                "skills" => "java, c++, python",  
                "qualification_level_1" => $outputArray,
            ];

            // return $data;
            $data = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                // "Authorization: Basic " . base64_encode("$username:$password")
            ));
            $response = curl_exec($ch);

            $detail = $response;
            return $detail;
            curl_close($ch);
            return 1;
        } catch (\Exception $e) {
            curl_close($ch);
            return $e->getMessage();
        }
    }

    // function sendToShineNew(Request $request)
    // {

    //     $client = new Client();

    //     $url = "https://recruiter.shine.com/api/v4/job/";
    //     $username = 'HSO';
    //     $password = 'White@1234';

    //     $outputArray = [];
    //     $outputArray[] = (int)$request->shine_study_field_grouping_id[0];
    //     $outputArray[] = array_map('intval', $request->shine_study_id);

    //     $data = [
    //         "jobtitle" => "java developer",
    //         "description" => "candidate should have experience in java, eclipse, with 3 years experience. Should have hands in testing.",
    //         "industry" => (int)$request->shine_industries_id,
    //         "minexperience" => (int)$request->shine_min_experience_id,
    //         "maxexperience" => (int)$request->shine_max_experience_id,
    //         "salarymin" => (int)$request->shine_min_salary_id,
    //         "salarymax" => (int)$request->shine_max_salary_id,
    //         "location" => array_map('intval', $request->shine_cities_id),
    //         "functional_area" => array_map('intval', $request->shine_functional_areas_id),
    //         "skills" => "java, c++, python",
    //         "qualification_level_1" => $outputArray,
    //     ];

    //     // return $data;

    //     $headers = [
    //         "Content-Type" => "application/json",
    //         "Authorization" => "Basic " . base64_encode("$username:$password")
    //     ];

    //     $response = $client->post($url, [
    //         'headers' => $headers,
    //         'json' => $data,
    //     ]);

    //     $detail = $response->getBody()->getContents();

    //     // Process the response as needed

    //     return $detail;
    // }


    // public function sendToShine(Request $request)
    // {
    //     // try {



    //     $ch = curl_init();

    //     $url = "https://recruiter.shine.com/api/v4/job/";
    //     $username = 'HSO';
    //     $password = 'White@1234';

    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //     curl_setopt($ch, CURLOPT_POST, TRUE);


    //     $data = [
    //         "jobtitle" => "java developer",
    //         "description" => "candidate should have experience in java, eclipse, with 3 years experience. Should have hands in testing.",
    //         "industry" => 1,
    //         "minexperience" => 4,
    //         "maxexperience" => 8,
    //         "salarymin" => 3,
    //         "salarymax" => 4,
    //         "location" => [243, 244],
    //         "functional_area" => [106, 107],
    //         "skills"    => "java, c++, python",
    //         "qualification_level_1" => [112, [566]],
    //     ];


    //     $outputArray = [];
    //     // Add the first element directly
    //     $outputArray[] = (int)$request->shine_study_field_grouping_id[0];
    //     // Add the second array as a nested array
    //     $outputArray[] = array_map('intval', $request->shine_study_id);
    //     $data = [
    //         "jobtitle" => "java developer",
    //         "description" => "candidate should have experience in java, eclipse, with 3 years experience. Should have hands in testing.",
    //         "industry" => (int)$request->shine_industries_id,
    //         "minexperience" => (int)$request->shine_min_experience_id,
    //         "maxexperience" => (int)$request->shine_max_experience_id,
    //         "salarymin" => (int)$request->shine_min_salary_id,
    //         "salarymax" => (int)$request->shine_max_salary_id,
    //         "location" => array_map('intval', $request->shine_cities_id),
    //         "functional_area" => array_map('intval', $request->shine_functional_areas_id),
    //         "skills"    => "java, c++, python",
    //         "qualification_level_1" =>  $outputArray,
    //     ];

    //     // return $data;
    //     $data = json_encode($data);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //         "Content-Type: application/json",
    //         "Authorization: Basic " . base64_encode("$username:$password")
    //     ));
    //     $response = curl_exec($ch);


    //     $detail = $response;
    //     return $detail;




    //     curl_close($ch);

    //     return 1;
    //     // } catch (\Exception $e) {
    //     //     curl_close($ch);

    //     //     return 0;
    //     // }
    // }

   
}