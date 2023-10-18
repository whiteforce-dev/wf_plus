<?php

namespace App\Jobs;

use App\Mail\Jobdescription;
use App\Mail\SendEmailTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class Sendmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct($receiverAddress, $content)
    // {
    //     $this->receiverAddress = $receiverAddress;
    //     $this->content = $content;
    // }

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
        // dd($email);
        $email = new SendEmailTest();
        Mail::to($this->details['email'])->send($email);
        // Mail::to($this->receiverAddress)->send(new Jobdescription($this->content));
    }
}
