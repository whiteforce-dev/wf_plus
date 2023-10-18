<?php

namespace App\Http\Controllers;

use App\Jobs\CandidateBatchHeader;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use App\Models\Pipeline;
use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf as Mpdf;

use App\Models\Target;

class PipelineController extends Controller
{
    public function index($id)
    {
        $position = Position::with('findClientGet', 'pipeline.candidate')->find($id);
        $pipeline = $position->pipeline;
        $usersArr = array_unique($pipeline->pluck('created_by')->toArray() ?? []);
        $stages = $position->stagesArr;

        $users = User::whereIn('id', $usersArr)->get();

        foreach ($stages as $stage) {
            $$stage = $position->pipeline->where('stage', $stage)->count();
        }
        return view('pages.position.pipeline.pipeline', compact(
            'position',
            'users',
            'stages',
            'sourcing',
            'telephonic',
            'f2f',
            'not_attend',
            'rejected',
            'hot',
            'hold',
            'selected',
            'backout',
            'offered',
            'joined'
        ));
    }

    public function addCandidateToPipeline($position_id)
    {
        $pipeline_candidates = Pipeline::where('position_id', $position_id)->pluck('candidate_id')->toArray();
        $candidateList = Candidate::whereNotIn('id', $pipeline_candidates)->where(['software_category' => Auth::user()->software_category, 'created_by' => Auth::user()->id])->orderBy('id', 'desc');

        $candidateList = $candidateList->paginate(100);
        return view('pages.position.pipeline.add_candidate_to_pipeline', compact('candidateList', 'position_id'));
    }


