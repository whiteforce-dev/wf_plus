<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JobPostingModel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\NewMonsterField;
use App\Models\NewMonsterFieldArea;
use App\Models\Portalresponse;
use App\Models\Position;
use App\Models\ShineJobId;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Storage;
use XMLWriter;
use Carbon\Carbon;

class NewJobPostingController extends Controller
{
    public function jobisite()
    {
        return view('newjobportal.jobisite_form');
    }
    public function sendToJobisite(Request $request)
    {
        return $request;
    }

    public function greenhouse()
    {
        return view('newjobportal.greenhouse_form');
    }

    public function sendToGreenhouse(Request $request)
    {
        // return $request;

        try {
            $ch = curl_init();

            // Replace with your actual board token and job ID
            $boardToken = 'internal'; // or your specific board token
            $jobId = '55555'; // or your specific job ID
            $api_key = ""; // Replace with your actual API key

            $url = "https://boards-api.greenhouse.io/v1/boards/$boardToken/jobs/$jobId";

            // Define the data to send (example data)
            $data = [
                "_token" => $request->_token,
                "_method" => "POST",
                "id" => "55555",
                "mapped_url_token" => "token12345",
                "first_name" => null,
                "last_name" => null,
                "email" => null,
                "phone" => null,
                "question_5555" => null,
                "question_3333" => null
            ];

            $data = json_encode($data);

            // Set the URL and other options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Basic " . base64_encode("$api_key:"),
                "Content-Type: application/json",
            ));

            $response = curl_exec($ch);

            // if ($response === false) {
            //     $error = curl_error($ch);
            //     throw new Exception("Curl error: " . $error);
            // }

            // Process the response as needed
            // ...

            curl_close($ch);

