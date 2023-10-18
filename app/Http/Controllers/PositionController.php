<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\NewJobPostingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TimesjobController;
use App\Jobs\adzunaIndia_Job;
use App\Jobs\adzunaUSA_job;
use App\Jobs\careerjet_Job;
use App\Jobs\carrierblissJob;
use App\Jobs\clickIndiaJob;
use App\Jobs\cvLibrary_Job;
use App\Jobs\drJob_job;
use App\Jobs\facebookJob;
use App\Jobs\google_Job;
use App\Jobs\indeedJob;
use App\Jobs\jobsoraJob;
use App\Jobs\jobisjob_Job;
use App\Jobs\jobvertise_job;
use App\Jobs\joobleJob;
use App\Jobs\joraJob;
use App\Jobs\learn4good;
use App\Jobs\linkedinAts_Job;
use App\Jobs\linkedinJob;
use App\Jobs\monsterJob;
use App\Jobs\myJobHelper_Job;
use App\Jobs\naukriJob;
use App\Jobs\postJobFree_Job;
use App\Jobs\reedJob;
use App\Jobs\jobgrinJob;
use App\Jobs\jobrapidoJob;
// use App\Jobs\postJobFree;
use App\Jobs\shineJob;
use App\Jobs\talentJob;
use App\Jobs\tanqeeb_UAE_Job;
use App\Jobs\theIndiaJob;
use App\Jobs\timesAscent_Job;
use App\Jobs\timesjob;
use App\Jobs\timesjob_Job;
use App\Jobs\whatsJob;
use App\Jobs\whatsUSA_job;
use App\Jobs\ziprecruiter_USA_Job;
use App\Models\Candidate;
use App\Models\CandidateResponse;
use App\Models\Cities;
use App\Models\Client;
use App\Models\Country;
use App\Models\JobDescription;
use App\Models\JobPostedTo;
use App\Models\JobPostingModel;
use App\Models\JobsToClickIndia;
use App\Models\Jobstonoukri;
use App\Models\Jobs_to_google;
use App\Models\Jobs_to_timesjobs;
use App\Models\Job_to_facebooks;
use App\Models\Jora;
use App\Models\MonsterPostedJob;
use App\Models\Pipeline;
use App\Models\Portalresponse;
use App\Models\Position;
use App\Models\Shareposition;
use App\Models\Shine;
use App\Models\Stage;
use App\Models\State;
use App\Models\User;
use App\Models\Ziprecruiter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ClientAllotment;
use App\Models\Hr;
use App\Models\NewShineCities;
use App\Models\NewShineEducation;
use App\Models\NewShineEducationStream;
use App\Models\NewShineExperience;
use App\Models\NewShineFunctionalArea;
use App\Models\NewShineIndustries;
use App\Models\NewShineSalary;
use App\Models\NewMonsterFieldArea;
use Illuminate\Support\Facades\Cache;

class PositionController extends Controller
{
    public function index(Request $request)
    {


        // Check if the cached view exists
        $page = isset($request->page) ? $request->page : 1;
        $companyId = isset($request->id) ? $request->id : 0;
        if (Cache::has('position_list_cache_'.Auth::user()->id.'_'.$page.'_'.$companyId)) {
            return Cache::get('position_list_cache_'.Auth::user()->id.'_'.$page.'_'.$companyId);
        }

        $position_name = $request->global_position_search ?? '';
        if ($request->id) {
            $Positions = Position::with('portalResponse')->where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole'), 'client_id' => $request->id])->orderBy('id', 'DESC')->paginate(10);
            return view('pages.position.positionList', compact('Positions', 'position_name'));
        } else {
            $Positions = Position::with('portalResponse')->where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC');
            if (Auth::user()->role !== "admin") {

                $user = User::find(Auth::user()->id);
                if ($user->role == 'assistant_manager') {
                    //Assistant_manager
                    $manager = getParent($user->id, 1);
                    $teamIds = [$manager->parent->id, $manager->id, ...$manager->descendantIds()];
                } else if ($user->role == 'talent_acquisition') {
                    //talent_acquisition
                    $manager = getParent($user->id, 2);
                    $teamIds = [$manager->parent->id, $manager->id, ...$manager->descendantIds()];
                } else if ($user->role == 'manager') {
                    //Manager
                    $teamIds = [$user->parent->id, $user->id, ...$user->descendantIds()];
                } else {
                    //parent position
                    // $ascendantIds = $user->ascendantIds();
                    //child position
                    $descendantIds = $user->descendantIds();
                    $teamIds = [Auth::user()->id, ...$descendantIds];
                }

                $Positions = $Positions->whereIn('created_by', $teamIds);
            }
            $Positions = $Positions->paginate('8');
        }

        //Share By Me
        $shareByMeIds = array_unique(Shareposition::where('sharebyid', Auth::user()->id)->pluck('positionId')->toArray());
        $shareByMePositions = Position::whereIn('id', $shareByMeIds)->orderBy('id','DESC')->get();

        //Share With Me
        $shareWithMeIds = Shareposition::where('sharetoId', Auth::user()->id)->pluck('positionId')->toArray();
        $shareWithMePositions = Position::whereIn('id', $shareWithMeIds)->orderBy('id','DESC')->get();
        // return view('pages.position.positionList', compact('Positions', 'position_name', 'shareByMePositions', 'shareWithMePositions'));

        $view = view('pages.position.positionList', compact('Positions', 'position_name', 'shareByMePositions', 'shareWithMePositions'))->render();

        // If not cached, render the view and cache it
        // $view = view('your.view.name');
        $cachedView = Cache::remember('position_list_cache_'.Auth::user()->id.'_'.$page.'_'.$companyId, 300, function () use ($view) {
            return $view;
        });

        return $cachedView;


    }

    public function positionInfo(Request $request, $id)
    {
        $position = Position::with('findClientGet')->where(['id' => $id, 'software_category' => (Auth::user()->software_category ?? 'onrole')])->find($id);
        return view('pages.position.positiondetails', compact('position', 'id'));
    }

    public function editPosition($id)
    {
        $position = Position::find($id);
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        if (in_array(Auth::user()->role, ['manager', 'assistant_manager', 'talent_acquisition'])) {
            $getupperHierarchy = User::where('software_category', Auth::user()->software_category)->whereIn('role', ['admin', 'business_head', 'general_manager'])->pluck('id')->toArray();
            $parentids = array_diff($currentUser->ascendantIds(), $getupperHierarchy);
            $childUsers = array_merge($childUsers, $parentids);
        }
        array_unshift($childUsers, $currentUser->id);

        $allotted_clients = ClientAllotment::whereIn('alloted_to', $childUsers)->pluck('client_id')->toArray();
        $clients = Client::where(function ($query) use ($childUsers, $allotted_clients) {
            $query->whereIn('created_by', $childUsers)
                ->orWhereIn('id', $allotted_clients);
        })->where('is_active', 1)->where('software_category', Auth::user()->software_category)->orderBy("name", "asc")->get();
        $CountryList = Country::get();

        $cities = Cities::get();
        $jobDescriptions = JobDescription::get();
        return view('pages.position.editPosition', compact('position', 'countryList', 'clients', 'jobDescriptions', 'cities'));
    }
    public function positionSearch(Request $request)
    {
        $keyword = request('search');
        $Position = Position::where('position_name', 'LIKE', "%$keyword%")->orderBy('id', 'DESC')->paginate(25);
        return view('pages.position.PositionList', compact('Position'));
    }