    public function assignToPipeline(Request $request)
    {
        try {
            $curQuarter = ceil(date('n', time()) / 3);
            $curYear = date('Y');
            $candidates = array_unique(request('selectedCandidate') ?? []);


            $pipeline_candidates = Pipeline::where('position_id', request('position_id'))->pluck('candidate_id')->toArray();


            $position = Position::find(request('position_id'));
            $stages = (new Position())->stagesArr;

            foreach ($candidates as $candidate) {
                if (!in_array($candidate, $pipeline_candidates)) {
                    $pipe = new Pipeline();
                    $pipe->position_id = request('position_id');
                    $pipe->stage = $stages[0]; // 0 = sourcing
                    $pipe->candidate_id = $candidate;
                    $pipe->created_by = Auth::user()->id;
                    $pipe->owner = $position->created_by;
                    $pipe->cre_quarter = $curQuarter;
                    $pipe->cre_quarter_year = $curYear;
                    $pipe->software_category = Auth::user()->software_category ?? 'onrole';
                    $pipe->save();

                    array_push($pipeline_candidates, $candidate);
                    CandidateBatchHeader::dispatch($pipe->id, $pipe->position_id, $pipe->candidate_id);
                }
            }
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getCandidateByQuery(Request $request)
    {
        $position_id = request('position_id');
        $pipeline_candidates = Pipeline::where('position_id', $position_id)->pluck('candidate_id')->toArray();

        $candidateList = Candidate::where(['is_active' => 1, 'software_category' =>  Auth::user()->software_category])->orderBy('id', 'desc')->where(function ($query) {
            $query->where('name', 'like', '%' . request('queryString') . '%')
                ->orWhere('mobile', 'like', '%' . request('queryString') . '%')
                ->orWhere('email', 'like', '%' . request('queryString') . '%');
        })->whereNotIn('id', $pipeline_candidates);
        if ($request->checked) {
            $candidateList = $candidateList->paginate(50);
        } else {
            $candidateList = $candidateList->where('created_by', Auth::user()->id)->paginate(50);
        }
        return view('pages.position.pipeline.candidate_result', compact('candidateList', 'position_id'));
    }

    public function candidateMoveToStage(Request $request)
    {
        $pipeline = Pipeline::findOrFail($request->pipeline);
        $pipeline->stage = $request->status;
        $pipeline->save();
        return 1;
    }

    public function openInterviewScheduleForm($pipeline)
    {
        $pipelineData = Pipeline::find($pipeline);

        $interview_date = $pipelineData->interview_date;
        $venue = $pipelineData->interview_venue;
        $interview_time_from = $pipelineData->interview_time_from;
        $interview_time_to = $pipelineData->interview_time_to;

        return view('pages.position.pipeline.interview_schedule', compact('pipeline', 'interview_date', 'venue', 'interview_time_from', 'interview_time_to'));
    }

    public function openInterviewScheduleFormMultiple(Request $request)
    {
        $candidates = $request->candidates;
        $pipelines = Pipeline::with('candidate')->whereIn('id', $candidates)->get();
        return view('pages.position.pipeline.interview_schedule_bulk', compact('candidates', 'pipelines'));
    }
    public function openOfferedForm($pipeline)
    {

        $today = Carbon::now()->format('d-m-Y');
        $pipelineData = Pipeline::find($pipeline);

        return view('pages.position.pipeline.candidateOffer', compact('pipeline', 'pipelineData', 'today'));
    }

    public function getCandidateAccrodingStage(Request $request)
    {

        $currentStage = $request->stage;

        $position = Position::with('findClientGet', 'pipeline.candidate')->find($request->position);

        $candidates = $position->pipeline->where('stage', $currentStage);

        return view('pages.position.pipeline.stage-wise-pipeline_candidate', compact('candidates', 'currentStage'));
        // $pipeline = $position->pipeline;
    }

    public function pipelineStageUpdate(Request $request)
    {
        $changeStatus = Pipeline::find($request->pipeline);
        $changeStatus->stage = $request->stage;
        $changeStatus->save();
        return 1;
    }

    public function candidateBatchHeader($pipeline_id, $position_id, $candidate_id)
    {
        $pipeline = Pipeline::find($pipeline_id);
        if (empty($pipeline) || !empty($pipeline->batch_header_file)) {
            return 0;
        }
        $candidate = Candidate::find($candidate_id);
        $position = Position::find($position_id);

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
        $candidate_name = str_replace(' ', '_', $candidate->name);
        $filename = $candidate_name . '_' . rand() . '.pdf';
        $documentFileName = "/batch_header/" . $filename;

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];

        $document->showWatermarkImage = true;
        $document->WriteHTML(view('pages.batchHeader.batchheader', compact('candidate', 'position')));
        Storage::disk('public_uploads')->put($documentFileName, $document->Output($documentFileName, "S"));
        $batch_header_file = "/home/admin/web/white-force.com/public_html/plus/batch_header/" . $filename;

        $delete_file_array = [];
        array_push($delete_file_array, $documentFileName);

        if (!empty($candidate->resume_file) && Storage::disk('s3')->exists('candidate_resume/' . $candidate->resume_file)) {
            try {
                $candidate_resume_path = "batch_header/candidate_resume/" . $filename;

                Storage::disk('public_uploads')->put($candidate_resume_path, file_get_contents(Storage::disk('s3')->url('candidate_resume/' . $candidate->resume_file)));

                $candidate_resume = '/home/admin/web/white-force.com/public_html/plus/' . $candidate_resume_path;

                $mpdf = new Mpdf();
                $mpdf->SetSourceFile($batch_header_file);
                for ($i = 1; $i <= $this->count($batch_header_file); $i++) {
                    $mpdf->AddPage();
                    $mpdf->useTemplate($mpdf->importPage($i));
                }

                $mpdf->SetWatermarkImage('/home/admin/web/white-force.com/public_html/plus/logo/whiteforce.png');
                $mpdf->showWatermarkImage = true;

                $mpdf->SetSourceFile($candidate_resume);
                for ($i = 1; $i <= $this->count($candidate_resume); $i++) {
                    $mpdf->AddPage();
                    $mpdf->useTemplate($mpdf->importPage($i));
                }

                $outputFilePath = '/home/admin/web/white-force.com/public_html/plus/batch_header/merged_pdf/' . $filename;
                $mpdf->Output($outputFilePath, 'F');
                array_push($delete_file_array, $candidate_resume_path);
                array_push($delete_file_array, 'batch_header/merged_pdf/' . $filename);
            } catch (\Exception $e) {
            }
        }
        $final_batch_header_file = !empty($outputFilePath) ? $outputFilePath : $batch_header_file;

        Storage::disk('s3')->put("candidate_batch_header/" . $filename, file_get_contents($final_batch_header_file), 'public');
        Storage::disk('public_uploads')->delete($delete_file_array);

        //matching
        $candidate_details = $candidate->resume_parser_json;
        $position_details = $position->jd_json;

        $matching = new RelatedCandidateController();
        if (!empty($candidate_details) && !empty($position_details)) {
            $matching_percentage = round($matching->compareJsonArrays($position_details, $candidate_details));
            $pipeline->matching_percentage = ($matching_percentage <= 20 && $matching_percentage > 5) ? ($matching_percentage + 25) : $matching_percentage;
        }

        $pipeline->batch_header_file = $filename;
        $pipeline->batch_header_date = date('Y-m-d');
        $pipeline->save();
    }

    public function downloadSingleBatchHeader($filename)
    {
        if (Storage::disk('s3')->exists('candidate_batch_header/' . $filename)) {
            $file = Storage::disk('s3')->get('candidate_batch_header/' . $filename);
            return response($file, 200)->header('Content-Type', Storage::disk('s3')->mimeType('candidate_batch_header/' . $filename))->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        }
    }

    public function count($path)
    {
        $pdf = file_get_contents($path);
        $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
        return $number;
    }


    public function downloadBulkBatchHeader(Request $request)
    {
        $all_ids = explode(",", $request->selected_pipeline_ids);
        $batchHeaderFiles = Pipeline::whereIn('id', $all_ids)->whereNotNull('batch_header_file')->pluck('batch_header_file')->toArray();

        if (empty($batchHeaderFiles)) {
            return response()->json(['error' => 'Please generate batch header first'], 500);
        }

        $zip = new ZipArchive();
        $zip_file = base_path();
        $zip_file = str_replace("src", "files.zip", $zip_file);
        if ($zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($batchHeaderFiles as $file) {
                $fileContents = Storage::disk('s3')->get('candidate_batch_header/' . $file);
                $fileName = basename($file);
                $zip->addFromString($fileName, $fileContents);
            }

            $zip->close();

            // Set appropriate headers for file download
            $headers = [
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="files.zip"',
            ];

            // Stream the zip file to the client
            return response()->download($zip_file, 'files.zip', $headers);
        } else {
            // Handle the case when the zip archive cannot be opened
            return response()->json(['error' => 'Failed to open zip archive'], 500);
        }
    }

    public function matching_percentage()
    {
        $candidate = Candidate::find(109);
        $position = Position::find(47);

        $candidate_details = json_decode($candidate->resume_parser_json, true);
        $position_details = json_decode($position->jd_json, true);
        dd($candidate_details, $position_details);

        $candidate_skills = array_unique(array_merge(explode(',', $candidate->skills), array_unique($candidate_details['Skills'])));
        $position_skills = array_unique(array_merge(explode(',', $position->skill_set), array_unique($position_details['Tools_and_technologies']), array_unique($position_details['Concept'])));

        $matched_skills = array_intersect($candidate_skills, $position_skills);

        $skill_percentage = count($matched_skills) * 10;
    }

    public function deleteBatchHeader()
    {
        $startDate = Carbon::now()->subDays(15)->toDateString();
        $getBatchHeaders = Pipeline::whereNotNull('batch_header_file')->where('batch_header_date', '<=', $startDate)->get();
        foreach ($getBatchHeaders as $batchHeader) {
            if (Storage::disk('s3')->exists('candidate_batch_header/' . $batchHeader->batch_header_file)) {
                Storage::disk('s3')->delete('candidate_batch_header/' . $batchHeader->batch_header_file);
            }
            $batchHeader->batch_header_file = null;
            $batchHeader->batch_header_date = null;
            $batchHeader->save();
        }
    }

    public function removeCandidateFromPipeline(Request $request)
    {
        $candidates =  $request->candidates ?? [];
        if (!empty($candidates)) {
            Pipeline::whereIn('id', $request->candidates)->delete();
            return 1;
        }
        return 0;
    }

    function openJoinedForm($pipeline)
    {
        $position = Pipeline::with('position')->find($pipeline);
        return view('pages.position.pipeline.candidate_join', compact('pipeline', 'position'));
    }


    function savedJoinedDetails(Request $request)
    {
        $pipeline = Pipeline::find($request->pipeline);
        $pipeline->position->management_fee = $request->management_fee;
        $pipeline->position->flat_amount = $request->flat_amount;
        $pipeline->position->save();

        if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
            $fee = $request->management_fee;
            if ($fee) {
                if ($fee == '0') {
                    $value = $request->flat_amount;
                } else if ($fee == '8.33') {
                    $value = $pipeline->actual_ctc ?? 0;
                } else {
                    $value = round(($pipeline->actual_ctc * $fee * 12) / 100);
                }
            }
            $pipeline->offerd_ctc = $value;
            $pipeline->save();
        }

        $candidate = Candidate::find($pipeline->candidate_id);

        if (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {

            if (!empty($request->offerLetter) && $request->hasFile('offerLetter')) {
                $image = $request->file('offerLetter');
                $image_name = $image->getClientOriginalName();
                $path = '/offerLetter/';
                $image->move(public_path() . $path, $image_name);
                $candidate->offer_letter = $path . $image_name;
            }
        } else if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {

            if (!empty($request->offerLetter) && $request->hasFile('offerLetter')) {
                $image = $request->file('offerLetter');
                $image_name = $image->getClientOriginalName();
                $path = '/offerLetter/';
                $image->move(public_path() . $path, $image_name);
                $candidate->offer_letter = $path . $image_name;
            }
        }
        $candidate->save();


        $curQuarter = ceil(date('n', time()) / 3);
        $curYear = date('Y');
        $pipeline->join_quarter = $curQuarter;
        $pipeline->join_quarter_year = $curYear;
        $pipeline->stage = 'joined';
        $pipeline->is_joined = '1';
        $pipeline->save();
        return 1;
    }

    function old_savedJoinedDetails(Request $request)
    {
        $pipeline = Pipeline::find($request->pipeline);
        $pipeline->position->management_fee = $request->management_fee;
        $pipeline->position->flat_amount = $request->flat_amount;
        $pipeline->position->save();

        if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
            $fee = $request->management_fee;
            if ($fee) {
                if ($fee == '0') {
                    $value = $request->flat_amount;
                } else if ($fee == '8.33') {
                    $value = $pipeline->actual_ctc ?? 0;
                } else {
                    $value = round(($pipeline->actual_ctc * $fee * 12) / 100);
                }
            }
            $pipeline->offerd_ctc = $value;
            $pipeline->save();
        }

        $candidate = Candidate::find($pipeline->candidate_id);
        // Get Target

        // Auth::user()->checkTarget()
        $lastInsertedRecord = Target::where('user_id', $pipeline->created_by)->orderBy('id', 'desc')->first();
        if (!$lastInsertedRecord) {
            return 0;
        }

        if (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {

            // $candidate->uan = $request->uan_esic;
            // $candidate->is_payroll = $request->is_payroll;
            // $candidate->companytype = $request->company_type;

            if (!empty($request->offerLetter) && $request->hasFile('offerLetter')) {
                $image = $request->file('offerLetter');
                $image_name = $image->getClientOriginalName();
                $path = '/offerLetter/';
                $image->move(public_path() . $path, $image_name);
                $candidate->offer_letter = $path . $image_name;
            }
        } else if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
            // $candidate->uan = $request->uan_esic;
            // $candidate->is_payroll = $request->is_payroll;
            // $candidate->companytype = $request->company_type;

            if (!empty($request->offerLetter) && $request->hasFile('offerLetter')) {
                $image = $request->file('offerLetter');
                $image_name = $image->getClientOriginalName();
                $path = '/offerLetter/';
                $image->move(public_path() . $path, $image_name);
                $candidate->offer_letter = $path . $image_name;
            }
        }
        $candidate->save();



        // Target Calculation
        if ($lastInsertedRecord) {
            // Target Calculations
            $lastInsertedRecord->complete = $lastInsertedRecord->complete + $pipeline->offerd_ctc;
            $lastInsertedRecord->remaining = $lastInsertedRecord->remaining - $pipeline->offerd_ctc;
            $lastInsertedRecord->save();

            //Save Joining Details
            $curQuarter = ceil(date('n', time()) / 3);
            $curYear = date('Y');
            $pipeline->join_quarter = $curQuarter;
            $pipeline->join_quarter_year = $curYear;
            $pipeline->stage = 'joined';
            $pipeline->is_joined = '1';
            $pipeline->save();
            return 1;
        } else {
            return 0;
        }
    }
}
