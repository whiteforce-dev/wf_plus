<?php


namespace App\Jobs;

use App\Mail\Hbd;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmailTest as SendEmailTestMail;
use App\Mail\Sendresumemail;
use App\Mail\Shortlist;
use Mail;


class SendResumes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $details;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->details[0]['email'])->bcc($this->details[0]['recruiter_email'])->send(new Sendresumemail($this->details));

    }
}
