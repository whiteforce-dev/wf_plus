<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailAttachmentSyncRequest;
use GuzzleHttp\Client;
use App\Models\Candidate;


class EmailAttachmentSyncRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $request_id;
    public $timeout = 300; 

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_id)
    {
        $this->request_id = $request_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sync_request = EmailAttachmentSyncRequest::find($this->request_id);
        if(empty($sync_request)){
            $sync_request->status = 3;
            $sync_request->save();
            return 0;
        }

        $client = new Client();
        try{
            $url = 'https://happyhire.co.in/mail_parsing/api/';
            $data = [
                "type"       => $sync_request->account_type,   
                "email"      => $sync_request->email,
                "password"   => $sync_request->app_password,
                "start_date" => date('d-m-Y',strtotime($sync_request->from_date)),
                "end_date"   => date('d-m-Y',strtotime($sync_request->to_date))
            ];
    
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT , 600);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            if ($response === false) {
                if (curl_errno($curl) == 300) {
                    $sync_request->status = 5;
                    $sync_request->save();
                    return 0;
                } else {
                    $sync_request->status = 3;
                    $sync_request->save();
                    return 0;
                }
            }
            $response_data = json_decode($response);
            if(!empty($response_data) && !empty($response_data->data)){
                $save_candidate_ids = $this->saveData($response_data->data, $sync_request->user_id, $sync_request->software_category);
            }
            $sync_request->status = !empty($save_candidate_ids) ? 1 : 4;
            $sync_request->candidate_ids = $save_candidate_ids;
            $sync_request->save();
            return 1;
        } catch (\Exception $ex){
            $sync_request->status = 3;
            $sync_request->save();
            return 0;
        }
    }

    public function saveData($response_data, $user_id, $software_category){
        $save_candidate_ids = [];
        foreach($response_data as $data){
            $candidate_name = (!empty($data->Name) && !empty($data->Name[0]))  ? $data->Name[0] : '';
            $candidate_email = (!empty($data->Email) && !empty($data->Email[0]))  ? $data->Email[0] : '';
            $candidate_mobile = (!empty($data->Phone) && !empty($data->Phone[0]))  ? $data->Phone[0] : '';
            
            if(!empty($candidate_name) && (!empty($candidate_email) || !empty($candidate_mobile))){
                $check = Candidate::where('email',$candidate_email)->first();
                if(empty($check)){
                    $candidate = new Candidate();
                    $candidate->name = $candidate_name;
                    $candidate->email = $candidate_email;
                    $candidate->mobile = $candidate_mobile;
                    $candidate->address = (!empty($data->Address) && !empty($data->Address[0]))  ? $data->Address[0] : '';
                    $candidate->gender = (!empty($data->Gender) && !empty($data->Gender[0]))  ? $data->Gender[0] : '';
                    $candidate->date_of_birth = (!empty($data->DOB) && !empty($data->DOB[0]))  ? date('Y-m-d',strtotime($data->DOB[0])) : null;
                    $candidate->skills = !empty($data->Skills) ? implode(',',$data->Skills) : '';
                    $candidate->resume_parser_json = json_encode($data);
                    $candidate->added_from = 'email';
                    $candidate->created_by = $user_id;
                    $candidate->software_category = $software_category;
                    $candidate->save();
                    array_push($save_candidate_ids,$candidate->id);
                }
            }
        }
        return !empty($save_candidate_ids) ? implode(',',$save_candidate_ids) : null;
    }
}
