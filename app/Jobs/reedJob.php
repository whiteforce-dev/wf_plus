<?php

namespace App\Jobs;

use App\Http\Controllers\NewJobPostingController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class reedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $reedInfo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($reedInfo)
    {
        $this->$reedInfo = $reedInfo;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reed_response = (new NewJobPostingController())->sendToReed($this->reedInfo);
    }
}
