<?php


namespace App\Jobs;
use App\Http\Controllers\CandidateController;
// use App\Mail\Hbd;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmailTest as SendEmailTestMail;
use App\Mail\Shortlist;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;


class Sendhbd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $info;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::send('hbdmail', ['data' => $this->info], function ($message) {
                $message->to('priyaswhiteforce@gmail.com');
                $message->from('priyaswhiteforce@gmail.com', 'priya');
            });
        

    }
}