            // Return whatever data you need
            return $response;
        } catch (\Exception $e) {
            // Handle exceptions
            if (isset($ch)) {
                curl_close($ch);
            }
            return $e->getMessage();
        }
        
        // guzzal http request

        $client = new Client();
        $url = "https://api.greenhouse.io/v1/partner/candidates";
        // $username = 'HSO';
        // $password = 'White@1234';
        $data = [
            "prospect" => "true",
            "first_name" => "Harry",
            "last_name" => "Potter",
            "company" => "Hogwarts",
            "title" => "Student",
            "resume" => "https://hogwarts.com/resume",
            "phone_numbers" => [
                [
                    "phone_number" => "123-456-7890",
                    "type" => "home",
                ],
            ],
            "emails" => [
                [
                    "email" => "hpotter@hogwarts.edu",
                    "type" => "other",
                ],
            ],
            "social_media" => [
                [
                    "url" => "https://twitter.com/hp",
                ],
            ],
            "websites" => [
                [
                    "url" => "https://harrypotter.com",
                    "type" => "blog",
                ],
            ],
            "addresses" => [
                [
                    "address" => "4 Privet Dr",
                    "type" => "home",
                ],
            ],
            "job_id" => 12345,
            "external_id" => "24680",
            "notes" => "Good at Quiddich",
            "prospect_pool_id" => 123,
            "prospect_pool_stage_id" => 456,
            "prospect_owner_email" => "prospect_owners_email@example.com",
        ];
        // return $data;
        $headers = [
            "Content-Type" => "application/json",
            "Authorization" => "Basic " . "MGQwMzFkODIyN2VhZmE2MWRjMzc1YTZjMmUwNjdlMjQ6",
        ];
        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);
        $detail = $response->getBody()->getContents();
        // Process the response as needed
        return $detail;
        // return $data;
    }

    public function monster()
    {
        return view('newjobportal.monster_form');
    }


    public function sendToMonster(Request $request)
    {
        // return $request;
        try {
            $ch = curl_init();

            $url = "https://api.greenhouse.io/v1/partner/candidates";
            $username = 'Basic';
            $password = 'MGQwMzFkODIyN2VhZmE2MWRjMzc1YTZjMmUwNjdlMjQ6';

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            // $skils = json_encode($job->skillSet);
            $data = [
                "City" => "Weston",
                "CountryCode" => "US",
                "EmailAddress" => "applytester@monster.com",
                "FileContents" => [80, 75, 3, 4, 20, 0, 0, 0],
                "FileExt" => ".docx",
                "FirstName" => "ApplicantFirstname",
                "JobRefID" => "customers_job_id_1234abcd",
                "LastName" => "ApplicantLastname",
                "PhoneNumber" => "8006667837",
                "ResumeValue" => "jj34hffti6v",
                "State" => "MA",
                "VendorField" => "text from vendor to pass along with apply",
                "WorkAuthorization" => 3,
                "ZIPCode" => "02493",
            ];

            // return $data;
            $data = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization: Basic " . base64_encode("$username:$password"),
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


    public function sendToLearn4Good($job_id)
    {
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtolearn4good';
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
                'salaryType' => $job->salary_type,
                'payType' => $job->pay_type,
                'education'=>$job->edu_qualification,
                'clientImage' => $job->findClientGet->clientImage,
                'aboutClient' => $job->findClientGet->aboutClient,
                'skills' => $job->skill_set,
                'industry' => $job->industry,
                'jobType'=> $job->job_type,
                'closeDate'=>$job->close_date,
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
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->learn4good = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'learn4good';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in learn4good Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'learn4good';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }

    public function eluta()
    {
        return view('newjobportal.eluta_form');
    }

    public function sendToEluta(Request $request)
    {

        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<elutaxml xmlns="http://www.eluta.ca/elutaxml" version="1.0">';
        $xml .= '<employer>';
        $xml .= '<name>Manitoba Civil Service Commission</name>';

        $xml .= '<job>';
        $xml .= '<title>Senior Financial Analyst</title>';
        $xml .= '<jobref>unique competition number</jobref>';
        $xml .= '<joburl>http://www.gov.mb.ca/csc/jobs/mgmt_legal/17151.html</joburl>';
        $xml .= '<description>';
        $xml .= 'Job description, qualifications and requirements. Job-seekers may find your
                position on Eluta based largely on the contents this field, so be sure to include
                a full job description, including any qualifications required. Short or incomplete
                descriptions mean that fewer people may find your positions. Do not, however,
                include company description or other application information in this field.';
        $xml .= '</description>';

        $xml .= '<occupationcategory>Finance</occupationcategory>';
        $xml .= '<jobaddress>7 St. Thomas Street</jobaddress>';
        $xml .= '<jobcity>Selkirk</jobcity>';
        $xml .= '<jobprovince>Manitoba</jobprovince>';
        $xml .= '<jobpostalcode>R2A 1G5</jobpostalcode>';
        $xml .= '<jobtype>Full Time</jobtype>';
        $xml .= '<salarymin>50120</salarymin>';
        $xml .= '<salarymax>60522</salarymax>';
        $xml .= '<salarytype>yearly</salarytype>';
        $xml .= '<postdate>January 31, 2007</postdate>';
        $xml .= '<expirydate>February 16, 2007</expirydate>';
        $xml .= '<division>Manitoba Family Services</division>';
        $xml .= '</job>';
        $xml .= '</employer>';
        $xml .= '</elutaxml>';
        $response = Response::make($xml, 200);
        $response->header('Content-Type', 'text/xml');
        return $response;

    }

    public function jobgrin()
    {
        return view('newjobportal.jobgrin_form');
    }

    public function sendToJobgrin($job_id)
    {
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtojobgrin';
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
                'salaryType' => $job->salary_type,
                'payType' => $job->pay_type,
                'education'=>$job->edu_qualification,
                'clientImage' => $job->findClientGet->clientImage,
                'aboutClient' => $job->findClientGet->aboutClient,
                'skills' => $job->skill_set,
                'industry' => $job->industry,
                'postalCode' => $job->postal_code,
                'jobType'=> $job->job_type,
                'experience'=> $job->min_year_exp,
                'closeDate'=>$job->close_date,
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
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->jobgrin = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'jobgrin';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in jobgrin Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'jobgrin';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }

    public function jobinventory()
    {
        return view('newjobportal.jobinventory_form');
    }

    public function sendToJobinventory(Request $request)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<listing>';

        $xml .= '<ctime>2011-03-01T14:00:00-07:00</ctime>';

        // Job entry
        $xml .= '<entry>';
        $xml .= '<id><![CDATA[101647600000100]]></id>';
        $xml .= '<title><![CDATA[Example title]]></title>';

        // Location information
        $xml .= '<location>';
        $xml .= '<country><![CDATA[US]]></country>';
        $xml .= '<state><![CDATA[CA]]></state>';
        $xml .= '<city><![CDATA[Sacramento]]></city>';
        $xml .= '<postalcode><![CDATA[95814]]></postalcode>';
        $xml .= '</location>';

        $xml .= '<description><![CDATA[Example description]]></description>';
        $xml .= '<date><![CDATA[2011-03-01T14:00:00-07:00]]></date>';
        $xml .= '<url><![CDATA[http://www.example.com/listing-url.html]]></url>';
        $xml .= '<category><![CDATA[Community and Social Service]]></category>';
        $xml .= '<company><![CDATA[Example Company]]></company>';
        $xml .= '<jobtype><![CDATA[Contract]]></jobtype>';
        $xml .= '<education><![CDATA[Doctorate]]></education>';
        $xml .= '<experience><![CDATA[5-7 years]]></experience>';
        $xml .= '</entry>';

        $xml .= '</listing>';

        $response = response($xml, 200);
        $response->header('Content-Type', 'text/xml');
        return $response;
    }

    public function sendToCareerBliss($job_id)
    {
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtocareerbliss';
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
                'salaryType' => $job->salary_type,
                'payType' => $job->pay_type,
                'education'=>$job->edu_qualification,
                'clientImage' => $job->findClientGet->clientImage,
                'aboutClient' => $job->findClientGet->aboutClient,
                'skills' => $job->skill_set,
                'industry' => $job->industry,
                'postalCode' => $job->postal_code,
                'jobType'=> $job->job_type,
                'experience'=> $job->min_year_exp,
                'closeDate'=>$job->close_date,
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
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
             $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->careerbliss = 1;
                $job_posting->save();
            }
            curl_close($curl);
            $response = new Portalresponse();
            $response->portal = 'careerbliss';
            $response->is_success = 1;
            $response->response = 'Job Posted Successfully in careerbliss Jobs';
            $response->job_id = $job->id;
            $response->save();
            return 1;
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'careerbliss';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }

    public function jobswype(){
        return view('newjobportal.jobswype_form');
    }

    public function sendToJobswype(Request $request){
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<jobs>';

        // First job entry
        $xml .= '<job>';
        $xml .= '<jobtitle>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</jobtitle>';
        $xml .= '<joblink>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</joblink>';
        $xml .= '<joblocations>';
        $xml .= '<location>';
        $xml .= '<country>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</country>';
        $xml .= '<state>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</state>';
        $xml .= '<county>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</county>';
        $xml .= '<city>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</city>';
        $xml .= '<postalcode>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</postalcode>';
        $xml .= '</location>';
        $xml .= '</joblocations>';
        $xml .= '<jobmode>';
        $xml .= '<contracttype/>';
        $xml .= '<worktime/>';
        $xml .= '</jobmode>';
        $xml .= '<jobcategory_Level1/>';
        $xml .= '<jobcategory_Level2/>';
        $xml .= '<dates>';
        $xml .= '<postingdate/>';
        $xml .= '<updatedate/>';
        $xml .= '<startdate/>';
        $xml .= '<expirationdate/>';
        $xml .= '</dates>';
        $xml .= '<companyreference>';
        $xml .= '<companyname>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</companyname>';
        $xml .= '<companyurl>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</companyurl>';
        $xml .= '</companyreference>';
        $xml .= '<salary>';
        $xml .= '<from/>';
        $xml .= '<to/>';
        $xml .= '<currency/>';
        $xml .= '<period/>';
        $xml .= '</salary>';
        $xml .= '<displaycountry/>';
        $xml .= '<keywords>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</keywords>';
        $xml .= '</job>';

        // Second job entry
        $xml .= '<job>';
        $xml .= '<jobtitle>';
        $xml .= '<![CDATA[ Chef - Professional Cookery Assessor ]]>';
        $xml .= '</jobtitle>';
        $xml .= '<joblink>';
        $xml .= '<![CDATA[ https://www.domain.com/path/professionalCookeryAccessor.pdf ]]>';
        $xml .= '</joblink>';
        $xml .= '<joblocations>';
        $xml .= '<location>';
        $xml .= '<country>';
        $xml .= '<![CDATA[ United Kingdom ]]>';
        $xml .= '</country>';
        $xml .= '<state>';
        $xml .= '<![CDATA[ Wales ]]>';
        $xml .= '</state>';
        $xml .= '<county>';
        $xml .= '<![CDATA[ Cardiff ]]>';
        $xml .= '</county>';
        $xml .= '<city>';
        $xml .= '<![CDATA[ Cardiff ]]>';
        $xml .= '</city>';
        $xml .= '<postalcode>';
        $xml .= '<![CDATA[ CF10 1AU ]]>';
        $xml .= '</postalcode>';
        $xml .= '</location>';
        $xml .= '</joblocations>';
        $xml .= '<jobmode>';
        $xml .= '<contracttype/>';
        $xml .= '<worktime/>';
        $xml .= '</jobmode>';
        $xml .= '<jobcategory_Level1/>';
        $xml .= '<jobcategory_Level2/>';
        $xml .= '<dates>';
        $xml .= '<postingdate/>';
        $xml .= '<updatedate/>';
        $xml .= '<startdate/>';
        $xml .= '<expirationdate/>';
        $xml .= '</dates>';
        $xml .= '<companyreference>';
        $xml .= '<companyname>';
        $xml .= '<![CDATA[ My Real Company ]]>';
        $xml .= '</companyname>';
        $xml .= '<companyurl>';
        $xml .= '<![CDATA[ https://myrealcompany.com ]]>';
        $xml .= '</companyurl>';
        $xml .= '</companyreference>';
        $xml .= '<salary>';
        $xml .= '<from>30000</from>';
        $xml .= '<to>35000</to>';
        $xml .= '<currency>GBP</currency>';
        $xml .= '<period>Yearly</period>';
        $xml .= '</salary>';
        $xml .= '<displaycountry>GB</displaycountry>';
        $xml .= '<keywords>';
        $xml .= '<![CDATA[ ]]>';
        $xml .= '</keywords>';
        $xml .= '</job>';

        $xml .= '</jobs>';

        $response = response($xml, 200);
        $response->header('Content-Type', 'text/xml');
        return $response;

    }

    public function clickIndia(){
        return view('newjobportal.clickIndia_form');
    }
    public function sendToClickIndia(Request $request){

        // return $request;
        try {
            $ch = curl_init();

            $url = 'https://www.clickindia.com/cron/jobs_business_api.php';

            $data = [
                "listing" => [
                    "record" => [
                        "job_id" => [
                            "value" => "4586",
                        ],
                        "job_title" => [
                            "value" => "Laravel Developer",
                        ],
                        "job_description" => [
                            "value" => "full job description",
                        ],
                        "job_category" => [
                            "value" => "423",
                        ],
                        "job_city" => [
                            "value" => "37",
                        ],
                        "job_location" => [
                            "value" => "locality",
                        ],
                        "job_pref_loc" => [
                            "value" => "preffered job locations ex:- delhi,noida,gurgaon",
                        ],
                        "qualification" => [
                            "value" => "Bachelors",
                        ],
                        "experience" => [
                            "value" => "4",
                        ],
                        "job_type" => [
                            "value" => "Full time jobs",
                        ],
                        "payroll_type" => [
                            "value" => "Per Month",
                        ],
                        "salary" => [
                            "value" => "salary",
                        ],
                        "salary_type" => [
                            "value" => "salary type ex:- monthly, yearly",
                        ],
                        "designation" => [
                            "value" => "designation",
                        ],
                        "working_days" => [
                            "value" => "working days",
                        ],
                        "gender" => [
                            "value" => "gender",
                        ],
                        "hiring_process" => [
                            "value" => "Telephonic, Walk-In, Written test, Group Discussion, Interview",
                        ],
                        "vacancy" => [
                            "value" => "no of vacancy",
                        ],
                        "skills" => [
                            "value" => "required skills",
                        ],
                        "languages" => [
                            "value" => "required languages",
                        ],
                        "listing_url" => [
                            "value" => "url-listing page",
                        ],
                        "company" => [
                            "value" => "company_name",
                        ],
                        "company_logo" => [
                            "value" => "company_logo",
                        ],
                        "company_website" => [
                            "value" => "company_website",
                        ],
                        "company_profile" => [
                            "value" => "information about company",
                        ],
                        "other" => [
                            "value" => "If any other information available",
                        ],
                    ],
                ],
            ];

            // Convert data array to JSON
            $data = json_encode($data);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
            ));
            $response = curl_exec($ch);
            if ($response === false) {
                echo 'cURL error: ' . curl_error($ch);
            } else {
                // return $response;
                echo 'Response from API: ' . $response;
            }

            // Close cURL session
            curl_close($ch);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function newMonster(){
        $industries=NewMonsterField::distinct()->get();
        // return $industries;
        return view('newjobportal.new_monster_form',compact('industries'));
    }
    public function getIndustry(Request $request){
        $area=NewMonsterFieldArea::where('industry_id',$request->monster_industry_id)->get();
        return $area;
    }

    public function sendToNewMonster(Request $request){
        // return $request;
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<JobPositionPostings>';
        $xml .= '<JobFeedVersion version="1.1"/>';
        $xml .= '<CompanyReference CorpId="273664">';
        $xml .= '<Username>xhsosinxftp</Username>';
        $xml .= '<Password>Happy@123</Password>';
        $xml .= '</CompanyReference>';
        $xml .= '<Jobs>';
        $xml .= '<Job JobRefId="123456" JobAction="addOrUpdate" Language="EN">';
        $xml .= '<JobInformation>';
        $xml .= '<Channel founditId="1"/>';
        $xml .= '<JobTitle><![CDATA[Branch Manager]]></JobTitle>';
        $xml .= '<Categories>';
        $xml .= '<Category>'.$request->monster_category_function_id.'</Category>';
        $xml .= '</Categories>';
        $xml .= '<Roles>';
        $xml .= '<Role>'.$request->category_role_id.'</Role>';
        $xml .= '</Roles>';
        $xml .= '<Industries>';
        $xml .= '<Industry>'.$request->monster_industry_id.'</Industry>';
        $xml .= '</Industries>';
        $xml .= '<Locations>';
        $xml .= '<Location>'.$request->monster_location.'</Location>';
        $xml .= '<Location>183</Location>';
        $xml .= '</Locations>';
        $xml .= '<WorkExperience>';
        $xml .= '<MinimumYear>2</MinimumYear>';
        $xml .= '<MaximumYear>4</MaximumYear>';
        $xml .= '</WorkExperience>';
        $xml .= '<Education>';
        $xml .= '<Level>'.$request->monster_education_level_id.'</Level>';
        $xml .= '</Education>';
        $xml .= '<Salary>';
        $xml .= '<Currency founditId="4">INR</Currency>';
        $xml .= '<MinimumSalary>60000</MinimumSalary>';
        $xml .= '<MaximumSalary>90000</MaximumSalary>';
        $xml .= '</Salary>';
        $xml .= '<KeySkills>Bio Technology and Life Sciences Media Planning, Time Management, Sales</KeySkills>';
        $xml .= '<JobSummary><![CDATA[<b>Branch Sales Manager</b> with strong sales background. <br/> <b>Attractive</b> Salaries on Offer !]]></JobSummary>';
        $xml .= '<JobDescription><![CDATA[<p>As a Branch Manager you will spearhead business development across a defined territory <br />based from one of our prestigious branch locations. Having full financial responsibility <br />for your business unit you will provide direction and support to your team of consultants, <br />to create an environment that ensures success for both them and the business. </p><p>Your strong sales background will reflect in your resilience and determination when <br />developing your branch and your customer focused attitude will show through your patience <br />and tenacity.</p><p>It is likely that you will have at least 12 months direct line management experience <br />together with a clear understanding of the P&amp;L of business. Of course a proven track record <br />within a sales or service environment is a prerequisite to be considered for this role. </p><p>Candidates will ideally will come from a recruitment background but this is not essential.</p><p>We offer and attractive base rate salary + bonus + pension + life insurance + 23 days <br />holiday + health insurance + company car.</p><p>Candidates must hold a full driving license.</p>]]></JobDescription>';
        $xml .= '<AboutCompany>About the company.. About the company..</AboutCompany>';
        $xml .= '</JobInformation>';
        $xml .= '<Contact>';
        $xml .= '<Name>Test India</Name>';
        $xml .= '<Phone>123456789</Phone>';
        $xml .= '<E-mail>jobs@monsterindia.co.in</E-mail>';
        $xml .= '</Contact>';
        $xml .= '<ApplyOnlineURL>https://www.foundit.*/seeker/job-details?kId=folderid</ApplyOnlineURL>';
        $xml .= '</Job>';
        $xml .= '</Jobs>';
        $xml .= '</JobPositionPostings>';

        $apiUrl = 'https://recruiter.foundit./v2/jobpostings_feeds.html?xmlfeed=' . urlencode($xml);
        // $username = 'xhsosinxftp';
        // $password = 'Happy@123';

        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));

        $response = curl_exec($ch);

        if ($response === false) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            echo 'Response from API: ' .$response;
        }
        // Close cURL session
        curl_close($ch);

        // $response = response($xml, 200);
        // $response->header('Content-Type', 'text/xml');
        // return $response;

    }
    public function talent(){
            $xml = '<?xml version="1.0" encoding="utf-8"?>';
            $xml .= '<source>';
            $xml .= '<publisher>Random Publisher</publisher>';
            $xml .= '<publisherurl>https://www.randompublisher.com</publisherurl>';
            $xml .= '<lastbuilddate>' . gmdate("D, d M Y H:i:s") . ' GMT</lastbuilddate>';

            // Your job entry
            $xml .= '<job>';
            $xml .= '<title>Random Job Title</title>';
            $xml .= '<company>Random Company</company>';
            $xml .= '<city>Random City</city>';
            $xml .= '<state>Random State</state>';
            $xml .= '<country>Random Country</country>';
            $xml .= '<dateposted>' . gmdate("D, d M Y H:i:s") . ' GMT</dateposted>';
            $xml .= '<expirationdate>' . gmdate("D, d M Y H:i:s", strtotime("+30 days")) . ' GMT</expirationdate>';
            $xml .= '<referencenumber>123456</referencenumber>';
            $xml .= '<url>https://www.randomjoburl.com</url>';
            $xml .= '<description>Random Job Description goes here...</description>';
            $xml .= '<salary>Random Salary</salary>';
            $xml .= '<jobtype>Full-Time</jobtype>';
            $xml .= '<category>Random Category</category>';
            $xml .= '<logo>https://www.randompublisher.com/logo.png</logo>';
            $xml .= '<talent-apply-data><![CDATA[talent-apply-posturl=https%3A%2F%2Famazingcompany.com%2F%0A&talent-apply-questions=https%3A%2F%2Fwww.talent.com%2Fintegrations%2Fquestions]]></talent-apply-data>';
            $xml .= '</job>';

            $xml .= '</source>';

            $response = response($xml, 200);
            $response->header('Content-Type', 'text/xml');
            return $response;

    }

    public function sendToTalentJob($job_id){
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtotalentjob';
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
                'jobType'=> $job->job_type,
                'closeDate'=>$job->close_date,
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
           
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            return $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Jobrapido';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Jobrapido Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
                
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'Jobrapido';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }

    public function sendToReed($reedInfo){ 
    try{
        $position=Position::find($reedInfo['job_id']);
        // return $position;
        $array = explode(',', $position['skill_set']);
        $currentDate = Carbon::now();
        $endDate = Carbon::parse($position['close_date']);
        $diffInDays = $currentDate->diffInDays($endDate);
      
        $user_agent = 'ReedAgent';
        $api_token = '4257484f-1725-4eff-8ee8-16ce72244133';
        $client_id = '7358769';
        $url = 'https://www.reed.co.uk/recruiter/api/1.0/jobs';
        $http_method = 'POST';

        $dt = new DateTime('now', new DateTimeZone('UTC'));
        $timestamp = $dt->format('Y-m-d\TH:i:s') . '+00:00';

        // Calculate signature
        $string_to_sign = $http_method . $user_agent . $url . parse_url($url, PHP_URL_HOST) . $timestamp;
        $hmac_sha1_hash = hash_hmac('sha1', $string_to_sign, $api_token , true);
        $api_signature = base64_encode($hmac_sha1_hash);

        // Add required headers
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent: ' . $user_agent,
            'X-ApiSignature: ' . $api_signature,
            'X-ApiClientId: ' . $client_id,
            'X-TimeStamp: ' . $timestamp,
        ];

        // Construct job data
        $data = [
            "JobType" => $reedInfo["reed_job_type"],
            "Title"=>$position['position_name'],
            "Username"=>"bhavna@happiestresume.com",
            "Description" => $position['job_description'],
            "TownName" => $position['countries'].$position['states'].$position['city'],
            "CountyName" => $position['states'],
            "CountryName" =>$position['countries'],
            "WorkingHours" =>$reedInfo["reed_working_hour"],
            "EmailForApplications" => "bhavna@happiestresume.com",
            "PostingKey"=> "253702f5-e7d5-463b-a7bd-e144fd09be5a",
            "MinSalary" => $position['min_salary'],
            "MaxSalary" => $position['max_salary'],
            "SalaryType"=>$reedInfo["reed_salary_type"],
            "Currency" => $reedInfo["reed_currency_type"],
            "ExpiryInDays" =>  $diffInDays,
            "ProductId" => "2",
            "Skills" => $array,
            "CoverLetterPreference" => "3",
        ];

        // return $data;

        // Build request using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        if ($response == 1) {
            $job_posting = JobPostingModel::where('job_id', $reedInfo['job_id'])->first();
            $job_posting->reed = 1;
            $job_posting->save();

            curl_close($ch);
            $response = new Portalresponse();
            $response->portal = 'Reed';
            $response->is_success = 1;
            $response->response = 'Job Posted Successfully in Jobsora Jobs';
            $response->job_id = $reedInfo['job_id'];
            $response->save();
            return 1;
        }
    } catch (\Exception $e) {
        // return $e->getMessage();
        $response = new Portalresponse();
        $response->portal = 'Reed';
        $response->is_success = 0;
        $response->response = $e->getMessage();
        $response->job_id = $reedInfo['job_id'];
        $response->save();
        return 0;
    }
        // return response()->json(['response' => $response]);
    }

    public function jobsoid(){
        return view('newjobportal.reed_form');
    }
    public function user()
    {
        $filePath = public_path('user.txt');
    
        try {
            $fileContents = file_get_contents($filePath);
    
            // Now, $fileContents contains the content of the file
            // You can do whatever you need with $fileContents
            echo $fileContents;
        } catch (\Exception $e) {
            // Handle any exceptions that may occur, such as if the file doesn't exist
            // You can log the error or return an error response here
            echo "Error: " . $e->getMessage();
        }
    }
    public function shine($id){
        
            $ch = curl_init();
            $url = "https://recruiter.shine.com/api/v2/job/" . $id . "/applications";
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
    
            return $responses_shine;
        
    }
    public function xml(){
        $jsonData = '{
            "position_Name": "TestIng Position",
            "openings": "2",
            "job_description": "<p>Sentreo Systems Software Developer &bull;Majorly responsible for build chat based web application and maintain low latency, high-performance system design. Implement and create graphql queries, troubleshooting and debugging as required for bug fixing and solve interesting scaling problems. &bull;Integrated WhatsApp APIs and chatbots like Google Dialogflow and JSON chatbot in this web application.</p>",
            "management_fee": "0",
            "flat_amount": "25000",
            "min_year_exp": "1",
            "max_year_exp": "2",
            "specification": "computer science",
            "salary_type": "INR",
            "pay_type": "annually",
            "min_salary": "20000",
            "max_salary": "30000",
            "job_type": "Full Time",
            "industry": "IT-Software / Software Services",
            "gender": "male&female",
            "is_remote_work": "0",
            "countries": "India",
            "states": "Madhya Pradesh",
            "city": "Jabalpur",
            "locations": "Jabalpur",
            "job_address": "Jabalpur",
            "postal_code": "482011",
            "skill_set": "MS Office,CIT",
            "edu_qualification": "Any Graduate",
            "close_Date": "2023-09-30",
            "contact_person_name": "Admin",
            "person_email": "admin@white-force.com",
            "person_contact": "9876543210",
            "software_category": "onrole",
            "created_by": 1,
            "updated_at": "2023-09-15T08:02:19.000000Z",
            "created_at": "2023-09-15T08:02:19.000000Z",
            "id": 774,
            "clientname": "(Helios Advisory) Helios Medium Bazaar Pvt. Ltd",
            "is_local": 1,
            "country": null,
            "state": null,
            "location": "Helios Capital Advisors, Lower Parel East, BDD Chawl, Lower Parel, Mumbai, Maharashtra, India",
            "sub_type": "one-time",
            "software_category": "onrole",
            "is_job_posting_client": null,
            "key": null,
            "created_at": "2022-03-08T06:19:09.000000Z",
            "updated_at": "2023-07-03T12:37:38.000000Z"
          }';
          
          // Decode the JSON data
          $data = json_decode($jsonData, true);
          
          // Create a new XMLWriter

          // Create a new XMLWriter
          $data = [
            "position_Name" => "TestIng Position",
            "openings" => "2",
            "job_description" => "<p>Sentreo Systems Software Developer &bull;Majorly responsible for build chat based web application and maintain low latency, high-performance system design. Implement and create graphql queries, troubleshooting and debugging as required for bug fixing and solve interesting scaling problems. &bull;Integrated WhatsApp APIs and chatbots like Google Dialogflow and JSON chatbot in this web application.</p>",
            "management_fee" => "0",
            "flat_amount" => "25000",
            "min_year_exp" => "1",
            "max_year_exp" => "2",
            "specification" => "computer science",
            "salary_type" => "INR",
            "pay_type" => "annually",
            "min_salary" => "20000",
            "max_salary" => "30000",
            "job_type" => "Full Time",
            "industry" => "IT-Software / Software Services",
            "gender" => "male&female",
            "is_remote_work" => "0",
            "countries" => "India",
            "states" => "Madhya Pradesh",
            "city" => "Jabalpur",
            "locations" => "Jabalpur",
            "job_address" => "Jabalpur",
            "postal_code" => "482011",
            "skill_set" => "MS Office,CIT",
            "edu_qualification" => "Any Graduate",
            "close_Date" => "2023-09-30",
            "contact_person_name" => "Admin",
            "person_email" => "admin@white-force.com",
            "person_contact" => "9876543210",
            "software_category" => "onrole",
            "created_by" => 1,
            "updated_at" => "2023-09-15T08:02:19.000000Z",
            "created_at" => "2023-09-15T08:02:19.000000Z",
            "id" => 774,
            "clientname" => "(Helios Advisory) Helios Medium Bazaar Pvt. Ltd",
            "is_local" => 1,
            "country" => null,
            "state" => null,
            "location" => "Helios Capital Advisors, Lower Parel East, BDD Chawl, Lower Parel, Mumbai, Maharashtra, India",
            "sub_type" => "one-time",
            "software_category" => "onrole",
            "is_job_posting_client" => null,
            "key" => null,
            "created_at" => "2022-03-08T06:19:09.000000Z",
            "updated_at" => "2023-07-03T12:37:38.000000Z"
        ]; 
        // return $data;
        // Create a new XMLWriter
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');   
        // Start the root element
        $xml->startElement('job_data');
        // Loop through the data and create elements with tags
        foreach ($data as $key => $value) {
            $xml->startElement($key);
            $xml->text($value);
            $xml->endElement();
        }
        // End the root element
        $xml->endElement();
        // Set the Content-Type header to specify that the content is XML
        header('Content-Type: application/xml');
        // Output the XML
        echo $xml->outputMemory();  
    }

    public function sendToJobsora($job_id){
       
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtojobsora';
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
                'jobType'=> $job->job_type,
                'closeDate'=>$job->close_date,
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
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                $job_posting = JobPostingModel::where('job_id', $job_id)->first();
                $job_posting->jobsora = 1;
                $job_posting->save();

                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Jobsora';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Jobsora Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'Jobsora';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }
    }

    public function sendToTheIndiaJob($job_id){
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtoindiajob';
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
                'jobType'=> $job->job_type,
                'closeDate'=>$job->close_date,
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
           
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'The india Job';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in The india Job Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
                
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'The india Job';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }
    public function sendToJobRapido($job_id){
        try {
            $job = Position::where('id', $job_id)->first();
            // $job = Position::find($job_id);
            $url = 'https://happiestresume.com/api/sendtojobrapido';
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
                'jobType'=> $job->job_type,
                'closeDate'=>$job->close_date,
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
           
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $res = json_decode($response);

            if ($res == 1) {
                curl_close($curl);
                $response = new Portalresponse();
                $response->portal = 'Jobrapido';
                $response->is_success = 1;
                $response->response = 'Job Posted Successfully in Jobrapido Jobs';
                $response->job_id = $job->id;
                $response->save();
                return 1;
                
            }
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response = new Portalresponse();
            $response->portal = 'Jobrapido';
            $response->is_success = 0;
            $response->response = $e->getMessage();
            $response->job_id = $job->id;
            $response->save();
            return 0;
        }

    }
}
