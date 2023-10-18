<?php

namespace App\Http\Controllers;

use App\Exports\PipelineExport;
use App\Models\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TrackerController extends Controller
{
    protected $data;

    // function tracker()
    // {
    //     $pipeline = 314;
    //     // return Pipeline::where('position_id', $pipeline)->get();
    //     $pipelines = Pipeline::where('position_id', $pipeline)->get();
    //     return view('pages.tracker.tracker', compact('pipelines'));
    // }




    public function exportToExcel(Request $request)
    {

        $pipelineIds =  explode(',', $request->selected_pipeline_ids);

        $pipelines = Pipeline::whereIn('id', $pipelineIds)->get();

        $all = [];
        foreach ($pipelines as $key => $tracker) {
            $record = [];
            $current_salary = '₹ '.inc_format((int)$tracker->candidate->current_salary ?? 0);
            $expected_salary = '₹ '.inc_format((int)$tracker->candidate->expected_salary ?? 0);
            array_push($record, ++$key, date('F, d Y'),  $tracker->position->position_name, $tracker->candidate->name, $tracker->candidate->mobile, $tracker->candidate->email, $tracker->candidate->current_location, $tracker->candidate->total_experience. ' Year(s)' ?? 0, $current_salary, $expected_salary,  $tracker->candidate->notice_period, 'No Remark');
            $all[$key] = $record;
        }
        

        $data = [
            [
                'S.No',
                'Date',
                'Position',
                'Name of the Candidate',
                'Mobile Number',
                'Email',
                'Current Location',
                'Total Exp',
                'Current CTC',
                'Exp CTC',
                'Notice Period',
                'REMARK'
            ],$all

        ];

        $user = Auth::user()->name;
        $time = time();
        $filename = $user.'_tracker_'.$time.".xlsx";
        
        return Excel::download(new PipelineExport($data), $filename);
    }
}