    public function renderDescendants(User $node)
    {
        // $html = '<li>' . $node->name;
        // if ($node->descendants->isNotEmpty()) {
        //     $html .= '<ul>';
        //     foreach ($node->descendants as $descendant) {
        //         $html .= $this->renderDescendants($descendant);
        //     }
        //     $html .= '</ul>';
        // }
        // $html .= '</li>';
        return $node;
    }
    public function getDescription($id)
    {
        $jobDescriptions = JobDescription::where('id', $id)->first();
        $description = $jobDescriptions->description;
        return response($description);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        if (in_array(Auth::user()->role, ['manager', 'assistant_manager', 'talent_acquisition'])) {
            $getupperHierarchy = User::where('software_category', Auth::user()->software_category)->whereIn('role', ['business_head', 'general_manager'])->pluck('id')->toArray();
            array_push($getupperHierarchy, 1);
            $parentids = array_diff($currentUser->ascendantIds(), $getupperHierarchy);
            $childUsers = array_merge($childUsers, $parentids);
        }
        array_unshift($childUsers, $currentUser->id);

        $allotted_clients = ClientAllotment::whereIn('alloted_to', $childUsers)->pluck('client_id')->toArray();
        $Clients = Client::where(function ($query) use ($childUsers, $allotted_clients) {
            $query->whereIn('created_by', $childUsers)
                ->orWhereIn('id', $allotted_clients);
        })->where('is_active', 1)->where('software_category', Auth::user()->software_category)->orderBy("name", "asc")->get();
        $CountryList = Country::get();
        $cities = Cities::get();
        $jobDescriptions = JobDescription::get();

        return view('pages.position.addPosition', compact('CountryList', 'Clients', 'jobDescriptions', 'cities'));
    }


