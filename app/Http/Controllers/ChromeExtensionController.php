<?php

namespace App\Http\Controllers;
header('Access-Control-Allow-Origin: http://localhost:8100');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With,Content-Type');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Source;
use Dompdf\Dompdf;
use Dompdf\Options;
use Storage;

class ChromeExtensionController extends Controller
{
    public function sendResponse($result, $message){
        $response = [
            'status' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200){
        $response = [
            'status' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function userLoginFromExtension(){
        $message = "User Logged In Successfully."; 
        $data = file_get_contents("php://input");
        $request = json_decode($data, TRUE);
        if($request){
            if(empty($request['email']) || empty($request['password'])){
                $message = "Email and Password can not be empty.";
                return $this->sendError($message, $message); 
            }
            
            $checklogin = User::where('email',$request['email'])->where('is_active',1)->select('id','profile_image','name','email','contact','password')->first();
            if(!empty($checklogin)){
                if (Hash::check($request['password'], $checklogin->password)){
                    return $this->sendResponse($checklogin, $message);
                }
            }
            $message = "Invalid Username / Password.";
            return $this->sendError($message, $message); 
        }  else {
            $message = "Invalid Request.";
            return $this->sendError($message, $message); 
        }
    }

    public function storeCandidateProfileData(){
        $message = "Candidate Inserted Successfully.";
        $data = file_get_contents("php://input");
        $request = json_decode($data, TRUE);
        if($request) {
            try{
                if(empty($request['email']) && empty($request['mobile'])){
                    $message = "Email and mobile can not be empty";
                    return $this->sendError($message, $message); 
                }
                if(empty($request['created_by'])){
                    $message = "You are not logged in";
                    return $this->sendError($message, $message); 
                }
    
                if(!empty($request['email'])){
                    $candidate = Candidate::where('email',$request['email'])->first();
                } else if(!empty($request['mobile'])){
                    $candidate = Candidate::where('mobile',$request['mobile'])->first();
                }
                if(!empty($candidate)){
                    $message = "User Already Exists";
                    return $this->sendError($message, $message);
                }
                $candidate = new Candidate();
                $candidate->name = !empty($request['name']) ? $request['name'] : '';
                $candidate->email = !empty($request['email']) ? $request['email'] : '';
                $candidate->mobile = !empty($request['mobile']) ? $request['mobile'] : '';
                
                $candidate->preferred_location = !empty($request['pref_location']) ? $request['pref_location'] : '';
                $candidate->current_location = !empty($request['current_location']) ? $request['current_location'] : '';
                $candidate->expected_salary = !empty($request['expected_salary']) ? $request['expected_salary'] : '';
                $candidate->date_of_birth = !empty($request['dob']) ? date('Y-m-d',strtotime($request['dob'])) : null;
                $candidate->gender = !empty($request['gender']) ? strtolower($request['gender']) : '';
                $candidate->marital_status = !empty($request['marital_status']) ? strtolower($request['marital_status']) : '';
                $candidate->total_experience = !empty($request['total_experience']) ? $request['total_experience'] : '';
                $candidate->experience = !empty($request['total_experience']) ? 'yes' : 'no';
                $candidate->current_title = !empty($request['current_designation']) ? $request['current_designation'] : '';
                $candidate->skills = !empty($request['skills']) ? implode(',',$request['skills']) : '';
                $candidate->current_salary = !empty($request['current_salary']) ? $request['current_salary'] : '';
                $candidate->highest_qualification = !empty($request['highest_qualification']) ? $request['highest_qualification'] : '';
                $candidate->highest_qualification_year = !empty($request['highestQualification_year']) ? $request['highestQualification_year'] : '';
                $candidate->current_company = !empty($request['current_company']) ? $request['current_company'] : '';
                $candidate->created_by = !empty($request['created_by']) ? $request['created_by'] : '';
                $candidate->source = !empty($request['domain']) ? $request['domain'] : 'Other';
                $candidate->added_from = 'extension';
                $candidate->notice_period = !empty($request['notice_period']) ? json_encode($request['notice_period']) : '';
                $candidate->software_category = User::where('id',$request['created_by'])->value('software_category') ?? 'onrole';
                
                if(!empty($request['resumeHTML'])){
                    $html = $request['resumeHTML'];
                    $options = new Options();
                    $options->set([
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ]);
                    $options->setIsRemoteEnabled(true);
                    $customPaper = array(0, 0, 720, 900);
                    $pdf = \PDF::setOptions([
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/'),
                        'setIsRemoteEnabled' => true,
                        'images' => true
                        ])->loadView('chromeresumepdf', compact('html'))->setPaper($customPaper, 'portrait');
                        
                        
                        $content = $pdf->output();
                        $filepath = time() . '_' . rand() . '.pdf';
                        Storage::disk('s3')->put('candidate_resume/'.$filepath, $content,'public');
                        
                        $candidate->resume_file = $filepath;
                    }
                    
                    try{
                        if(!empty($request['imgSrc']) && $request['domain'] != "Job Hai"){
                            $path_array = explode("/",$request['imgSrc']);
                            $image_path = time() . '_'. $path_array[count($path_array) - 1];
                            if($image_path < 255){
                                Storage::disk('s3')->put('candidate_profile_pic/'.$image_path, file_get_contents($request['imgSrc']),'public');
                                $candidate->image = $image_path;
                            }
                        }
                    } catch(\Exception $e){}
                unset($request['resumeHTML']);
                unset($request['imgSrc']);
                $candidate->resume_parser_json = json_encode($request);
                $candidate->save();
                
                return $this->sendResponse($request, $message);
            } catch(\Exception $e){
                $message = $e->getMessage();
                return $this->sendError($message, $message);
            }
        } else{
            $message = "Invalid Request";
            return $this->sendError($message, $message);
        }    
    }
}
