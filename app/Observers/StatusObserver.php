<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Pipeline;
use App\Models\Target;
use Illuminate\Support\Facades\Auth;

class StatusObserver
{
    /**
     * Handle the Pipeline "created" event.
     *
     * @param  \App\Models\Pipeline  $pipeline
     * @return void
     */

    public function created(Pipeline $model)
    {
        $row = $model->replicate();
        $row = $row->toArray();
        $value = History::create($row);
        $value->type = "sourcing";
        $value->changed_by = Auth::id();
        $value->save();
    }

    public function updating(Pipeline $pipeline)
    {
        if ($pipeline->getOriginal('stage') === 'joined' && $pipeline->stage !== 'joined') {

            $pipeline->join_quarter = null;
            $pipeline->join_quarter_year = null;
            $pipeline->is_joined = 0;

            // Run your desired function when the status changes from "joined" to any other value
            // $lastInsertedRecord = Target::where('user_id', $pipeline->created_by)->orderBy('id', 'desc')->first();

            // if ($lastInsertedRecord) {
            //     // Target Calculations
            //     $lastInsertedRecord->complete = $lastInsertedRecord->complete - $pipeline->offerd_ctc;
            //     $lastInsertedRecord->remaining = $lastInsertedRecord->remaining + $pipeline->offerd_ctc;
            //     $lastInsertedRecord->save();
            // }
            
        }
    }

    public function updated(Pipeline $model)
    {
        if ($model->isDirty('stage')) {
             $row = $model->replicate();
             $row = $row->toArray();
             $value = History::create($row);
             $value->type = "stage updated";
             $value->changed_by = Auth::id();
             $value->save();
        }

        if ($model->isDirty('interview_date')) {
            $row = $model->replicate();
            $row = $row->toArray();
            $value = History::create($row);
            $value->type = "interview";
            $value->changed_by = Auth::id();
            $value->save();
        }

        if ($model->isDirty('joining_date')) {
            $row = $model->replicate();
            $row = $row->toArray();
            $value = History::create($row);
            $value->type = "joining date";
            $value->changed_by = Auth::id();
            $value->save();
        }

        // if ($model->isDirty('offerd_ctc')) {
        //     $row = $model->replicate();
        //     $row = $row->toArray();
        //     $value = History::create($row);
        //     $value->type = "offerd";
        //     $value->save();
        // }

    }
}
