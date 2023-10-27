<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailsJob;
use App\Jobs\Sendhappybirthday;
use App\Jobs\Sendhbd;
// use App\Jobs\SendShortlistEmailjob;
use App\Models\Pipeline;
use App\Models\Position;
use App\Models\Industry;
use App\Models\User;
use App\Models\Source;
use App\Models\Degree;
use App\Models\Language;
use App\Models\Candidate;
use App\Models\Country;
use App\Models\Cities;
use App\Models\State;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Jobs\SendShortlistEmailjob;

// use Illuminate\Http\Request;
// use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\CandidateMail;
use App\Models\Hr;
use App\Jobs\CandidateMailJob;
use App\Models\Target;
// use PDF;

use Mpdf\Output\Destination;
use Mpdf\Output\OutputInterface;

use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf as Mpdf;
use Illuminate\Validation\Rule;
use App\Models\EmailAttachmentSyncRequest;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function test()
    {
        $data = (object) Auth::user()->getTargetThisQuarter();
        return $data->target;
        // $currentMonth = Carbon::now()->month - 1;

        // $targetForCurrentMonth = Auth::user()->targets->filter(function ($target) use ($currentMonth) {
        //     return $target->created_at->month === $currentMonth;
        // })->first();

        // return $targetForCurrentMonth ?? 0;



        return $target = Target::selectRaw('YEAR(created_at) AS year, QUARTER(created_at) AS quarter,  SUM(month_target) AS month_total, SUM(complete) AS complete_total, (SUM(month_target) - SUM(complete)) AS quarterly_left')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('year', 'quarter')
            ->where('user_id', 27)
            ->first();
    }

    public function download($path)
    {
        // return base64_decode($path);
        $disk = 's3'; // Replace 's3' with the name of your disk if you are using a different one
        $filePath = base64_decode($path); // Replace 'company/agreements/' with the path to the file you want to download

        return Storage::disk($disk)->download($filePath);
    }

    public function index(Request $request)
    {
        $currentUser = Auth::user()->id;
        $currentUser = User::find($currentUser);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers, $currentUser->id);
        $users = User::whereIn('id', $childUsers)->get();
        
        if(!empty($request->sync_request_id)){
            $sync_request = EmailAttachmentSyncRequest::select('id','candidate_ids')->find($request->sync_request_id);
            $candidates = Candidate::with('createdBy')->whereIn('created_by', $childUsers)->where('is_active', 1)->where('software_category', Auth::user()->software_category)->whereIn('id',explode(',',$sync_request->candidate_ids));
        } else {
            $candidates = Candidate::with('createdBy')->whereIn('created_by', $childUsers)->where('is_active', 1)->where('software_category', Auth::user()->software_category);
        }
        if ($request) {
            if (isset($request->name)) {
                $candidates = $candidates->where('name', 'LIKE', "%{$request->name}%");
            }
            if (isset($request->email)) {
                $candidates = $candidates->where('email', 'LIKE', "%{$request->email}%");
            }
            if (isset($request->designation)) {
                $candidates = $candidates->where('current_title', 'LIKE', "%{$request->designation}%");
            }
            // if (isset($request->PrefferdLocation)) {
            //     $candidates = $candidates->where('preferred_location', 'LIKE', "%{$request->PrefferdLocation}%");
            // }
            // if (isset($request->currentLocation)) {
            //     $candidates = $candidates->where('current_location', 'LIKE', "%{$request->currentLocation}%");
            // }
            if (isset($request->mobileNumber)) {
                $candidates = $candidates->where('mobile', 'LIKE', "%{$request->mobileNumber}%");
            }
            if (!empty($request->added_from)) {
                $candidates = $candidates->where('added_from', $request->added_from);
            }
            $candidates = $candidates->orderBy('id', 'DESC')->paginate(30);
            $currentUser = Auth::user()->name;
            return view('pages.candidate.candidate_list', compact('candidates', 'currentUser'));
        }

        $currentUser = Auth::user()->name;

        return view('pages.candidate.candidate_list', compact('candidates', 'currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::get();
        $positions = Position::get();
        $sources = Source::get();
        $degrees = Degree::get();
        $languages = Language::get();
        $industries = Industry::get();
        $countries = Country::get();
        $cities = Cities::get();
        return view('pages.candidate.create_candidate', compact('users', 'positions', 'sources', 'degrees', 'languages', 'industries', 'countries', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            "name" => 'required',
            "nationality" => 'required',
            "contact" => 'required',
            "email" =>  ['required', Rule::unique('candidates')->whereNull('email')],
            "source" => 'required',
            "notice_period" => 'required',
            "location" => 'required',
            "experience" => 'required',
            "salary_type" => 'required',
            "relocate" => 'required',
            "communication" => 'required',
            "date_of_birth" => 'required',
            "country" => 'required',
            "state" => 'required',
            "city" => 'required',
            "address" => 'required',


        ]);
        // $candidateExists = Candidate::where(function ($query) use ($request) {
        //     $query->where('email', $request->email)
        //         ->orWhere('mobile', $request->contact);
        // })->exists();

        // if ($candidateExists) {
        //     return redirect('candidate/create')->with('error', 'Candidate with the provided email or phone number already exists.');
        // }

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->mobile = $request->contact;
        $candidate->email = $request->email;
        $candidate->is_local = $request->nationality;
        $candidate->experience = $request->experience;
        $candidate->current_company = $request->company_name;
        $candidate->current_title = $request->designation;
        $city = Cities::find($request->city);
        $candidate->current_location = $city->name ?? '';
        $candidate->preferred_location = $request->location;
        $country = Country::find($request->country);
        $candidate->country = $country->name;
        $state = State::find($request->state);
        $candidate->state = $state->name;
        $candidate->city = $city->name;
        $candidate->address = $request->address;
        $candidate->pin_code = $request->postel_code;
        $candidate->highest_qualification = $request->education_name;
        $candidate->highest_qualification_type = $request->education_type;
        $candidate->highest_qualification_year = $request->education_year;
        // to calculate total experience //
        $experienceYear = $request->total_experience_year;
        $experienceMonth = $request->total_experience_month;
        $totalExperience = $experienceYear . '.' . $experienceMonth;
        $candidate->total_experience = $totalExperience;
        //*********************************************//

        $candidate->date_of_birth = $request->date_of_birth;
        $candidate->is_relocate = $request->relocate;


        $candidate->salary_type = $request->salary_type;

        //current salary save prosess //
        $currentSalaryInLakh = (int)$request->current_salary_lakh;
        $currentSalaryInThousand = (int)$request->current_salary_thousand;
        $result = $currentSalaryInLakh + $currentSalaryInThousand;
        $result = (string)$result;
        $candidate->current_salary = $result;
        //********************************** *//
        $candidate->expected_salary = $request->expected_salary;
        $candidate->marital_status = $request->marital_status;


        $candidate->industry = $request->industry;
        $language = implode(',', $request->language);
        $candidate->languages = $language;
        $candidate->notice_period = $request->notice_period;
        $candidate->gender = $request->gender;
        $candidate->communication = $request->communication;
        $skills = implode(',', $request->skills);
        $candidate->skills = $skills;
        //$candidate->last_working_day=$request->contact;
        $candidate->source = $request->source;
        //---------candidate resume save-------------------//
        if ($request->hasFile('resume')) {
            $filepath = time() . '_' . rand() . '.pdf';
            Storage::disk('public_uploads')->put('candidate_resume/' . $filepath, file_get_contents($request->file('resume')));
            $base_path = str_replace('src', '', base_path());
            $temppdfpath = $base_path . "/candidate_resume/" . $filepath;
            // $convertedpdfpath = convertPdfVersion($temppdfpath);
            if (!empty($temppdfpath)) {
                Storage::disk('s3')->put('candidate_resume/' . $filepath, file_get_contents($temppdfpath), 'public');
                unlink($temppdfpath);
            } else {
                Storage::disk('s3')->put('candidate_resume/' . $filepath, file_get_contents($temppdfpath), 'public');
            }

            $candidate->resume_file = $filepath;
        }
        //-----------------------------------------//
        $candidate->last_company = $request->last_company;
        $candidate->last_ctc = $request->last_ctc;
        $candidate->pan_card = $request->pan;
        $candidate->aadhar_card = $request->aadhar;
        $candidate->created_by = Auth::user()->id;
        $candidate->resume_parser_json = $request->json_row;
        $candidate->software_category = Auth::user()->software_category ?? 'onrole';
        $candidate->save();
        return redirect('candidate')->with('success', 'Candidate saved successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $users = User::get();
        $positions = Position::get();
        $sources = Source::get();
        $degrees = Degree::get();
        $languages = Language::get();
        $industries = Industry::get();
        $candidate = Candidate::where('id', $id)->first();
        $disk = Storage::disk('s3');
        if (!empty($candidate->resume_file)) {
            $disk = Storage::disk('s3');
            $candidate->resume_file = $disk->temporaryUrl('candidate_resume/' . $candidate->resume_file, now()->addMinutes(5));
        }
        $salaryInThousand = 0;
        $salaryInLakh = 0;
        if (!empty($candidate->current_salary)) {
            $digits = strlen($candidate->current_salary);
            $diviser = 1;
            for ($i = 0; $i < $digits - 1; $i++) {
                $diviser .= 0;
            }
            $salary = (int)$candidate->current_salary;
            $salaryInThousand = $salary % $diviser;
            $salaryInLakh = $salary - $salaryInThousand;
        }
        $countries = Country::get();
        $cities = Cities::get();
        $countryId = Country::where('name', $candidate->country)->first();
        $countryId = $countryId->id ?? '';
        $stateId = State::where('name', $candidate->state)->first();
        $stateId = $stateId->id ?? '';
        $cityId = Cities::where('name', $candidate->city)->first();
        $cityId = $cityId->id ?? '';
        return view('pages.candidate.edit_candidate', compact('users', 'positions', 'sources', 'degrees', 'languages', 'industries', 'candidate', 'countries', 'cities', 'salaryInLakh', 'salaryInThousand', 'countryId', 'stateId', 'cityId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([

            "name" => 'required',
            "nationality" => 'required',
            "contact" => 'required',
            "email" => 'required',
            "source" => 'required',
            "notice_period" => 'required',
            "location" => 'required',
            "experience" => 'required',
            "salary_type" => 'required',
            "expected_salary" => 'required',
            "education_type" => 'required',
            "education_year" => 'required',
            "education_name" => 'required',
            "gender" => 'required',
            "marital_status" => 'required',
            "relocate" => 'required',
            "communication" => 'required',
            "date_of_birth" => 'required',
            "country" => 'required',
            "state" => 'required',
            "city" => 'required',
            "address" => 'required',

        ]);
        $candidate = Candidate::where('id', $id)->first();
        $old_candidate_data = $candidate;
        $candidate->name = $request->name;
        $candidate->mobile = $request->contact;
        $candidate->email = $request->email;
        $candidate->experience = $request->experience;
        $candidate->current_company = $request->company_name;
        $candidate->current_title = $request->designation;
        $candidate->preferred_location = $request->location;
        $country = Country::where('id', $request->country)->first();
        $candidate->country = $country->name;
        $state = State::where('id', $request->state)->first();
        $candidate->state = $state->name;
        $city = Cities::find($request->city);
        $candidate->current_location = $city->name ?? '';
        $candidate->city = $city->name ?? '';
        $candidate->address = $request->address;
        $candidate->pin_code = $request->postel_code;
        $candidate->highest_qualification = $request->education_name;
        $candidate->highest_qualification_type = $request->education_type;
        $candidate->highest_qualification_year = $request->education_year;
        // to calculate total experience //
        $experienceYear = $request->total_experience_year;
        $experienceMonth = $request->total_experience_month;
        $totalExperience = $experienceYear . '.' . $experienceMonth;
        $candidate->total_experience = $totalExperience;
        //*********************************************//
        $candidate->date_of_birth = $request->date_of_birth;
        $candidate->is_relocate = $request->relocate;
        // $candidate->age=$request->contact;
        $candidate->salary_type = $request->salary_type;
        // $candidate->pay_type=$request->contact;
        //current salary save prosess //
        $currentSalaryInLakh = (int)$request->current_salary_lakh;
        $currentSalaryInThousand = (int)$request->current_salary_thousand;
        $result = $currentSalaryInLakh + $currentSalaryInThousand;
        $current_salary = (string)$result;
        $candidate->current_salary = $current_salary;
        //********************************** *//
        $candidate->expected_salary = $request->expected_salary;
        $candidate->marital_status = $request->marital_status;


        $candidate->industry = $request->industry;
        $language = implode(',', $request->language);
        $candidate->languages = $language;
        $candidate->notice_period = $request->notice_period;
        $candidate->gender = $request->gender;
        $candidate->communication = $request->communication;
        $skills = implode(',', $request->skills);
        $candidate->skills = $skills;
        // $candidate->last_working_day=$request->contact;
        $candidate->source = $request->source;
        //---------candidate resume save-------------------//
        $oldResumePath = $candidate->resume_file;

        if ($request->hasFile('resume')) {
            $uploadedFile = $request->file('resume');

            if ($uploadedFile) {
                $filepath = time() . '_' . rand() . '.pdf';
                Storage::disk('public_uploads')->put('candidate_resume/' . $filepath, file_get_contents($uploadedFile));
                $base_path = str_replace('src', '', base_path());
                $temppdfpath = $base_path . "/candidate_resume/" . $filepath;
                $convertedpdfpath = convertPdfVersion($temppdfpath);
                if (!empty($convertedpdfpath)) {
                    Storage::disk('s3')->put('candidate_resume/' . $filepath, file_get_contents($convertedpdfpath), 'public');
                    unlink($convertedpdfpath);
                } else {
                    Storage::disk('s3')->put('candidate_resume/' . $filepath, file_get_contents($temppdfpath), 'public');
                }
                unlink($temppdfpath);
                $candidate->resume_file = $filepath;

                if ($oldResumePath) {
                    $deleted = Storage::disk('s3')->delete($oldResumePath);

                    if ($deleted) {

                        echo 'Old resume file deleted successfully.';
                    } else {

                        echo 'Failed to delete the old resume file.';
                    }
                }
            }
        }


        //-----------------------------------------//
        $candidate->last_company = $request->last_company;
        $candidate->last_ctc = $request->last_ctc;
        $candidate->pan_card = $request->pan;
        $candidate->aadhar_card = $request->aadhar;
        $candidate->software_category = Auth::user()->software_category ?? 'onrole';
        $candidate->save();

        //For Updating Batch Header
        $request->current_location = $city->name ?? '';
        $request->age = !empty($request->date_of_birth) ? (date('Y') - date('Y', strtotime($request->date_of_birth))) : '-';
        $request->current_salary = $current_salary;
        $request->total_experience = $totalExperience;
        $request->language = $language;
        $request->resume = !empty($filepath) ? $filepath : '';
        updateBatchHeader($old_candidate_data, $request);
        return redirect('candidate')->with('success', 'Candidate details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::where('id', $id)->first();
        $candidate->is_active = 0;
        $candidate->save();
        return redirect('candidate')->with('success', 'Candidate deleted successfully');
    }


    public function interviewForm(Request $request)
    {

        $Pipeline = Pipeline::where('stage_id', $request->stageId)->first();

        $Pipeline->interview_date = $request->interviewDate;
        $Pipeline->interview_time_from = $request->interviewTimeFro;
        $Pipeline->interview_time_to = $request->interviewTimeTo;
        $Pipeline->interview_venue = $request->interviewVenue;
        $Pipeline->interview_stage = $request->interviewStage;
        $Pipeline->interview_time_to = $request->interviewerEmail;
        $Pipeline->status = $request->interviewStage;
        $Pipeline->update();
        return redirect()->back()->with('success', 'Position is Close Successfully');
    }

    public function bh()
    {
        return view('pages.batchHeader.batchheader');
    }

    public function createBatchHeader()
    {
        $documentFileName = time() . ".pdf";
        // Create the mPDF document
        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '0',
            'margin_top' => '5',
            'margin_left' => '8',
            'margin_right' => '8',
            'margin_bottom' => '5',
            'margin_footer' => '0',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        // $document->SetWatermarkImage('watermark_small.png');


        $document->showWatermarkImage = true;

        // $document->SetHTMLFooter(view('footer'));

        $document->WriteHTML(view('pages.batchHeader.batchheader'));


        // Save PDF on your public storage
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header); //
    }

    public function sendMail(Request $request)
    {
        $ids = $request->input('ids');
        $title = $request->title;
        $subject = $request->subject;
        $description = $request->description;
        foreach ($ids as $id) {
            $candidate = Candidate::find($id);
            $info = array(
                "name" => $candidate->name ?? "",
                "email" => $candidate->email ?? "",
                "title" => $title,
                "subject" => $subject,
                "description" => $description,
            );
            CandidateMailJob::dispatch($info);
        }
        return 1;
        // return response()->json(['message' => $description]);
    }
    public function set_interview(Request $request)
    {

        $pipelineId = $request->pipeline;
        $data = Pipeline::find($pipelineId);
        $data->interview_date = $request->interview_date;
        $data->interview_time_from = $request->interview_time_from;
        $data->interview_time_to = $request->interview_time_to;
        $data->interview_venue = $request->interview_venue;
        $interview_date = Carbon::parse($data->interview_date)->format('d-m-Y');

        $data->save();


        $info = array(
            'name' => $data->candidate->name ?? '',
            'candidate_email' => $data->candidate->email ?? '',
            'position' => $data->position->position_name,
            'companyname' => $data->position->clientname,
            'interview_date' =>  $interview_date ?? '',
            'timefrom' => $data->interview_time_from,
            'timeto' => $data->interview_time_to,
            'venue' => $data->interview_venue,
            'job_description' => $data->position->job_description,
            'min_exp' => $data->position->min_year_exp,
            'max_exp' => $data->position->max_year_exp,
            'job_type' =>  $data->position->job_type,
            'min_salary' => $data->position->min_salary,
            'max_salary' => $data->position->max_salary,
            'sender_email' => Auth::user()->email,
            'sender_name' => Auth::user()->name,
            'sender_contact' => Auth::user()->contact,
            // 'date'=> ''
        );
        $dispach_time = getDispatchTime();
        SendEmailsJob::dispatch($info)->delay($dispach_time);
        return 1;
    }

    public function set_interview_multiple(Request $request)
    {
        $pipelines = $request->pipeline ?? [];

        foreach ($pipelines as $pipelineId) {
            $data = Pipeline::find($pipelineId);
            $data->interview_date = $request->interview_date;
            $data->interview_time_from = $request->interview_time_from;
            $data->interview_time_to = $request->interview_time_to;
            $data->interview_venue = $request->interview_venue;
            $interview_date = Carbon::parse($data->interview_date)->format('d-m-Y');

            $data->save();


            $info = array(
                'name' => $data->candidate->name ?? '',
                'candidate_email' => $data->candidate->email ?? '',
                'position' => $data->position->position_name,
                'companyname' => $data->position->clientname,
                'interview_date' =>  $interview_date ?? '',

                'timefrom' => $data->interview_time_from,
                'timeto' => $data->interview_time_to,
                'venue' => $data->interview_venue,
                'job_description' => $data->position->job_description,
                'min_exp' => $data->position->min_year_exp,
                'max_exp' => $data->position->max_year_exp,
                'job_type' =>  $data->position->job_type,
                'min_salary' => $data->position->min_salary,
                'max_salary' => $data->position->max_salary,
                'sender_email' => Auth::user()->email,
                'sender_name' => Auth::user()->name,
                'sender_contact' => Auth::user()->contact,
                // 'date'=> ''
            );
            $dispach_time = getDispatchTime();
            SendEmailsJob::dispatch($info)->delay($dispach_time);
        }
        return 1;
    }

    public function setOfferDetail(Request $request)
    {


        $pipelineId = $request->pipeline;
        $data = Pipeline::find($pipelineId);
        $data->joining_date = $request->joining_date;
        $data->actual_ctc = $request->offerd_ctc;
        $data->offerd_ctc = $request->offerd_ctc;
        $data->stage = 'offered';
        $data->save();

        return 1;
        // return back()->with('success', 'Offered Details Saved Succesfully.');
    }
    public function sendbirthdaymail($hr)
    {
        $hr = Hr::find($hr);
        $info = array(
            'name' => $hr->name ?? '',
            'candidate_email' => $hr->email ?? '',
        );
        Sendhappybirthday::dispatch($info);

        // Mail::send('hbdmail', ['data' => $info], function ($message) {
        //     $message->to('priyaswhiteforce@gmail.com');
        //     $message->subject('Happy Birthday');
        //     $message->from('priyashrivastava65@gmail.com', 'priya');
        // });

        // return 1;
        return back()->with('success', 'Birthday Wishes send Succesfully.');
    }

    public function getPositionList(Request $request)
    {
        $candidateId = $request->id;
        $pipeline_position = Pipeline::where('candidate_id', $candidateId)->pluck('position_id')->toArray();

        if (Auth::user()->role !== "admin") {

            $user = User::find(Auth::user()->id);
            //parent position
            $ascendantIds = $user->ascendantIds();
            //child position
            $descendantIds = $user->descendantIds();

            $teamIds = [Auth::user()->id, ...$ascendantIds, ...$descendantIds];
            $Positions = Position::with('portalResponse')->whereNotIn('id', $pipeline_position)->whereIn('created_by', $teamIds)->where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC')->paginate(100);
        } else {
            $user = User::find(Auth::user()->id);
            $descendantIds = $user->descendantIds();

            $teamIds = [Auth::user()->id, ...$descendantIds];
            $Positions = Position::with('portalResponse')->whereNotIn('id', $pipeline_position)->whereIn('created_by', $teamIds)->where(['is_active' => '1', 'software_category' => (Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC')->paginate(100);
        }
        return view('pages.candidate.position_list_pipeline', compact('Positions'));
    }

    public function addToMultiplePipeline(Request $request)
    {
        $curQuarter = ceil(date('n', time()) / 3);
        $curYear = date('Y');
        $stages = (new Position())->stagesArr;
        $positionsIds = $request->positionIds;
        $candidate = Candidate::where('id', $request->candidateId)->select('id', 'created_by')->first();
        foreach ($positionsIds as $position) {
            $pipe = new Pipeline();
            $pipe->position_id = $position;
            $pipe->stage = $stages[0]; // 0 = sourcing
            $pipe->candidate_id = $candidate->id;
            $pipe->created_by = Auth::user()->id;
            $pipe->owner = $candidate->created_by;
            $pipe->cre_quarter = $curQuarter;
            $pipe->cre_quarter_year = $curYear;
            $pipe->software_category = Auth::user()->software_category ?? 'onrole';
            $pipe->save();
        }
        return "Candidate Successfully Added To Pipeline";
    }

    public function getHistory(Request $request)
    {
        $history = History::with(['position', 'candidate', 'createBy', 'changeBy'])->where('candidate_id', $request->candidateId)->orderBy('id', 'DESC')->get();
        return view('pages.candidate.candidate_history', compact('history'));
    }

    public function candidateDetails(Request $request)
    {
        $candidate = Candidate::where('id', $request->candidate_id)->first();
        $display_action_button = $request->display_action_button;
        return view('pages.candidate.candidate_details', compact('candidate', 'display_action_button'));
    }

    public function cloneCandidateData()
    {
        $candidatejson = file_get_contents("https://white-force.com/onrole/api/all-candidate-new");
        $candidates = json_decode($candidatejson, true);
        //dd($clients);
        if (!empty($candidates['data'])) {
            $total_fetched_candidate = count($candidates['data']);
            $total_save_candidate = 0;
            $total_failed_candidate = 0;
            $already_existes_candidate = 0;
            foreach ($candidates['data'] as $candidate) {
                try {
                    $checkExist = Candidate::where('email', $candidate['email'])->where('mobile', $candidate['mobile'])->first();
                    if (empty($checkExist)) {
                        //Source
                        if (!empty($candidate['source'])) {
                            if (is_numeric($candidate['source'])) {
                                $source = Source::where('id', $candidate['source'])->value('source_name');
                            } else {
                                $source = Source::where('source_name', $candidate['source'])->value('source_name');
                            }
                        }
                        //Industry
                        if (!empty($candidate['industry'])) {
                            $industry = Industry::where('industry_name', $candidate['industry'])->value('industry_name');
                        }
                        //Country
                        if (!empty($candidate['country'])) {
                            if (is_numeric($candidate['country'])) {
                                $county = Country::where('id', $candidate['country'])->value('name');
                            } else {
                                $county = Country::where('name', $candidate['country'])->value('name');
                            }
                        }
                        //State
                        if (!empty($candidate['state'])) {
                            if (is_numeric($candidate['state'])) {
                                $state = State::where('id', $candidate['state'])->value('name');
                            } else {
                                $state = State::where('name', $candidate['state'])->value('name');
                            }
                        }
                        //Current Location
                        if (!empty($candidate['currentLocation'])) {
                            if (is_numeric($candidate['currentLocation'])) {
                                $current_location = Cities::where('id', $candidate['currentLocation'])->value('name');
                            } else {
                                $current_location = Cities::where('name', $candidate['currentLocation'])->value('name');
                            }
                        }
                        //Preferred Location
                        if (!empty($candidate['preferredLocation'])) {
                            if (is_numeric($candidate['preferredLocation'])) {
                                $preferred_location = Cities::where('id', $candidate['preferredLocation'])->value('name');
                            } else {
                                $preferred_location = Cities::where('name', $candidate['preferredLocation'])->value('name');
                            }
                        }
                        //Highest Qualification
                        if (!empty($candidate['highestQualification'])) {
                            if (is_numeric($candidate['highestQualification'])) {
                                $highest_qualification = Degree::where('id', $candidate['highestQualification'])->value('degree_name');
                            } else {
                                $highest_qualification = Degree::where('degree_name', $candidate['highestQualification'])->value('degree_name');
                            }
                        }
                        //language
                        $language_array = !empty($candidate['languages']) ? json_decode($candidate['languages']) : '';
                        if (is_array($language_array)) {
                            $language = implode(',', $language_array);
                        }
                        //Skills
                        $skill_array = !empty($candidate['skills']) ? json_decode($candidate['skills']) : '';
                        if (is_array($skill_array)) {
                            $skill = implode(',', $skill_array);
                        }

                        $newcandidate = new Candidate();
                        $newcandidate->name                       = $candidate['name'];
                        $newcandidate->mobile                     = $candidate['mobile'];
                        $newcandidate->email                      = $candidate['email'];
                        $newcandidate->experience                 = $candidate['experience'];
                        $newcandidate->current_company            = $candidate['currentCompany'];
                        $newcandidate->current_title              = $candidate['currentTitle'];
                        $newcandidate->address                    = $candidate['address'];
                        $newcandidate->pin_code                   = $candidate['pinCode'];
                        $newcandidate->highest_qualification_type = $candidate['highestQualification_type'];
                        $newcandidate->highest_qualification_year = $candidate['highestQualification_year'];
                        $newcandidate->total_experience           = $candidate['totalExperience'];
                        $newcandidate->date_of_birth              = $candidate['dateofBirth'];
                        $newcandidate->is_relocate                = $candidate['is_relocate'];
                        $newcandidate->salary_type                = $candidate['salary_type'];
                        $newcandidate->pay_type                   = $candidate['pay_type'];
                        $newcandidate->current_salary             = $candidate['currentSalary'];
                        $newcandidate->expected_salary            = $candidate['expectedSalary'];
                        $newcandidate->languages                  = !empty($language) ? $language : $candidate['languages'];
                        $newcandidate->notice_period              = $candidate['noticePeriod'];
                        $newcandidate->communication              = $candidate['communication'];
                        $newcandidate->skills                     = !empty($skill) ? $skill : $candidate['skills'];
                        $newcandidate->old_resume_file            = $candidate['resumeFile'];
                        $newcandidate->last_company               = $candidate['lastCompany'];
                        $newcandidate->last_ctc                   = $candidate['lastCtc'];
                        $newcandidate->rating                     = $candidate['rating'];
                        $newcandidate->software_category          = 'onrole';
                        $newcandidate->created_at                 = $candidate['created_at'];
                        $newcandidate->updated_at                 = $candidate['updated_at'];
                        $newcandidate->source                     = !empty($source) ? $source : null;
                        $newcandidate->industry                   = !empty($industry) ? $industry : null;
                        $newcandidate->country                    = !empty($county) ? $county : null;
                        $newcandidate->state                      = !empty($state) ? $state : null;
                        $newcandidate->current_location           = !empty($current_location) ? $current_location : null;
                        $newcandidate->preferred_location         = !empty($preferred_location) ? $preferred_location : null;
                        $newcandidate->highest_qualification      = !empty($highest_qualification) ? $highest_qualification : null;
                        $newcandidate->added_from                 = 'old';
                        $newcandidate->marital_status             = !empty($candidate['maritalStatus']) ? strtolower($candidate['maritalStatus']) : null;
                        $newcandidate->gender                     = !empty($candidate['gender']) ? strtolower($candidate['gender']) : null;
                        $newcandidate->save();
                        $total_save_candidate++;
                    } else {
                        $already_existes_candidate++;
                    }
                } catch (\Exception $e) {
                    $total_failed_candidate++;
                }
            }
            return "Total:-" . $total_fetched_candidate . " Saved:-" . $total_save_candidate . " Already Exists:-" . $already_existes_candidate . " Failed:-" . $total_failed_candidate;
        } else {
            return "No record found";
        }
    }

    public function cloneOffroleCandidateData()
    {
        $candidatejson = file_get_contents("https://white-force.com/offrole/api/all-candidate-new");
        $candidates = json_decode($candidatejson, true);
        //dd($clients);
        if (!empty($candidates['data'])) {
            $total_fetched_candidate = count($candidates['data']);
            $total_save_candidate = 0;
            $total_failed_candidate = 0;
            $already_existes_candidate = 0;
            foreach ($candidates['data'] as $candidate) {
                try {
                    $checkExist = Candidate::where('email', $candidate['email'])->where('mobile', $candidate['mobile'])->first();
                    if (empty($checkExist)) {
                        //Source
                        if (!empty($candidate['source'])) {
                            if (is_numeric($candidate['source'])) {
                                $source = Source::where('id', $candidate['source'])->value('source_name');
                            } else {
                                $source = Source::where('source_name', $candidate['source'])->value('source_name');
                            }
                        }
                        //Industry
                        if (!empty($candidate['industry'])) {
                            $industry = Industry::where('industry_name', $candidate['industry'])->value('industry_name');
                        }
                        //Country
                        if (!empty($candidate['country'])) {
                            if (is_numeric($candidate['country'])) {
                                $county = Country::where('id', $candidate['country'])->value('name');
                            } else {
                                $county = Country::where('name', $candidate['country'])->value('name');
                            }
                        }
                        //State
                        if (!empty($candidate['state'])) {
                            if (is_numeric($candidate['state'])) {
                                $state = State::where('id', $candidate['state'])->value('name');
                            } else {
                                $state = State::where('name', $candidate['state'])->value('name');
                            }
                        }
                        //Current Location
                        if (!empty($candidate['currentLocation'])) {
                            if (is_numeric($candidate['currentLocation'])) {
                                $current_location = Cities::where('id', $candidate['currentLocation'])->value('name');
                            } else {
                                $current_location = Cities::where('name', $candidate['currentLocation'])->value('name');
                            }
                        }
                        //Preferred Location
                        if (!empty($candidate['preferredLocation'])) {
                            if (is_numeric($candidate['preferredLocation'])) {
                                $preferred_location = Cities::where('id', $candidate['preferredLocation'])->value('name');
                            } else {
                                $preferred_location = Cities::where('name', $candidate['preferredLocation'])->value('name');
                            }
                        }
                        //Highest Qualification
                        if (!empty($candidate['highestQualification'])) {
                            if (is_numeric($candidate['highestQualification'])) {
                                $highest_qualification = Degree::where('id', $candidate['highestQualification'])->value('degree_name');
                            } else {
                                $highest_qualification = Degree::where('degree_name', $candidate['highestQualification'])->value('degree_name');
                            }
                        }
                        //language
                        $language_array = !empty($candidate['languages']) ? json_decode($candidate['languages']) : '';
                        if (is_array($language_array)) {
                            $language = implode(',', $language_array);
                        }
                        //Skills
                        $skill_array = !empty($candidate['skills']) ? json_decode($candidate['skills']) : '';
                        if (is_array($skill_array)) {
                            $skill = implode(',', $skill_array);
                        }

                        $newcandidate = new Candidate();
                        $newcandidate->name                       = $candidate['name'];
                        $newcandidate->mobile                     = $candidate['mobile'];
                        $newcandidate->email                      = $candidate['email'];
                        $newcandidate->experience                 = $candidate['experience'];
                        $newcandidate->current_company            = $candidate['currentCompany'];
                        $newcandidate->current_title              = $candidate['currentTitle'];
                        $newcandidate->address                    = $candidate['address'];
                        $newcandidate->pin_code                   = $candidate['pinCode'];
                        $newcandidate->highest_qualification_type = $candidate['highestQualification_type'];
                        $newcandidate->highest_qualification_year = $candidate['highestQualification_year'];
                        $newcandidate->total_experience           = $candidate['totalExperience'];
                        $newcandidate->date_of_birth              = $candidate['dateofBirth'];
                        $newcandidate->is_relocate                = $candidate['is_relocate'];
                        // $newcandidate->salary_type                = $candidate['salary_type'];
                        // $newcandidate->pay_type                   = $candidate['pay_type'];
                        $newcandidate->current_salary             = $candidate['currentSalary'];
                        $newcandidate->expected_salary            = $candidate['expectedSalary'];
                        $newcandidate->languages                  = !empty($language) ? $language : $candidate['languages'];
                        $newcandidate->notice_period              = $candidate['noticePeriod'];
                        $newcandidate->communication              = $candidate['communication'];
                        $newcandidate->skills                     = !empty($skill) ? $skill : $candidate['skills'];
                        $newcandidate->old_resume_file            = $candidate['resumeFile'];
                        // $newcandidate->last_company               = $candidate['lastCompany'];
                        // $newcandidate->last_ctc                   = $candidate['lastCtc'];
                        $newcandidate->rating                     = $candidate['rating'];
                        $newcandidate->software_category          = 'offrole';
                        $newcandidate->created_at                 = $candidate['created_at'];
                        $newcandidate->updated_at                 = $candidate['updated_at'];
                        $newcandidate->source                     = !empty($source) ? $source : null;
                        $newcandidate->industry                   = !empty($industry) ? $industry : null;
                        $newcandidate->country                    = !empty($county) ? $county : null;
                        $newcandidate->state                      = !empty($state) ? $state : null;
                        $newcandidate->current_location           = !empty($current_location) ? $current_location : null;
                        $newcandidate->preferred_location         = !empty($preferred_location) ? $preferred_location : null;
                        $newcandidate->highest_qualification      = !empty($highest_qualification) ? $highest_qualification : null;
                        $newcandidate->added_from                 = 'old';
                        $newcandidate->marital_status             = !empty($candidate['maritalStatus']) ? strtolower($candidate['maritalStatus']) : null;
                        $newcandidate->gender                     = !empty($candidate['gender']) ? strtolower($candidate['gender']) : null;
                        $newcandidate->save();
                        $total_save_candidate++;
                    } else {
                        $already_existes_candidate++;
                    }
                } catch (\Exception $e) {
                    $total_failed_candidate++;
                }
            }
            return "Total:-" . $total_fetched_candidate . " Saved:-" . $total_save_candidate . " Already Exists:-" . $already_existes_candidate . " Failed:-" . $total_failed_candidate;
        } else {
            return "No record found";
        }
    }
}
