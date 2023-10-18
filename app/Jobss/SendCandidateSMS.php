<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\SmsResponse;

class SendCandidateSMS implements ShouldQueue
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
      $mobile = $this->details['mobile'];~
      $message = $this->details['message'];
      $candidate_id = $this->details['candidate_id'];
      $creator = $this->details['creator'];
      $responsechk = file_get_contents("http://arise.arisesmsworld.com/submitsms.jsp?user=SEYEIT&key=55524d5999XX&mobile=$mobile&message=$message&senderid=WFORCE&accusage=1");
      $saveRes = new SmsResponse();
      $saveRes->candidate_id = $candidate_id;
      $saveRes->mobile = $mobile;
      $saveRes->response = $responsechk ?? 'No Response';;
      $saveRes->creator = $creator;
      $saveRes->save();

    }
}
