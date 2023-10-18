<?php

namespace App\Http\Controllers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientAllotment;
use App\Models\Client;

class ApiController extends Controller
{
    public function sendResponse($result, $message)
    {
        // return $result;
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function getUserListByType($software_category){
        $message = "User List";
        if ($software_category) {
            $allUsers = getManagerAndSmList($software_category);
            return $this->sendResponse($allUsers, $message);
        }
        return $this->sendError('Invalid Request', 'Invalid Request');
    }


    public function allotClientManager(){
        $data = file_get_contents("php://input");
        $request = json_decode($data, TRUE);
        if ($request) {
            $client = Client::where(['bd_id' => $request['enquiry_id'],'is_added_by_bd'=>1])->first();
            if(empty($check)){
                $client = new Client ();
            }
            $client->bd_id = $request['enquiry_id'];
            $client->name = $request['client_name'];
            $client->type = $request['type'];
            $client->created_by = 0;
            $client->alloted_to = 0;
            $client->alloted_by = $request['alloted_by'];
            $client->percentage = $request['percentage'];
            $client->website = $request['website'];
            $client->about = $request['aboutClient'];
            $image_code = $request['clientImage'];
            if(!empty($image_code)){
                $filepath = time() . '_' . rand() . '.png';
                Storage::disk('s3')->put('company/images/'.$filepath, base64_decode($image_code), 'public');
                $client->image = $filepath;
            }
            $client->email = $request['email'];
            $client->alloted_date = $request['alloted_date'];
            $client->no_requirement = $request['no_req'];
            $client->location = $request['address_address'];
            $client->sub_type = $request['sub_type'];
            $client->is_added_by_bd = 1;
            $client->software_category = $request['alloted_software_type'];
            $client->save();
            
            $allotted = ClientAllotment::where('client_id',$client->id)->delete();
            $allotted_to_array = json_decode($request['alloted_to']);
            foreach($allotted_to_array as $allotted_to){
                $allotment = new ClientAllotment();
                $allotment->client_id = $client->id;
                $allotment->alloted_by = $request['alloted_by'];
                $allotment->alloted_to = $allotted_to;
                $allotment->software_category = $request['alloted_software_type'];
                $allotment->save(); 
            } 
            
            $message= 'true';
            return $this->sendResponse($request, $message);
        }
    }

    public function UserName($id){
        $message = 'User name';
        $comment = User::where('id',$id)->value('name');
        return $this->sendResponse($comment, $message);
    }
}