    public function store(Request $request)
    {
    //    return $request;
        $selectedPortals = $request->jobPortals;

        $Position = new Position();
        $Position->client_id = request('client_id');
        $Position->jd_json = request('jd_json');
        $Position->position_Name = request('position_name');
        $Position->openings = request('openings');
        $Position->job_description = request('job_description');
        $Position->management_fee = request('management_fee');
        $Position->flat_amount = request('flat_amount');
        $Position->min_year_exp = request('min_year_exp');
        $Position->max_year_exp = request('max_year_exp');
        $Position->specification = request('specification');
        $Position->salary_type = request('salary_type');
        $Position->pay_type = request('pay_type');
        $Position->min_salary = request('min_salary');
        $Position->max_salary = request('max_salary');

        $Position->job_type = request('job_type');
        $Position->industry = request('industry');


        $Position->gender = request('gender');
        $Position->is_remote_work = request('is_remote_work') ?? 0;

        $countries = Country::where('id', request('countries'))->value('name');
        $states = State::where('id', request('states'))->value('name');
        $city = Cities::where('id', request('city'))->value('name');

        $Position->countries = $countries ?? 'Update country';
        $Position->states = $states ?? 'Update State';
        $Position->city = $city ?? 'Update City';

        $Position->locations = $city ?? 'Update Location';
        $Position->job_address = $city ?? 'Update Address';

        $Position->postal_code = request('postal_code');
        $skills = implode(',', $request->skill_set ?? 'No Skills Found');
        $Position->skill_set = $skills;
        $Position->edu_qualification = request('edu_qualification');
        $Position->close_Date = Carbon::parse(request('close_date'))->format('Y-m-d');
        $Position->contact_person_name = Auth::user()->name ?? '-';
        $Position->person_email = Auth::user()->email ?? '-';
        $Position->person_contact = Auth::user()->contact ?? '-';
        $Position->software_category = Auth::user()->software_category ?? 'onrole';
        $Position->created_by = Auth::user()->id;
        $Position->save();

        $Position->clientname = $Position->findClientGet->name ?? '-';
        $Position->save();
       

        $dispach_time = getDispatchTime();

        if ($Position->save()) {
            $job_id = $Position->id;
            $job_posting = new JobPostingModel();
            $job_posting->job_id = $Position->id;
            $job_posting->save();

            $TimesjobController = new TimesjobController();
            $commoncontroller = new CommonController();
            $reference_no  = $Position->random_no;  //from job_posted_tos

            if (in_array('linkedin', $selectedPortals)) {
                $linkedinArr = [
                    'job_id' => $job_id,
                    'reference_no' => $reference_no,
                    'auth_id' => Auth::user()->id,
                    'job_description' => request('job_description_linkedin')
                ];

                //Job Dispatch
                // return (new CommonController())->sendToLinkedin($linkedinArr['job_id']);
                linkedinJob::dispatch($linkedinArr)->delay($dispach_time);
            }
            if (in_array('shine', $selectedPortals)) {   //completed//

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'shine';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $shine = new Shine();
                $shine->job_id = $job_id;
                // $shine->city_grouping_id = request('shine_cities_groups_id');
                $shine->city_id = request('shine_cities_id');
                $shine->city_id = implode(', ',$shine->city_id);
                $shine->industry_id = request('shine_industries_id');
                $shine->study_field_grouping_id = request('shine_study_field_grouping_id');
                $shine->study_field_grouping_id = implode(', ',$shine->study_field_grouping_id);
                $shine->study_id = request('shine_study_id');
                $shine->study_id = implode(', ',$shine->study_id);
                $shine->functional_area_id = request('shine_functional_areas_id');
                $shine->functional_area_id = implode(', ',$shine->functional_area_id);
                $shine->min_experience_id = $request->shine_min_experience_id;
                $shine->max_experience_id = $request->shine_max_experience_id;
                $shine->min_salary_id = $request->shine_min_salary_id;
                $shine->max_salary_id = $request->shine_max_salary_id;
                $shine->save();

                //Job Dispatch
                // return (new CommonController())->sendToShine($job_id);
                // shineJob::dispatch($job_id);
                shineJob::dispatch($job_id)->delay($dispach_time);
                // shineJob::dispatch($job_id);
            }
            if (in_array('clickIndia', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'clickindia';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $job_to_click_india = new JobsToClickIndia();
                $job_to_click_india->job_id = $job_id;
                $job_to_click_india->job_category_id = request('click_india_job_category');
                $job_to_click_india->city_id = request('click_india_city_id');
                // $job_to_click_india->city_name = request('click_india_city_name');
                $job_to_click_india->minimum_qualification = request('click_india_minimum_qualification');
                $job_to_click_india->minimum_experience = request('click_india_minimum_experience');
                // $job_to_click_india->required_candidate = request('click_india_required_candidate');
                $job_to_click_india->working_days = json_encode(request('click_india_working_days'));
                $job_to_click_india->hiring_process = request('click_india_hiring_process');
                $job_to_click_india->save();

                //Job Dispatch
                // return (new CommonController())->sendToClickIndia($job_id,Auth::user()->id);
                // return (new CommonController())->sendToClickIndia($job_id, Auth::user()->id);
                clickIndiaJob::dispatch($job_id, Auth::user()->id)->delay($dispach_time);
            }
            if (in_array('monster', $selectedPortals)) {  //done//

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'monster';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $monster = new MonsterPostedJob();
                $monster->job_id = $job_id;
                $monster->industry_id = request('monster_industry_id');
                $monster->category_function_id = request('monster_category_function_id');
                $monster->category_role_id = request('category_role_id');
                $monster->monster_education_level_id = request('monster_education_level_id');
                $monster->monster_education_stream_id = request('monster_education_stream_id');
                $monster->monster_location_id = request('monster_location');
                $monster->save();


                //Job Dispatch
                // return (new CommonController())->sendToMonster($job_id);
                monsterJob::dispatch($job_id)->delay($dispach_time);
                // monsterJob::dispatch($job_id);
            }
            if (in_array('jobIsJob', $selectedPortals)) {    //done//

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'jobisjob';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                //Job Dispatch
                // return (new CommonController())->sendToJobisjob($job_id);
                jobisjob_Job::dispatch($job_id)->delay($dispach_time);
               
            }
            if (in_array('careerJet', $selectedPortals)) {    //done//

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'careerjet';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                //Job Dispatch
                // return (new CommonController())->sendToCareerjet($job_id);
                careerjet_Job::dispatch($job_id)->delay($dispach_time);
                // careerjet_Job::dispatch($job_id);
            }
            if (in_array('postJobFree', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'postjobfree';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                //Job Dispatch
                // return (new CommonController())->sendToPostjobsfree($job_id);
                // postJobFree_Job::dispatch($job_id);
                postJobFree_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('jora', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'jora';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $jora = new Jora();
                $jora->job_id = $job_id;
                $jora->industry_id = request('Jora_industry_id');
                $jora->category_function_id = request('Jora_category_function_id');
                $jora->education_level_id = request('Jora_education_level_id');
                $jora->save();
                // return (new CommonController())->sendToJora($job_id);
                joraJob::dispatch($job_id)->delay($dispach_time);
                // joraJob::dispatch($job_id);
            }
            if (in_array('naukri', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'noukri';
                $job_posted_tos->user_id = Auth::user()->id;

                $job_posted_tos->save();

                $job_to_noukri = new  jobstonoukri();
                $job_to_noukri->jobs_id = $job_id;
                $job_to_noukri->UG_Qualifications = request('UG_Qualifications');
                $job_to_noukri->UG_Specializations = request('UG_Specializations');
                $job_to_noukri->PG_Qualifications = request('PG_Qualifications');
                $job_to_noukri->PG_Specializations = request('PG_Specializations');
                $job_to_noukri->Functional_Area = request('Functional_Area');
                $job_to_noukri->Functional_role = request('Functional_role');
                $job_to_noukri->Industry_Mapping = request('Industry_Mapping');
                $job_to_noukri->noukri_Country = request('noukri_Country');
                $job_to_noukri->noukri_City = request('noukri_City');
                $job_to_noukri->Minimum_Experience = request('Minimum_Experience');
                $job_to_noukri->Maximum_Experience = request('Maximum_Experience');
                $job_to_noukri->Minimum_Salary = request('Minimum_Salary');
                $job_to_noukri->Maximum_Salary = request('Maximum_Salary');
                $job_to_noukri->noukri_job_description = request('noukri_job_description');
                $job_to_noukri->naukri_job_type = request('naukri_job_type');
                $job_to_noukri->save();
                // return (new CommonController())->sendTonoukri($job_id);
                naukriJob::dispatch($job_id)->delay($dispach_time);
                // naukriJob::dispatch($job_id);
            }
            if (in_array('indeed', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'indeed';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                // return (new CommonController())->sendToIndeed($job_id);
                indeedJob::dispatch($job_id)->delay($dispach_time);
                // indeedJob::dispatch($job_id);
            }
            if (in_array('jooble', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'Jooble';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $currency = request('Jooble_currency') ?? 'r';
                // return (new CommonController())->sendToJooble($job_id, $currency);
                joobleJob::dispatch($job_id, $currency)->delay($dispach_time);
            }
            if (in_array('timesjob', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'timesjobs';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $Jobs_to_timesjobs = new Jobs_to_timesjobs();
                $Jobs_to_timesjobs->job_id = $job_id;
                $Jobs_to_timesjobs->times_min_year_exp = request('times_minYearExp');
                $Jobs_to_timesjobs->times_max_year_exp = request('times_maxYearExp');
                $Jobs_to_timesjobs->times_location = json_encode(request('times_location'));
                $Jobs_to_timesjobs->times_location_others = request('times_location_others');
                $Jobs_to_timesjobs->times_currency = request('times_currency');
                $Jobs_to_timesjobs->times_show_salary = request('times_show_salary');
                $Jobs_to_timesjobs->times_min_salary_lakh = request('times_min_salary_lakh');
                $Jobs_to_timesjobs->times_min_salary_thousand = request('times_min_salary_thousand');
                $Jobs_to_timesjobs->times_max_salary_lakh = request('times_max_salary_lakh');
                $Jobs_to_timesjobs->times_max_salary_thousand = request('times_max_salary_thousand');
                $Jobs_to_timesjobs->times_industry = json_encode(request('times_industry'));
                $Jobs_to_timesjobs->times_industry_others = request('times_industry_others');
                $Jobs_to_timesjobs->times_farea = json_encode(request('times_farea'));
                $Jobs_to_timesjobs->times_area_Of_Spec = json_encode(request('times_areaOfSpec'));
                $Jobs_to_timesjobs->times_Fa_Roles = json_encode(request('times_FaRoles'));
                $Jobs_to_timesjobs->times_farea_others = request('times_farea_others');
                $Jobs_to_timesjobs->times_Graduation = request('times_Graduation');
                $Jobs_to_timesjobs->times_Graduation_Course = json_encode(request('times_Graduation_Course'));
                $Jobs_to_timesjobs->times_Graduation_Specialisation = request('times_Graduation_Specialisation');
                $Jobs_to_timesjobs->times_post_Graduation = request('times_post_Graduation');
                $Jobs_to_timesjobs->times_post_Graduation_Course = json_encode(request('times_post_Graduation_Course'));
                $Jobs_to_timesjobs->times_post_Graduation_Specialisation = request('times_post_Graduation_Specialisation');
                $description = request('times_job_description');
                $times_job_description = str_replace(array(
                    '\'', '"',
                    ',', ';', '<', '>', '&', '●', ':', '-'
                ), ' ', $description);
                $Jobs_to_timesjobs->times_job_description = $times_job_description;
                $Jobs_to_timesjobs->save();
                // return (new TimesjobController())->sendTotimesjobs($job_id);
                timesjob_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('facebook', $selectedPortals)) {

                $Job_to_faecbook = new Job_to_facebooks();
                $Job_to_faecbook->job_id = $job_id;
                $Job_to_faecbook->save();

                facebookJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('google', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'google';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $Jobs_to_google = new Jobs_to_google();
                $Jobs_to_google->job_id = $job_id;
                $Jobs_to_google->employment_type = request('employment_type');
                $Jobs_to_google->save();

                $api_hit = file_get_contents("https://happiestresume.com/google_final/index.php?jobId=$job_id");

                if($api_hit == 200){
                    $response = new Portalresponse();
                    $response->portal = 'google';
                    $response->response = 'Job Posted In Google Portal';
                    $response->job_id = $job_id;
                    $response->is_success = 1;
                    $response->save();
                }
            }
            if (in_array('whatJobs', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'whatsjob';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                //Job Dispatch
                whatsJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('drJob', $selectedPortals)) {

                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'drjobs';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                //Job Dispatch
                // return (new CommonController())->sendtodrjobs($job_id);
                drJob_job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('adzuna_india', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'adzuna';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                //Job Dispatch
                // return (new CommonController())->sendtoadzuna($job_id);
                adzunaIndia_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('linkedinATS', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'linkedin_paid';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                // return (new CommonController())->LinkedinAts($job_id);
                linkedinAts_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('jobsora', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'jobsora';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                jobsoraJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('learn4good', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'learn4good';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
               learn4good::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('jobgrin', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'jobgrin';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                jobgrinJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('careerbliss', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'careerbliss';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                carrierblissJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('theindiajobs', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'theindiajobs';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                theIndiaJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('jobrapido', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'jobrapido';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                jobrapidoJob::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('talent', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'talent';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
               
                //Job Dispatch
                // return (new NewJobPostingController())->sendTojobsora($job_id);
                talentJob::dispatch($job_id)->delay($dispach_time);
            }

            //------------------international portal------------

            if (in_array('job_vertise_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'job_vertise';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                // return (new CommonController())->sendTojobvertise($job_id);
                jobvertise_job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('my_job_helper_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'my_job_helper';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                // return (new CommonController())->sendtohelper($job_id);
                myJobHelper_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('cv_libaray_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'CvLibrary';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                cvLibrary_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('adzuna_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'adzunausa';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                adzunaUSA_job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('whatjobs_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'whatsjobusa';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                whatsUSA_job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('ziprecruiter_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'ziprecruiter';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                $ziprecruiter_jobs = new Ziprecruiter();
                $ziprecruiter_jobs->job_id = $job_id;
                $ziprecruiter_jobs->experience = request('experience');
                $ziprecruiter_jobs->education = request('education');
                $ziprecruiter_jobs->pay_type = request('pay_type');
                $ziprecruiter_jobs->save();

                // return (new CommonController())->sendToziprecruiter($job_id);
                ziprecruiter_USA_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('times_ascent_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'timesascent';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                timesAscent_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('tanqeeb_inter', $selectedPortals)) {
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'tanqeeb';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();

                tanqeeb_UAE_Job::dispatch($job_id)->delay($dispach_time);
            }
            if (in_array('reed', $selectedPortals)) {
                $reedInfo=[
                    "job_id"=>$job_id,
                    "reed_job_type"=> $request->reed_job_type,
                    "reed_working_hour"=> $request->reed_working_hour,
                    "reed_currency_type"=>$request->reed_currency_type,
                    "reed_salary_type"=> $request->reed_salary_type,
                ];
                $job_posted_tos = new JobPostedTo();
                $job_posted_tos->job_id = $job_id;
                $job_posted_tos->reference_no = $reference_no;
                $job_posted_tos->publish_to = 'reed';
                $job_posted_tos->user_id = Auth::user()->id;
                $job_posted_tos->save();
                // return (new NewJobPostingController())->sendToReed($reedInfo);
                reedJob::dispatch($reedInfo)->delay($dispach_time);
            }
        }
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return back()->with('success', 'Position Added Successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Position = Position::find($id);
        $Position->is_active = 0;
        $Position->save();
        return redirect('position');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        // return $position;
        // $id = $position->id;
        // return $position;
        $Clients = Client::where(['is_active' => 1, 'software_category' => Auth::user()->software_category])->get();
        $CountryList = Country::get();
        $cities = Cities::get();
        $jobDescriptions = JobDescription::get();
        // return $cities;
        return view('pages.position.editPosition', compact('CountryList', 'Clients', 'jobDescriptions', 'cities', 'position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {

        $selectedPortals = $request->jobPortals;

        $Position = Position::find($position->id);

        $Position->jd_json = $request->jd_json;
        $Position->client_id = $request->client_id;
        $Position->position_name = $request->position_name;
        $Position->management_fee = $request->management_fee;
        $Position->flat_amount = $request->flat_amount;
        $Position->locations = $request->locations;
        $Position->close_date = $request->close_date;
        $Position->openings = $request->openings;
        $Position->is_remote_work = $request->is_remote_work;
        $Position->postal_code = $request->postal_code;
        $Position->skill_set = $request->skill_set;
        $Position->locations = $request->localtion;
        $Position->job_description = $request->job_description;
        $Position->specification = $request->specification;
        $Position->salary_type = $request->salary_type;
        $Position->pay_type = $request->pay_type;
        $Position->min_salary = $request->min_salary;
        $Position->max_salary = $request->max_salary;
        $Position->job_type = $request->job_type;
        $Position->min_year_exp = $request->min_year_exp;
        $Position->max_year_exp = $request->max_year_exp;
        $Position->edu_qualification = $request->edu_qualification;
        $Position->industry = $request->industry;
        $Position->job_address = $request->job_address;
        $Position->gender = $request->gender;
        $Position->is_local = $request->is_local;
        $Position->status = 'active';
        $Position->software_category = (Auth::user()->software_category ?? 'onrole');


        $countries = Country::where('id', request('countries'))->value('name');
        $states = State::where('id', request('states'))->value('name');
        $city = Cities::where('id', request('city'))->value('name');

        $Position->countries = $countries;
        $Position->states = $states;
        $Position->city = $city;
        $Position->job_address = $city;
        $Position->locations = $city;
        $Position->is_active = 1;
        $Position->update();


        $Position->clientname = $Position->findClientGet->name ?? '-';
        $Position->update();

        $check_job_posting = JobPostingModel::where('job_id', $Position->id)->first();
        if ($check_job_posting == "") {
            $job_posting = new JobPostingModel();
            $job_posting->job_id = $Position->id;
            $job_posting->save();
        }

        $dispach_time = getDispatchTime();

        if ($Position->save()) {
            $job_id = $Position->id;

            $job_posting = new JobPostingModel();
            $job_posting->job_id = $Position->id;
            $job_posting->save();

            $TimesjobController = new TimesjobController();
            $commoncontroller = new CommonController();
            $reference_no = $Position->random_no;
            if ($selectedPortals > 0) {

                if (in_array('linkedin', $selectedPortals)) {
                    $linkedinArr = [
                        'job_id' => $job_id,
                        'reference_no' => $reference_no,
                        'auth_id' => Auth::user()->id,
                        'job_description' => request('job_description_linkedin')
                    ];

                    //Job Dispatch
                    return (new CommonController())->sendToLinkedin($linkedinArr['job_id']);
                    linkedinJob::dispatch($linkedinArr)->delay($dispach_time);
                }
                if (in_array('shine', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'shine';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $shine = new Shine();
                    $shine->job_id = $job_id;
                    $shine->city_grouping_id = request('shine_cities_groups_id');
                    $shine->city_id = json_encode(request('shine_cities_id'));
                    $shine->industry_id = request('shine_industries_id');
                    $shine->study_field_grouping_id = json_encode(request('shine_study_field_grouping_id'));
                    $shine->study_id = json_encode(request('shine_study_id'));
                    $shine->functional_area_id = json_encode(request('shine_functional_areas_id'));
                    $shine->min_experience_id = $request->shine_min_experience_id;
                    $shine->max_experience_id = $request->shine_max_experience_id;
                    $shine->min_salary_id = $request->shine_min_salary_id;
                    $shine->max_salary_id = $request->shine_max_salary_id;
                    $shine->save();

                    //Job Dispatch
                    shineJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('clickIndia', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'clickindia';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $job_to_click_india = new JobsToClickIndia();
                    $job_to_click_india->job_id = $job_id;
                    $job_to_click_india->job_category_id = request('click_india_job_category');
                    $job_to_click_india->city_id = request('click_india_city_id');
                    $job_to_click_india->city_name = request('click_india_city_name');
                    $job_to_click_india->minimum_qualification = request('click_india_minimum_qualification');
                    $job_to_click_india->minimum_experience = request('click_india_minimum_experience');
                    // $job_to_click_india->required_candidate = request('click_india_required_candidate');
                    $job_to_click_india->working_days = json_encode(request('click_india_working_days'));
                    $job_to_click_india->hiring_process = request('click_india_hiring_process');
                    $job_to_click_india->save();

                    //Job Dispatch
                    
                    clickIndiaJob::dispatch($job_id, Auth::user()->id)->delay($dispach_time);
                }
                if (in_array('monster', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'monster';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $monster = new MonsterPostedJob();
                    $monster->job_id = $job_id;
                    $monster->industry_id = request('monster_industry_id');
                    $monster->category_function_id = request('category_function_id');
                    $monster->category_role_id = request('category_role_id');
                    $monster->monster_education_level_id = request('monster_education_level_id');
                    $monster->monster_education_stream_id = request('monster_education_stream_id');
                    $monster->monster_location_id = request('monster_location');
                    $monster->save();

                    //Job Dispatch
                    monsterJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jobIsJob', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'jobisjob';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    //Job Dispatch
                    jobisjob_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('careerJet', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'careerjet';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                    //Job Dispatch
                    careerjet_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('postJobFree', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'postjobfree';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                    //Job Dispatch
                    postJobFree_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jora', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'jora';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $jora = new Jora();
                    $jora->job_id = $job_id;
                    $jora->industry_id = request('Jora_industry_id');
                    $jora->category_function_id = request('Jora_category_function_id');
                    $jora->education_level_id = request('Jora_education_level_id');
                    $jora->save();

                    joraJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('naukri', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'noukri';
                    $job_posted_tos->user_id = Auth::user()->id;

                    $job_posted_tos->save();

                    $job_to_noukri = new  jobstonoukri();
                    $job_to_noukri->jobs_id = $job_id;
                    $job_to_noukri->UG_Qualifications = request('UG_Qualifications');
                    $job_to_noukri->UG_Specializations = request('UG_Specializations');
                    $job_to_noukri->PG_Qualifications = request('PG_Qualifications');
                    $job_to_noukri->PG_Specializations = request('PG_Specializations');
                    $job_to_noukri->Functional_Area = request('Functional_Area');
                    $job_to_noukri->Functional_role = request('Functional_role');
                    $job_to_noukri->Industry_Mapping = request('Industry_Mapping');
                    $job_to_noukri->noukri_Country = request('noukri_Country');
                    $job_to_noukri->noukri_City = request('noukri_City');
                    $job_to_noukri->Minimum_Experience = request('Minimum_Experience');
                    $job_to_noukri->Maximum_Experience = request('Maximum_Experience');
                    $job_to_noukri->Minimum_Salary = request('Minimum_Salary');
                    $job_to_noukri->Maximum_Salary = request('Maximum_Salary');
                    $job_to_noukri->noukri_job_description = request('noukri_job_description');
                    $job_to_noukri->naukri_job_type = request('naukri_job_type');
                    $job_to_noukri->save();

                    naukriJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('indeed', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'indeed';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    indeedJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jooble', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'Jooble';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $currency = request('Jooble_currency') ?? 'r';

                    joobleJob::dispatch($job_id, $currency)->delay($dispach_time);
                }
                if (in_array('timesjob', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'timesjobs';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $Jobs_to_timesjobs = new Jobs_to_timesjobs();
                    $Jobs_to_timesjobs->job_id = $job_id;
                    $Jobs_to_timesjobs->times_min_year_exp = request('times_minYearExp');
                    $Jobs_to_timesjobs->times_max_year_exp = request('times_maxYearExp');
                    $Jobs_to_timesjobs->times_location = json_encode(request('times_location'));
                    $Jobs_to_timesjobs->times_location_others = request('times_location_others');
                    $Jobs_to_timesjobs->times_currency = request('times_currency');
                    $Jobs_to_timesjobs->times_show_salary = request('times_show_salary');
                    $Jobs_to_timesjobs->times_min_salary_lakh = request('times_min_salary_lakh');
                    $Jobs_to_timesjobs->times_min_salary_thousand = request('times_min_salary_thousand');
                    $Jobs_to_timesjobs->times_max_salary_lakh = request('times_max_salary_lakh');
                    $Jobs_to_timesjobs->times_max_salary_thousand = request('times_max_salary_thousand');
                    $Jobs_to_timesjobs->times_industry = json_encode(request('times_industry'));
                    $Jobs_to_timesjobs->times_industry_others = request('times_industry_others');
                    $Jobs_to_timesjobs->times_farea = json_encode(request('times_farea'));
                    $Jobs_to_timesjobs->times_area_Of_Spec = json_encode(request('times_areaOfSpec'));
                    $Jobs_to_timesjobs->times_Fa_Roles = json_encode(request('times_FaRoles'));
                    $Jobs_to_timesjobs->times_farea_others = request('times_farea_others');
                    $Jobs_to_timesjobs->times_Graduation = request('times_Graduation');
                    $Jobs_to_timesjobs->times_Graduation_Course = json_encode(request('times_Graduation_Course'));
                    $Jobs_to_timesjobs->times_Graduation_Specialisation = request('times_Graduation_Specialisation');
                    $Jobs_to_timesjobs->times_post_Graduation = request('times_post_Graduation');
                    $Jobs_to_timesjobs->times_post_Graduation_Course = json_encode(request('times_post_Graduation_Course'));
                    $Jobs_to_timesjobs->times_post_Graduation_Specialisation = request('times_post_Graduation_Specialisation');
                    $description = request('times_job_description');
                    $times_job_description = str_replace(array(
                        '\'', '"',
                        ',', ';', '<', '>', '&', '●', ':', '-'
                    ), ' ', $description);
                    $Jobs_to_timesjobs->times_job_description = $times_job_description;
                    $Jobs_to_timesjobs->save();

                    timesjob_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('facebook', $selectedPortals)) {

                    $Job_to_faecbook = new Job_to_facebooks();
                    $Job_to_faecbook->job_id = $job_id;
                    $Job_to_faecbook->save();

                    facebookJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('google', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'google';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $Jobs_to_google = new Jobs_to_google();
                    $Jobs_to_google->job_id = $job_id;
                    $Jobs_to_google->employment_type = request('employment_type');
                    $Jobs_to_google->save();

                    //Job Dispatch
                    google_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('whatJobs', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'whatsjob';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    //Job Dispatch
                    whatsJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('drJob', $selectedPortals)) {

                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'drjobs';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    //Job Dispatch
                    drJob_job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('adzuna_india', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'adzuna';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    //Job Dispatch
                    adzunaIndia_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('linkedinATS', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'linkedin_paid';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    linkedinAts_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jobsora', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'jobsora';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                    jobsoraJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('learn4good', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'learn4good';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                   
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                   learn4good::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jobgrin', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'jobgrin';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                   
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                    jobgrinJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('careerbliss', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'careerbliss';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                   
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                    carrierblissJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('theindiajobs', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'theindiajobs';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                   
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                    theIndiaJob::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('jobrapido', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'jobrapido';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                   
                    //Job Dispatch
                    // return (new NewJobPostingController())->sendTojobsora($job_id);
                    jobrapidoJob::dispatch($job_id)->delay($dispach_time);
                }
                //-----------international portal------------
                if (in_array('job_vertise_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'job_vertise';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    jobvertise_job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('my_job_helper_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'my_job_helper';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    myJobHelper_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('cv_libaray_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'CvLibrary';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    cvLibrary_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('adzuna_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'adzunausa';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    adzunaUSA_job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('whatjobs_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'whatsjobusa';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    whatsUSA_job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('ziprecruiter_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'ziprecruiter';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    $ziprecruiter_jobs = new Ziprecruiter();
                    $ziprecruiter_jobs->job_id = $job_id;
                    $ziprecruiter_jobs->experience = request('experience');
                    $ziprecruiter_jobs->education = request('education');
                    $ziprecruiter_jobs->pay_type = request('pay_type');
                    $ziprecruiter_jobs->save();

                    ziprecruiter_USA_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('times_ascent_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'timesascent';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    timesAscent_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('tanqeeb_inter', $selectedPortals)) {
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'tanqeeb';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();

                    tanqeeb_UAE_Job::dispatch($job_id)->delay($dispach_time);
                }
                if (in_array('reed', $selectedPortals)) {
                    $reedInfo=[
                        "job_id"=>$job_id,
                        "reed_job_type"=> $request->reed_job_type,
                        "reed_working_hour"=> $request->reed_working_hour,
                        "reed_currency_type"=>$request->reed_currency_type,
                        "reed_salary_type"=> $request->reed_salary_type,
                    ];
                    $job_posted_tos = new JobPostedTo();
                    $job_posted_tos->job_id = $job_id;
                    $job_posted_tos->reference_no = $reference_no;
                    $job_posted_tos->publish_to = 'reed';
                    $job_posted_tos->user_id = Auth::user()->id;
                    $job_posted_tos->save();
                    // return (new NewJobPostingController())->sendToReed($reedInfo);
                    reedJob::dispatch($reedInfo)->delay($dispach_time);
                }
            }
        }
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect('position')->with('success', 'Position Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::where('id', $id)->firstorfail()->delete();
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return back()->with('success', 'Position Deleted Successfully.');
    }



    public function pipelineBird($id)
    {
        $positionId = $id;
        $candidateList = "";
        $candidateList = Candidate::where('created_by', Auth::user()->id)->get();
        $stages = Stage::where('positionId', $positionId)->get();
        return view('pages.position.pipeline_bird', compact('positionId', 'stages', 'candidateList'));
    }

    public function addtoipeline(Request $request)
    {
        $CandList = $request->addtopipeline;
        foreach ($CandList as $candidates) {
            $Pipeline = Pipeline::where('candidate_id', $candidates)->count();
            if ($Pipeline == '0') {
                $stage = new Stage();
                $stage->positionId = $request->positionId;
                $stage->stageName = "Sourcing";
                $stage->save();
                $pipeline = new Pipeline();
                $pipeline->candidate_id = $candidates;
                $pipeline->position_id = $request->positionId;
                $pipeline->status = "Sourcing";
                $pipeline->stage_id = $stage->id;
                $pipeline->created_by = Auth::user()->id;
                $pipeline->save();
                $candidate = Candidate::where('id', $candidates)->update(['stageId' => $stage->id, 'positionId' => $request->positionId]);
                Session::flash('success', 'Candidate Added in Pipeline.');
            } else {
                Session::flash('success', 'Candidate Already Exist in Pipeline.');
            }
        }
        return redirect('position')->with('msg', 'send');
    }

    public function positionhold($positionId)
    {

        $Position = Position::find($positionId);
        if ($Position->is_hold == 0) {
            $Position->is_hold = 1;
            $Position->update();
        }
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect()->back()->with('success', 'Position has been hold Successfully');
    }
    public function positionunhold($positionId)
    {
        // return $positionId;
        $Position = Position::find($positionId);
        // return $Position->is_hold;
        if ($Position->is_hold == 1) {
            $Position->is_hold = 0;
            $Position->update();
            // return $Position;
        }
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect()->back()->with('success', 'Position has been Opened Successfully');
    }

    public function positionclose($positionId)
    {
        $Position = Position::find($positionId);
        $Position->is_close = 1;
        $Position->update();
        // return $Position;
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect()->back()->with('success', 'Position has been Closed Successfully');
    }
    public function positionopen($positionId)
    {
        $Position = Position::find($positionId);
        if ($Position->is_close == 1) {
            $Position->is_close = 0;
            $Position->update();
        }
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect()->back()->with('success', 'Position has been Opened Successfully');
    }


    public function stagechange($id, $stage)
    {
        $stage = Stage::find($id);
        $stage->stageName = "telephonic";
        $stage->update();
        return redirect()->back()->with('success', 'stage is change Successfully');
    }
    public function appliedCandidate($positionId)
    {
        $stageId = Stage::where('positionId', $positionId)->pluck('id');
        $appliedCandidate = Candidate::whereIn('stageId', $stageId)->get();
        return view('pages.candidate.positionCandidate', compact('appliedCandidate'));
    }
    public function sharePosition($positionId)
    {
        $sharePositionTo = User::where('is_active', '1')->get();
        return view('pages.position.sharePosition', compact('sharePositionTo', 'positionId'));
    }
    public function sharePositionTo(Request $request)
    {
        $sharePosition = new Shareposition();
        $sharePosition->positionId = $request->positionId;
        $sharePosition->shareToId = json_encode(request('shareposition'));
        $sharePosition->save();
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return redirect()->back()->with('success', 'stage is change Successfully');
    }


    public function changestage(Request $request)
    {
        $stage = Stage::find($request->id);
        $stage->stageName = $request->stageName;
        $stage->update();
        return redirect()->back()->with('success', 'stage is change Successfully');
    }

    public function jobPostingReports()
    {
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers, $currentUser->id);
        $users = User::whereIn('id', $childUsers)->get();
        $job_platforms = Portalresponse::select('portal')->distinct()->pluck('portal')->toArray();
        // return $job_platforms;
        $logos = [
            'linkedin' => url('job-posting-assets/linkedin.png'),
            'facebook' => url('job-posting-assets/facebook.png'),
            'shine' => url('job-posting-assets/shine.png'),
            'clickindia' => url('job-posting-assets/clickIndia.png'),
            'monster' => url('job-posting-assets/monster.jpg'),
            'Careerjet' => url('job-posting-assets/careerjet.png'),
            'post_job_free' => url('job-posting-assets/postjobfree.png'),
            'jora' => url('job-posting-assets/jora.png'),
            'naukri' => url('job-posting-assets/naukri.png'),
            'indeed' => url('job-posting-assets/Indeed.png'),
            'jooble' => url('job-posting-assets/jooble.jpg'),
            'timesjob' => url('job-posting-assets/timesjob.png'),
            'google' => url('job-posting-assets/google.png'),
            'whatsjob india' => url('job-posting-assets/whatJobs.png'),
            'Drjobs india' => url('job-posting-assets/drjob.png'),
            'Adzuna india' => url('job-posting-assets/aduzana.png'),
            'Linkedin Ats' => url('job-posting-assets/ats.png'),
            'job_vertise' => url('job-posting-assets/jobvertise.webp'),
            'my_job_helper' => url('job-posting-assets/myjobhelper.png'),
            'Cv Library' => url('job-posting-assets/cv.png'),
            'adzuna usa' => url('job-posting-assets/adzuna.png'),
            'whatsjob USA' => url('job-posting-assets/whatJobs.png'),
            'ziprecruiter' => url('job-posting-assets/zip.png'),
            'Times Ascent USA' => url('job-posting-assets/times-ascent.png'),
            'Tanqeeb UAE' => url('job-posting-assets/tanqeeb.png'),
            'jobIsJob' => url('job-posting-assets/jobisjob.jpg'),
            'whiteforce' => url('job-posting-assets/wf.png'),
            'happiest' => url('job-posting-assets/happiest.png'),
            'Jobsora' => url('https://images.crunchbase.com/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/qjxttcoa76aweq98xzzb'),
            'learn4good' => url('https://www.lankacareersandtalents.com/photos/products/6fc461aeaf944df940e258a2778163cd-std.jpg'),
            'jobgrin' => url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAAC0CAMAAAAKE/YAAAAA4VBMVEX///8AAAD///1MsFD7//tra2vx//NOr1KRwJL9//z3//j5//pVqFj3//YmJib0//RTq1eqqqpPrFNcpV5Vqlf09PTu/+9eo2KNjY1Zp1yKxY1joGXp/+ycnJzd3d19fX23t7dYWFjR0dHL9c3p6em43rnFxcVCQkKz4LW627zm/+bf/+GSy5TV9tfc/96ezZ/M786x47Jyp3OOwpFqsW3B8MKk2qZ8vH93sHmJtouCu4RksGaYyZy+6MCEtISy5rVrq27U7tUWFhbQ/9Gr1Kx0vXad5p+N3pGs7q6x1LRnm2qdogdWAAAJYUlEQVR4nO2ZCXfauhLHwRgZWzY2NtgRkJB9YQlJIJAmpaGvvK3f/wO9Gck7kDT39fb2njP/054QJPBPo9EsSqVCIpFIJBKJRCKRSCQSiUQikUgkEolEIpFIJBKJRCKRSCQSiUQikUik/1sa6K9m+LD+ltCJEH03/m+8qN8e+jfB+JgK0KbOHdd1Gcp1LM7Nv4zrh6XpVnj7uBgvQd3x/Vmf8dI+5Jf4O+yRpnM2XM3WgbA93/PatoieNpPQ0vNsJWhN47Atbnlpb6tTr1YPf2TiYbVa77w9xXT6r0vR9nzfN1Dw0xPB+DbkOyYreNiZ4SzqLYbWR6gHVdDx+/NaOO/grRkaZ5NZ4Bm1ggzfXl/3nW2kGJqzT8L3g4arfwC6+i6MUh3nNfcTaxUertY2mBhA4V8spPaC8Sih3vJiZ9KzDcPu3Tofha7/IHT1DWgeXkdtCemDN7+AhG2Dn4C1ffE8cszd0NZdr20Y7d7E+rXQEgSYwTUMMLEv1s/T69XFajN7muMyYB3iebjLr0E6+wLuIT4xvmtJfyq0prPryEejemK+OAtD13FcFg4fly9tNLYfXLu7v9fkk6cgeh5a5q+FBunW3dyTvvHyecQgpego7jjhail8dJAuS6GKaBAmv35l/CPn8CdBQ9yy0Q+8+b3KJnG1Z+rubVd4fjtYuHlozYQlcS4nmVy+yn0bjoL22/2nQGvufeCjnecrZhXyNsTh/iwSwZdRwad1i4VhyCA4a/DadS00tJZ9BssAF5PSbvBt6KPWoA46OC6kkgT6vHWAo/XDyzzZaInO4b+8Mn3rKXy4GU+T6FFB61vu8KIxe3pofHV0TXduGp9uLFNT1Bp32OSiAfp8MXKd3aVLGfrypJrq4LwMfX6QjTZbyap050JgUBbT/o50DBjw8Nhqmgmzh4sIwqFtBw+3jm7d9ITo3fH4IHJ21g0CHBYiWsD4LmsXoTv1akGtEnSzMHp1GkOzzzbGuvlkf00X19cmWHbygGcTdsaLrh3dbYhaTciMqGkmZ9c924+zKgTPFdPNd6CPilD5XFkvj0gdyzEePkE89sWC5ZjVozqDk6PC84B5LakgpnvRhaWzBizYbjAZPjibBp7MqnisoQQIXl1ze/Py0NvMGfVuaEVt9Xs2Ro7H7VQM7nQVL8KUT+fDBxtrKQ+2P3gYcp5Ac1ynK6O9gTnVRnjDi+6c7d3LQXdSd4aDlr4+3IJuwnC6PPQQp9/zajX7GSJEvJX16kkBWqvIKIZxZgG+gVlz1mhc9C1dQtekpSFqTCJ5oIP1bDbrCR9t/bAjl+agD2MmFTbSM3dahK6r30/jN646KfTnMIE+Sj/WGdTRPSBiQApxIVb0I0QR41EIjQ2EYoAWMTScjYYwZLDv91k4WgQ4Nbjf3r8M+lxRnKSR7rSZW1ECnR3NVvqGM5TQG5ZAd5rVf+DXxMkEu4PwOYqmjmndBOD9dje0MGlqCjTxaesWiqea1/uGORVC37WkXrMtr864DkrMymCgoxx0vl9QO9PEfIjQYuMitHTd85aMlkkG1J1wKnxvzXRnI9B639ICOw/tImXNvlaHUtPDbhtcKZhsxf4MupkRFo15mEFfFT57ErsPuEe7ZkhoeJS+dXBMKxyDg/pzJhEhagzTQjQfPaS/18QoDvam+wh51hA3Vpk6hVZmHRQGO9mS6lmwSHUc+4eCtqch12T1Y/F0Q6G6gAAxmuGhMgImEcEB+qmf5qFZ1wbogCUNg3sWIfSFVU5ZKdbpDqpcxaFeFZvETrzO+CDOhhALPkVB95aprByXTP37OUZmtDR/A1qruAhtBGEl/qyD0DWALu9dCn2cCxWpDkvQuz/MJbS3PHP46Lvti2g6wdjgyJp6tHnCYgqj7zKz9A73QGjpw2kR+z50axd068egw4c2Jt1XV7WpkDjm49fHb4+Pr+NlINoqLRvtsauC2h730CR05h4KGt2jXGyX3OOyOJqhHuyFHkDyxWraaHeHljPqBtgZ4t1BgIUPBi2Vl/3g1eEJtJWLHjnogk9XrLPIQ+itnFg6iKW+XEaUk8zmxTVdxgdRdzeYFIyXFeMWu3uOJLYSJrW2dI/2euToYcE9wAn0LCNWEujk+yV07S1oBdgsHLXjbCGn2cTSPlxC73E3RxdoP926HGLy2XguhCw+scD457/+LQskMWU6Z38Eer9Pxw6Qj3mdZs68za3oopaEdyGmjMNg0+4Iwh3ksvDuYgpl/qyxWY2G/8HjBbFjhBFx/0HM3OM9aBW1DjNb5hwkLqDihKL8o5md1DjLt9TXr23ZBsxGLnZ+poWBAxoqxsJrbHmh3Fi4ZuWt6FHRWAna2QN9kD1Y3ZCB2eN+5Tiu5C4LZq/G/UonLj2UP+nhRjWJYnkGnZ8WN65g8+HixcPl2E+YBXPQ2hZ0ZS90PPe8JaVsGefuBKt6AiMHV9WS5S/jN5oDGB4kc9WSoHoby3bEaK+nIwzRUPKAtcPVs5B5BetiHYv8PwIdH8Riub+/cSkUUK3t0biAAtNao2fpIIYHMfr+bNjv90dni+WLzIVQbaxcrEni2mO3e7wHPcg/uJkWSdvU+aIvKbhzircBooDpTJZ4GPHItYP1E2g9F566y2tHK3Xdm0Knhb2CFln0MPaGvHzz1MwF36OTkiGLxcZxcVHN49yY5mBZpPI1tEttG++pZVYx7DUwq/sBVwa4hzDNcbKxNVRj63axFlwn0BrU17ZRgyrPLO/0VbHxbOW46qWknmtnpJnPC2OaNVwEdtyVGkZ6P+3h4dSTK/SbyLajTXYbbVr/jWzRu0GPd1Y9YQfTJMVrPPwU2Hbva1KZHiq25uC4UtblAe5Ds9462hqqYNQY4BG9GrTOy0PQntw94626kSHjNcB1H/sqdYOguxcP3zdh7urMZJvv3zfyfoO7NzDYz3aBDxvfv9x96I8EH5fm9B+X8qalDfKw454vbhk3s8aLuxC9pUdr8X0fxysweS2mmU4YurmKH5JRyLbKpZ8tHZgmmwYcwnUPjuKXz3dDaF/j3KCsiwE8SxZ4hHWuZmDHyHnGnB/7kwUNIQv7UnjFmFyH5f4XZhduS4vv/JI/2MUPwWRoccdy5DX1ngdrlR0DWvnebtd99k/Wrgf+0FT5TiXz8myW/G3HvRiJRCKRSCQSiUQikUgkEolEIpFIJBKJRCKRSCQSiUQikUgkEolEIpFIpL+J/gfCYc0TsdvKyQAAAABJRU5ErkJggg=='),
            'careerbliss' => url('https://media.careerbliss.com/logo-square.png'),
            'The india Job'=> url('https://www.theindiajobs.com/blog/wp-content/uploads/2018/05/foot_logo.png'),
        ];


        //Candidates Accrording Jobportals
        $results = CandidateResponse::select('publish_to', DB::raw('COUNT(*) as count'))
            ->groupBy('publish_to')
            ->whereIn('publish_to', $job_platforms)
            ->orderByRaw("FIELD(publish_to, '" . implode("','", $job_platforms) .
                "')")
            ->get();

        // Job Counts
        $portalResults = Portalresponse::select('portal', DB::raw('COUNT(*) as count'))
            ->groupBy('portal')
            ->whereIn('portal', $job_platforms)
            ->orderByRaw("FIELD(portal, '" . implode("','", $job_platforms) .
                "')")
            ->get();


        $jobPortals = [];
        foreach ($results as $result) {
            $portal = [
                'name' => $result->publish_to,
                'candidates' => $result->count,
                'logo' => $logos[$result->publish_to] ?? '',
                'positions' => $portalResults->where('portal', $result->publish_to)->first()->count ?? 0,
            ];

            $jobPortals[] = $portal;
        }
        return view('pages.position.job_posting_reports')->with(compact('users', 'jobPortals'));
    }
    public function positionList(Request $request)
    {

        $Positions = Position::where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC');
        // return $Positions->count();
        if (Auth::user()->role !== "admin") {
            $user = User::find(Auth::user()->id);
            $ascendantIds = $user->ascendantIds();
            $Positions = $Positions->whereIn('created_by', $ascendantIds);
        }
        $Positions = $Positions->paginate('25');
        return view('pages.position.PositionList', compact('Positions'));
    }
    public function getState(Request $request)
    {
        $country = $request->country;
        $state = State::where('country_id', $country)->get();
        echo '<option value="">Select State</option>';
        foreach ($state as $row) {

            echo '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
    }
    public function getCity(Request $request)
    {
        //   return $request;
        $state = $request->state;
        //   return $state;
        $city = Cities::where('state_id', $state)->get();
        //   echo '<option value="">Select City</option>';
        foreach ($city as $row) {
            // echo '<option>' . $row->city_name . '</option>';
            echo '<option value="' . $row->id . '">' . $row->name . '</option>';
            // return $row->city_name;
        }
    }

    public function getPortalForm()
    {
        $portal = request('portal');

        switch ($portal) {
            case "shine":
                return view('pages.position.portal_forms.shine');
                break;
            case "clickIndia":
                return view('pages.position.portal_forms.clickIndia');
                break;
            case "monster":
                return view('pages.position.portal_forms.monster');
                break;
            case "jora":
                return view('pages.position.portal_forms.jora');
                break;
            case "naukri":
                return view('pages.position.portal_forms.naukri');
                break;
            case "jooble":
                return view('pages.position.portal_forms.jooble');
                break;
            case "timesjob":
                return view('pages.position.portal_forms.timesjob');
                break;
            case "google":
                return view('pages.position.portal_forms.google');
                break;
            case "ziprecruiter_inter":
                return view('pages.position.portal_forms.ziprecruiter');
                break;
            case "reed":
                return view('newjobportal.reed_form');
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }
    }

    public function jobPostingReport(Request $request)
    {

        $portals = Portalresponse::where('job_id', $request->positionId)->get();
        $portalsArray = Portalresponse::where('job_id', $request->positionId)->pluck('portal')->toArray();
        $allPortalsArray = Portalresponse::select('portal')->distinct()->pluck('portal')->toArray();
        // $allPortalsArray = ['linkedin', 'facebook', 'shine', 'Click India', 'monster', 'careerJet', 'post_job_free', 'jora', 'naukri', 'indeed', 'jooble', 'timesjob', 'google', 'whatsjob india', 'Drjobs india', 'Adzuna india', 'Linkedin Ats', 'jobIsJob', 'Cv Library', 'Tanqeeb UAE', 'job_vertise', 'Times Ascent USA', 'WhatsJob USA', 'my_job_helper', 'ziprecruiter', 'adzuna usa'];
        $notSelectedPortals = array_diff($allPortalsArray, $portalsArray);
        return view('pages.position.jobpostingreport', compact('portals', 'notSelectedPortals'));
    }

    public function closedPosition(Request $request)
    {
        $position_name = $request->global_position_search ?? '';
        $Positions = Position::where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole'), 'is_close' => 1])->orderBy('id', 'DESC');
        if (Auth::user()->role !== "admin") {
            $user = User::find(Auth::user()->id);
            $ascendantIds = $user->ascendantIds();

            $teamIds = [Auth::user()->id, ...$ascendantIds];
            $Positions = $Positions->whereIn('created_by', $teamIds);
        }
        $Positions = $Positions->paginate('25');

        return view('pages.position.closedpositionList', compact('Positions', 'position_name'));
    }


    public function holdPosition(Request $request)
    {
        $position_name = $request->global_position_search ?? '';
        $Positions = Position::where(['is_active' => '1', 'software_category' => Auth::user()->software_category ?? 'onrole', 'is_hold' => 1])->orderBy('id', 'DESC');


        if (Auth::user()->role !== "admin") {
            $user = User::find(Auth::user()->id);
            $ascendantIds = $user->ascendantIds();

            $teamIds = [Auth::user()->id, ...$ascendantIds];
            $Positions = $Positions->whereIn('created_by', $teamIds);
        }
        $Positions = $Positions->paginate('25');
        return view('pages.position.holdpositionList', compact('Positions', 'position_name'));
    }
    public function showManagerList(Request $request)
    {
        $positionId = $request->position;

        $alreadyShared = Shareposition::where(['positionId' => $positionId, 'sharebyid' => Auth::user()->id])->pluck('sharetoId')->toArray();

        $managerlist = User::where(['software_category' => (Auth::user()->software_category ?? 'onrole')])->whereIn('role', ['senior_manager', 'manager', 'assistant_manager', 'talent_acquisition'])->get();

        return view('pages.position.managerslist', compact('managerlist', 'positionId', 'alreadyShared'));
    }

    public function sharedmanager(Request $request)
    {
        $managerIds = $request->manager ?? [];

        $position = SharePosition::where(['positionId' => $request->position, 'sharebyid' => Auth::user()->id])->delete();
        if (count($managerIds)) {
            foreach ($managerIds as $managerId) {
                $position = new SharePosition();
                $position->positionId = $request->position;
                $position->sharetoId = $managerId;
                $position->sharebyId = Auth::user()->id;
                $position->software_category = Auth::user()->software_category ?? 'onrole';
                $position->save();
            }
        }


        return redirect()->back()->with('success', 'Position has been shared to manager');
    }


    function searchPosition(Request $request)
    {
        $search = $request->value;

        $Positions = Position::with('portalResponse')->where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC');

        if (Auth::user()->role !== "admin") {
            $user = User::find(Auth::user()->id);
            if ($user->role == 'assistant_manager') {
                //Assistant_manager
                $manager = getParent($user->id, 1);
                $teamIds = [$manager->parent->id, $manager->id, ...$manager->descendantIds()];
            } else if ($user->role == 'talent_acquisition') {
                //talent_acquisition
                $manager = getParent($user->id, 2);
                $teamIds = [$manager->parent->id, $manager->id, ...$manager->descendantIds()];
            } else if ($user->role == 'manager') {
                //Manager
                $teamIds = [$user->parent->id, $user->id, ...$user->descendantIds()];
            } else {
                $descendantIds = $user->descendantIds();
                $teamIds = [Auth::user()->id, ...$descendantIds];
            }
            $Positions = $Positions->whereIn('created_by', $teamIds);
        }
        if($search){
            $Positions = $Positions->where(function ($query) use ($search) {
                $query->where('position_name', 'LIKE', '%' . $search . '%')
                      ->orWhere('clientname', 'LIKE', '%' . $search . '%');
            })->paginate(50);
        }else{
            $Positions = $Positions->paginate(50);
        }

        return view('pages.position.positionResult', compact('Positions'));

    }
    public function getTemplate(){
        $template=JobDescription::orderBy('id','DESC')->get();
        return view('pages.job_descriptions.job_template',compact('template')) ;
    }

    public function refreshCache($param){
        return $param;
    }

     public function getSpecilization(Request $request)
    {
        $specilization = NewShineEducationStream::where('degree_id', $request->shine_study_field_grouping_id)->get();
        foreach($specilization as $value){
            echo "<option value='{$value->id}'>{$value->specialization}</option>";
          }
    }

    public function getIndustry(Request $request){
        $area=NewMonsterFieldArea::where('industry_id',$request->monster_industry_id)->get();
        foreach($area as $value){
            echo "<option value='{$value->category_function_id}'>{$value->category_function_name}</option>";
          }
    }
}
