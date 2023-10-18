<?php

namespace App\Jobs;

use App\Http\Controllers\CommonController;
use App\Models\JobPostedTo;
use App\Models\Send_Linkedin_jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class linkedinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $linkedinData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($linkedinArr)
    {
        $this->linkedinData = $linkedinArr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $job_posted_tos = new JobPostedTo();
        $job_posted_tos->job_id = $this->linkedinData['job_id'];
        $job_posted_tos->reference_no = $this->linkedinData['reference_no'];
        $job_posted_tos->publish_to = 'linkedin';
        $job_posted_tos->user_id = $this->linkedinData['auth_id'];
        $job_posted_tos->save();

        $Send_linkedin_jobs = new Send_Linkedin_jobs();
        $Send_linkedin_jobs->job_id = $this->linkedinData['job_id'];
        $Send_linkedin_jobs->job_description_linkedin = $this->linkedinData['job_description'];
        $Send_linkedin_jobs->save();
        $Send_linkedin_jobs_status = (new CommonController())->sendToLinkedin($this->linkedinData['job_id']);
    }
}
