<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\PipelineController;

class CandidateBatchHeader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $position_id;
    public $canddiate_id;
    public $pipeline_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pipeline_id,$position_id,$canddiate_id)
    {
        $this->position_id = $position_id;
        $this->canddiate_id = $canddiate_id;
        $this->pipeline_id = $pipeline_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $create_batch_header = (new PipelineController())->candidateBatchHeader($this->pipeline_id,$this->position_id,$this->canddiate_id);
    }
}
