<?php

namespace App\Http\Controllers;
use App\Models\NewMonsterField;
use App\Models\NewMonsterFieldArea;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function position(Request $request)
    {
        $data = [
            // "_token" => "s9EQqxLaG7rWnt2H7msJvk4NnzJTlX9CbDjzaeGl",
            // "jd_json" => "{\"Tools_and_technologies\":[],\"Concept\":[\"sales\"],\"Role\":[\"Store Manager\"],\"Yrs_of_Exp\":[],\"Education\":[],\"Domain\":[],\"Certifications\":[]}",
            "client_id" => "340",
            "management_fee" => "2",
            "flat_amount" => null,
            "position_name" => "Demo Position",
            "countries" => "101",
            "states" => "21",
            "city" => "2232",
            "postal_code" => "482012",
            "jd" => "EYE My EYE.pdf",
            "close_date" => "2023-08-31",
            "openings" => "2",
            "is_remote_work" => "1",
            "edu_qualification" => "Any Graduate",
            "specification" => "Computer Science/ Information Technology",
            "skill_set" => [
                "java",
                "c",
                "python",
                "javascript"
            ],
            "job_description" => "<p>Sentreo Systems Software Developer &bull;Majorly responsible for build chat based web application and maintain low latency, high-performance system design. Implement and create graphql queries, troubleshooting and debugging as required for bug fixing and solve interesting scaling problems. &bull;Integrated WhatsApp APIs and chatbots like Google Dialogflow and JSON chatbot in this web application.</p>",
            "salary_type" => "INR",
            "pay_type" => "monthly",
            "min_salary" => "300000",
            "max_salary" => "500000",
            "job_type" => "Full Time",
            "min_year_exp" => "1",
            "max_year_exp" => "2",
            "industry" => "IT-Software / Software Services",
            "gender" => "male&female",
            "is_local" => "1",
            "submit" => null,
            "jobPortals" => [
                "happiest",
                "whiteforce"
            ]
        ];
        // return $data['management_fee'];

        $xml = '<jobs>';
        $xml .= '<job>';
        $xml .= '<job-id>' . $data['client_id'] . '</job-id>';
        $xml .= '<title><![CDATA[' . $data['client_id'] . ']]></title>';
        $xml .= '<description>';
        $xml .= '<full-text><![CDATA[' . $data['client_id'] . ']]></full-text>';
        $xml .= '<skill><![CDATA[' . $data['client_id'] . ']]></skill>';
        $xml .= '</description>';
        $xml .= '<location>';
        $xml .= '<city><![CDATA[' . $data['client_id'] . ']]></city>';
        $xml .= '<state><![CDATA[' . $data['client_id'] . ']]></state>';
        $xml .= '<country><![CDATA[' . $data['client_id'] . ']]></country>';
        $xml .= '<postal-code><![CDATA[' . $data['client_id'] . ']]></postal-code>';
        $xml .= '</location>';
        $xml .= '<company-name><![CDATA[ White Force Outsourcing Pvt Ltd ]]></company-name>';
        $xml .= '<Salary>';
        $xml .= '<Currency monsterId="1"><![CDATA[INR]]></Currency>';
        $xml .= '<MinimumSalary><![CDATA[' . $data['client_id'] . ']]></MinimumSalary>';
        $xml .= '<MaximumSalary><![CDATA[' . $data['client_id'] . ']]></MaximumSalary>';
        $xml .= '</Salary>';
        $xml .= '<job-type><![CDATA[' . $data['client_id'] . ']]></job-type>';
        $xml .= '<categories>';
        $xml .= '<category><![CDATA[' . $data['client_id'] . ']]></category>';
        $xml .= '</categories>';
        $xml .= '<published-date><![CDATA[' . $data['client_id'] . ']]></published-date>';
        $xml .= '<expire-date><![CDATA[' . $data['client_id'] . ']]></expire-date>';
        $xml .= '<industry><![CDATA[' . $data['client_id'] . ']]></industry>';
        $xml .= '<education><![CDATA[' . $data['client_id'] . ']]></education>';
        $xml .= '<experience><![CDATA[' . $data['client_id'] . ']]></experience>';
        $xml .= '<Contact hideCompanyName="true">';
        $xml .= '<Name><![CDATA[' . $data['client_id'] . ']]></Name>';
        $xml .= '<Phone><![CDATA[' . $data['client_id'] . ']]></Phone>';
        $xml .= '<Email><![CDATA[' . $data['client_id'] . ']]></Email>';
        $xml .= '</Contact>';
        $xml .= '<ApplyOnlineURL><![CDATA[' . $data['client_id'] . ']]></ApplyOnlineURL>';
        $xml .= '</job>';
        $xml .= '</jobs>';

        $response = response($xml, 200);
        $response->header('Content-Type', 'text/xml');
        return $response;
        
    }
    public function jobisjob(){

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://static.jobisjob.com/feed/jobs.xsd">';
        $xml .= '<jobs>';
        $xml .= '<job>';
        $xml .= '<job-id>  </job-id>';
        $xml .= '<title><![CDATA[ COMPULSORY - Title of the job offer ]]></title>';
        $xml .= '<description>';
        $xml .= '<full-text><![CDATA[ COMPULSORY - Full, unshortened description. Avoid any html tags ]]></full-text>';
        $xml .= '<skill><![CDATA[ optional ]]></skill>';
        $xml .= '<skill><![CDATA[ optional ]]></skill>';
        $xml .= '</description>';
        $xml .= '<location>';
        $xml .= '<address><![CDATA[ optional ]]></address>';
        $xml .= '<city><![CDATA[ COMPULSORY ]]></city>';
        $xml .= '<administrative-area><![CDATA[ optional ]]></administrative-area>';
        $xml .= '<postal-code><![CDATA[ optional ]]></postal-code>';
        $xml .= '<country><![CDATA[ COMPULSORY ]]></country>';
        $xml .= '</location>';
        $xml .= '<company-name><![CDATA[ if data present in your html version: COMPULSORY - Note that this tag is intended for the employer\'s name, NOT the jobboard\'s name! ]]></company-name>';
        $xml .= '<url><![CDATA[ COMPULSORY - Direct link to job offer ]]></url>';
        $xml .= '<compensation>';
        $xml .= '<salary><![CDATA[ if data present in your html version: COMPULSORY ]]></salary>';
        $xml .= '<salary-currency><![CDATA[ optional ]]></salary-currency>';
        $xml .= '<other><![CDATA[ optional ]]></other>';
        $xml .= '</compensation>';
        $xml .= '<job-type><![CDATA[ if data present in your html version: COMPULSORY ]]></job-type>';
        $xml .= '<categories>';
        $xml .= '<category><![CDATA[ optional, recommended - Job category, might be different than company industry ]]></category>';
        $xml .= '<category><![CDATA[ optional, recommended - Job category, might be different than company industry ]]></category>';
        $xml .= '</categories>';
        $xml .= '<insert-date><![CDATA[ 2010-01-21T11:11:38 ]]></insert-date>';
        $xml .= '<update-date><![CDATA[ 2010-02-01T15:21:43 ]]></update-date>';
        $xml .= '<expire-date><![CDATA[ 2010-03-21T11:11:38 ]]></expire-date>';
        $xml .= '<industry><![CDATA[ optional ]]></industry>';
        $xml .= '<education><![CDATA[ optional ]]></education>';
        $xml .= '<experience><![CDATA[ optional ]]></experience>';
        $xml .= '<job-level><![CDATA[ optional ]]></job-level>';
        $xml .= '<keywords><![CDATA[ optional ]]></keywords>';
        $xml .= '</job>';
        // ... Add more <job> elements as needed
        $xml .= '</jobs>';
        $xml .= '</data>';

        $response = response($xml, 200);
        $response->header('Content-Type', 'text/xml');
        return $response;

    }

    public function newMonster(){
        $industries=NewMonsterField::distinct()->get();
        // return $industries;
        return view('newjobportal.newMonster_form',compact('industries'));
    }
    
    public function sendToNewMonster(Request $request){
        return $request;
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
        $xml .= '<e-mail>jobs@monsterindia.co.in</E-mail>';
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
    public function sendtolearn4good(Request $request){
        return $request;
    }
}
