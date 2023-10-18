<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\SyncedEmailResume;
use App\Http\Controllers\AnalyzerController;

class SyncedAttachmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; // 2 hours
    public $maxTries = 2;
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
        try{
            $url = 'http://139.59.14.185/upload/api/resume_link_parsing/';
            $data = [
                'url' => $this->details->link,
            ]; 
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS,($data));
            $response = curl_exec($curl);
            $controller = new AnalyzerController();
            $resume_response = $controller->createResumeWithParser($response,$this->details->upploaded_by);
            $temp = SyncedEmailResume::where('id',$this->details->id)->first();
            $res = json_decode(json_encode($resume_response),true);
            if(!empty($res)){
                if(!empty($res['original']['status']) && $res['original']['status'] == true){
                    $temp->status = 1;
                    $temp->response = json_encode($res['original']['data']);
                } else {
                    $temp->status = 2;
                    $temp->response = $res['original']['data'];
                }
            } else {
                $temp->status = 2;
            }
            $temp->save();
            curl_close($curl); 
        } catch(\Exception $e){
            \Log::error($e);
            $temp = SyncedEmailResume::where('id',$this->details->id)->first();
            $temp->status = 2;
            $temp->save();
        }
        
    }

}
