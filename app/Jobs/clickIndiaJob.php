<?php

namespace App\Jobs;

use App\Http\Controllers\CommonController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class clickIndiaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $job_id;
    public $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($job_id, $userId)
    {
        $this->job_id = $job_id;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $click_india_job_status = (new CommonController())->sendToClickIndia($this->job_id, $this->userId);
    }
}
