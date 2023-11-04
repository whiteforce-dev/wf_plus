<?php

namespace App\Http\Controllers;

// use GuzzleHttp\Client;

use App\Models\citiess;

use App\Models\ClientList;
use App\Models\Degree;
use App\Models\Degrees;
use App\Models\Joiningdetail;
use App\Models\MailDetail;
use App\Models\newstate;
use App\State;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class JoiningCandidateController extends Controller
{
    // Step 1
    public function basicDetails(request $request)
    {
        //   return $request;
        $company=$request->companyname;
        //   return $company;
        // $clients= ClientList::find($company);
        $client = Http::get('https://whiteforcepayroll.com/admin/api/get-client-list');
        $client = json_decode($client);
        $clientslist = $client->data;
     foreach($clientslist as $client)
     {
        // return $client;
        if($client->client_id == $company)
        {
            $clientname = $client->client_name;
            // return $clientname;
        }
     }
        $clients = $clientname;
        $companytype=$request->companytype;
        $email=$request->email;
        $joblocation=$request->joblocation;
        $candidate_recruiter_id=$request->user_id;
        $type=$request->type;
        $tendernumber=$request->tendernumber;
        $tendername=$request->tendername;
        $candidate_id = $request->candidate_id;
        //  $clients= ClientList::where('client_id',$company)->find();
        return view('joining_form.basic_details', compact('company', 'email', 'joblocation', 'candidate_recruiter_id', 'type', 'tendernumber', 'tendername', 'companytype', 'clients','candidate_id'));

    }

    public function storeBasicDetails(Request $request)
    {
        // return $request;

        $request->validate([
            'name'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'fathername'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'mothername'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'dob'=>'required',
            'gender'=>'required',
            'marital_status'=>'required',
            'emailid'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'address'=>'required',
            'mobileno'=> 'required|numeric|digits:10',
            'dateofjoining'=>'required',
            'company'=>'required',
            'salary'=>'required',
            'designation'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'photo'=>'required|mimes:jpeg,bmp,png,jpg,jfif,',
        ]);



        // Save Image Code
        $folderPath = 'joining_candidate/profile/';
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = $folderPath;
            $path = $image->move($destinationPath, $name);
            $request->merge([
                'profile_url' => 'joining_candidate/profile/'.$name,
            ]);

        } else {
            $request->merge([
                'profile_url' => session('basic')['profile_url'],
            ]);
        }



        $basic= session()->put('basic', $request->except(['photo', '_token']));
        return redirect('joining-form/education');
    }


    // Step 2
    public function education()
    {
        $degrees = Degree::get();
        return view('joining_form.education', compact('degrees'));
    }

    public function storeEducation(Request $request)
    {
        session()->put('education', $request->except(['_token']));
        return redirect('joining-form/bank-details');
    }


    // Step 3
    public function bankDetails()
    {
        return view('joining_form.bank');
    }

    public function storeBankDetails(Request $request)
    {
        // return $request->all();
        $request->validate([
            'bankname'=> 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'bankbranch'=>'required',
            'bankaccno'=> 'required|numeric',
            // 'ifsc'=>'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'ifsc'=>'required',
            'aadharno'=> 'required|numeric',
            'pan'=> 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',

             'aadhar_url'=>'required|mimes:jpeg,bmp,png,jpg',
             'pan_url'=>'required|mimes:jpeg,bmp,png,jpg',
        ]);

        // Save Image Code
        $folderPath = 'joining_candidate/aadhar/';
        if ($request->hasFile('aadhar_url')) {
            $image = $request->file('aadhar_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = $folderPath;
            $path = $image->move($destinationPath, $name);
            $request->merge([
             'aadhar_image' => 'joining_candidate/aadhar/'.$name,
    ]);

        } else {
            $request->merge([
                'aadhar_image' => session('basic')['aadhar_image'],
            ]);
        }

        $folderPath = 'joining_candidate/pan/';
        if ($request->hasFile('pan_url')) {
            $image = $request->file('pan_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = $folderPath;
            $path = $image->move($destinationPath, $name);

            $request->merge([
                'pan_image' => 'joining_candidate/pan/'.$name,
            ]);
        } else {
            $request->merge([
                'pan_image' => session('basic')['pan_image'],
            ]);
        }

        session()->put('bank_details', $request->except(['_token','aadhar_url','pan_url']));

        return redirect('joining-form/work-experience');
    }

    // Step 4
    public function workExperience()
    {
        return view('joining_form.work_experience');
    }

    public function storeWorkExperience(Request $request)
    {
        session()->put('work_experience', $request->except(['_token']));
        return redirect('joining-form/skills');
    }

    // Step 5
    public function skills()
    {

        return view('joining_form.skills');
    }

    // Step 6
    public function thankyou()
    {

        return view('joining_form.thankyoupage');
    }

    public function storeSkills(Request $request)
    { 
        $candidate_id = session('basic')['candidate_id'];
        $candidate_emailid = session('basic')['emailid'];

        $joindetails = JoiningDetail::where(['id' => $candidate_id, 'emailid' => $candidate_emailid ])->first();
        // return $joindetails;
        $joindetails-> name= session('basic')['name'];
        $joindetails->fathername = session('basic')['fathername'];
        $joindetails->mothername = session('basic')['mothername'];
        $joindetails->dob =session('basic')['dob'];
        $joindetails->gender = session('basic')['gender'];
        $joindetails->marital_status = session('basic')['marital_status'];
        $joindetails->spouse = session('basic')['spouse'];
        // $joindetails->emailid =session('basic')['emailid'];
        $joindetails->address = session('basic')['address'];
        $joindetails->mobileno = session('basic')['mobileno'];
        $joindetails->dateofjoining = session('basic')['dateofjoining'];
        $joindetails->company = session('basic')['company'];
        $joindetails->companytype = session('basic')['companytype'];
        $joindetails->tendernumber = session('basic')['tendernumber'];
        $joindetails->tendername = session('basic')['tendername'];
        $joindetails->city = session('basic')['city'];
        $joindetails->statelist = session('basic')['statelist'];
        $joindetails->country = session('basic')['country'];
        $joindetails->pincode = session('basic')['pincode'];
        $joindetails->joblocation = session('basic')['joblocation'];
        $joindetails->candidate_recruiter_id = session('basic')['candidate_recruiter_id'];
        $joindetails->type = session('basic')['type'];

        $joindetails->designation = session('basic')['designation'];
        $joindetails->salary = session('basic')['salary'];
        $joindetails->photo = session('basic')['profile_url'];

        $joindetails->pgname = session('education')['pgname'];
        $joindetails->postboard = session('education')['postboard'];
        $joindetails->postyear = session('education')['postyear'];
        $joindetails->postlocation = session('education')['postlocation'];
        $joindetails->ugname = session('education')['ugname'];
        $joindetails->ugboard = session('education')['ugboard'];
        $joindetails->ugyear = session('education')['ugyear'];
        $joindetails->uglocation = session('education')['uglocation'];
        $joindetails->twelvname = session('education')['twelvname'];
        $joindetails->twelvboard = session('education')['twelvboard'];
        $joindetails->twelvyear = session('education')['twelvyear'];
        $joindetails->twelvlocation = session('education')['twelvlocation'];
        $joindetails->tenthname = session('education')['tenthname'];
        $joindetails->tenthboard = session('education')['tenthboard'];
        $joindetails->tenthyear = session('education')['tenthyear'];
        $joindetails->tenthlocation = session('education')['tenthlocation'];
        $joindetails->bankname = session('bank_details')['bankname'];
        $joindetails->bankbranch = session('bank_details')['bankbranch'];
        $joindetails->bankaccno = session('bank_details')['bankaccno'];
        $joindetails->ifsc = session('bank_details')['ifsc'];
        $joindetails->aadharno = session('bank_details')['aadharno'];
        $joindetails->pan = session('bank_details')['pan'];
        $joindetails->esic = session('bank_details')['esic'];
        $joindetails->pan_url = session('bank_details')['pan_image'];
        $joindetails->aadhar_url = session('bank_details')['aadhar_image'];
        $joindetails->oldcompname = session('work_experience')['oldcompname'];
        $joindetails->olddesignation = session('work_experience')['olddesignation'];
        $joindetails->startdate = session('work_experience')['startdate'];
        $joindetails->enddate = session('work_experience')['enddate'];
        $joindetails->jd = session('work_experience')['jd'];
        $joindetails->skill = $request->skill;
        $joindetails->payroll_client_id = session('basic')['company'] ;
// return $joindetails;
        $joindetails->save();
        session()->flush('basic');
        session()->flush('education');
        session()->flush('bank_details');
        session()->flush('work_experience');

        return view('joining_form.thankyoupage');
    }


    public function get_state($country)
    {
        // return $country;
        $states= newstate::where('country_id', $country)->get();
        //   return $states;
        return view('joining_form.statedata', compact('states'));
    }
    public function get_city($state)
    {
        //    return $state;
        $cities= Citiess::where('state_id', $state)->get();
        //  return $cities;
        return view('joining_form.citydata', compact('cities'));
    }



    public function join()
    {
        // $clientlist = Http::get('https://whiteforcepayroll.com/admin/api/get-client-list');
        $clients = Http::get('https://whiteforcepayroll.com/admin/api/get-client-list');
        $clients = json_decode($clients);
        $clients = $clients->data;
// return $clients;
        // $clients = $clientlist->whereNotIn('client_id', [8])->get();
if(Auth::user()->type == 'admin') {
    $email= JoiningDetail::where('software_category',Auth::user()->software_category)->get();
    $email_count= $email->count();
}
else
{

    $uid=Auth::user()->id;
    $email_count = JoiningDetail::where(['sender_id'=> $uid ,'software_category' => Auth::user()->software_category ])->count();

}
        return view('joining_form.joiningmail', compact('clients','email_count'));
    }
    public function sendjoinform(Request $request)
    {
        // return $request;
        $emails=$request->email;
        $joblocation=$request->joblocation;
        $company=$request->company;
        $companytype=$request->companytype;
        $tendernumber=$request->tendernumber;
        $tendername=$request->tendername;
        // return $emails;
        $request->validate([
            'email'=>'required|unique:joiningdetails,emailid',
]);

        if ($emails) {


            foreach ($emails as $empemail) {
                $user=Auth::user();
                $user_id = $user->id;
                $receiver = new JoiningDetail();
                $receiver->emailid = $empemail;
                $receiver->sender_id = $user->id;
                $receiver->software_category = Auth::user()->software_category ? Auth::user()->software_category : "onrole";
                $receiver->save();
                // $candidate_id = $receiver->id;
                             
                $candidate = JoiningDetail::where('emailid', $empemail)->first();
                $candidate_id = $candidate->id;
                $str =  'joining-form/basic-details?email='.$empemail.'&type=offrole&user_id='.$user_id.'&joblocation='.$joblocation.'&companyname='.$company. '&candidate_id=' .$candidate_id ;

                $candidate->link = $str;
                $candidate->save();
                // return $candidate;

                // $receiver->link = $str;



               
// return $receiver;

                $input['subject'] = 'Joining Form Formality';
                $input['email'] = $empemail;
                $input['joblocation'] = $joblocation;
                $input['company'] = $company;
                $input['companytype'] = $companytype;
                $input['tendernumber'] = $tendernumber;
                $input['tendername'] = $tendername;
                $input['candidate_id'] = $candidate_id;

                
                // return $input['user_id']=$user->id;
                // return $user;
                // return $_SESSION['AdminDetails'];
                // $input['name'] =  $data->name;
                $input['user_id']=$user->id;



                Mail::send('joining_form.joiningformlink', ['user_id'=> $input['user_id'],'email'=>$input['email'],'joblocation'=>$input['joblocation'],'company'=>$input['company'],'companytype'=>$input['companytype'],'tendername'=>$input['tendername'],'tendernumber'=>$input['tendernumber'],'candidate_id'=>$input['candidate_id']], function ($message) use ($input) {
                    $message->to($input['email']);
                    $message->subject($input['subject']);

                });

                // $receiver = new Joiningdetail();
                // $receiver->email = $empemail;
                // $receiver->sender_id = $user->id;
                // $receiver->software_category = Auth::user()->software_category ? Auth::user()->software_category : "onrole";
                // $receiver->save();



            }
        }
        return redirect()->back()->with('msg', 'joining form link has been sent sucessfully!!');
    }

    public function newjoinee()
    {
        if(Auth::user()->type=='admin') {
            $nj= JoiningDetail::where('type', 'offrole')->get();
            $nj_count= JoiningDetail::where('type', 'offrole')->count();
           
            
            $approved_newjoinee= JoiningDetail::where(['type'=>'offrole','is_approved'=>1])->get();
            return view('new_joinee.newjoinee', compact('nj', 'nj_count'));
        } 
        else {
            $uid=Auth::user()->id;
            //
            $nj= JoiningDetail::where('candidate_recruiter_id', $uid)->get();
            $nj_count= JoiningDetail::where('candidate_recruiter_id', $uid)->count();
            $approved_newjoinee= JoiningDetail::where(['candidate_recruiter_id'=> $uid,'is_approved'=>1])->get();

           

            // if(isset($approved_newjoinee)){
            //     return response()->json([
            //                                                                                                                            'data' => $approved_newjoinee,

            //     ]);
            // }
            // else{
            //     return response()->json([
            //         "error"=>'data not found'

            //     ]);
            // }
            // return view('new_joinee.newjoinee', compact(['nj','nj_count','data'=>$approved_newjoinee]));
            return view('new_joinee.newjoinee', compact(['nj','nj_count']));
        }
        //    return $nj;
    }
    public function receiverEmail()
    {
        if(Auth::user()->type=='admin') {
            $nj= JoiningDetail:: where('software_category',Auth::user()->software_category)->get();
            
            $nj_count= $nj->count();
            // $approved_newjoinee= Joiningdetail::where(['type'=>'offrole','is_approved'=>1])->get();
            return view('new_joinee.receiverEmail', compact('nj', 'nj_count'));
        } 
        else {
            $uid=Auth::user()->id;
           
            $nj= JoiningDetail::where(['sender_id'=> $uid , 'software_category'=> Auth::user()->software_category])->get();
         
            $nj_count= JoiningDetail::where(['sender_id'=> $uid , 'software_category'=> Auth::user()->software_category])->count();


          
            return view('new_joinee.receiverEmail', compact(['nj','nj_count']));
        }
        //    return $nj;
    }
    public function newjoineefulldetail(Request $request, $id)
    {
        // return $request;
        $nj= JoiningDetail::where('id', $id)->first();
        // return $nj;
        $client = ClientList::where('client_id',$nj->company)->first();
        // return $client->client_name;
        return view('new_joinee.newjoineefulldetails', compact('nj','client'));
    }

    public function approvedNewjoinee()
       {
        $approved_newjoinee= JoiningDetail::where(['type'=>'offrole','is_approved'=>1])->get();
        if(isset($approved_newjoinee)) {
            return response()->json([
                                                                                                                                   'data' => $approved_newjoinee,

            ]);
        } else {
            return response()->json([
                "error"=>'data not found'

            ]);
        }
    }
    public function candidateapproval($id)
    {
    //    return $id;
        $approval_status=JoiningDetail::find($id);
        if($approval_status->is_approved == 1) {
            $approval_status->is_approved=0;
            $approval_status->save();
        } else {
    $approval_status->is_approved=1;

    $approval_status->save();

    $client = new Client();

    $data = [
        'name' => $approval_status->name,
        'fathername' => $approval_status->fathername,
        'mothername' => $approval_status->mothername,
        'dob' => $approval_status->dob,
        'address' => $approval_status->address,
        'aadharno' => $approval_status->aadharno,
        'gender' => $approval_status->gender,
        'marital_status' => $approval_status->marital_status,
        'spouse' => $approval_status->spouse,
        'emailid' => $approval_status->emailid,
        'mobileno' => $approval_status->mobileno,
        'dateofjoining' => $approval_status->dateofjoining,
        'company' => $approval_status->company,
        'companytype' => $approval_status->companytype,
        'city' => $approval_status->city,
        'statelist' => $approval_status->statelist,
        'country' => $approval_status->country,
        'pincode' => $approval_status->pincode,
        'joblocation' => $approval_status->joblocation,
        'designation' => $approval_status->designation,
        'salary' => $approval_status->salary,
        'type' => $approval_status->type,
        'candidate_recruiter_id' => $approval_status->candidate_recruiter_id,
        'pgname' => $approval_status->pgname,
        'postboard' => $approval_status->postboard,
        'postyear' => $approval_status->postyear,
        'postlocation' => $approval_status->postlocation,
        'ugname' => $approval_status->ugname,
        'ugboard' => $approval_status->ugboard,
        'ugyear' => $approval_status->ugyear,
        'uglocation' => $approval_status->uglocation,
        'twelvname' => $approval_status->twelvname,
        'twelvboard' => $approval_status->twelvboard,
        'twelvyear' => $approval_status->twelvyear,
        'twelvlocation' => $approval_status->twelvlocation,
        'tenthname' => $approval_status->tenthname,
        'tenthboard' => $approval_status->tenthboard,
        'tenthyear' => $approval_status->tenthyear,
        'tenthlocation' => $approval_status->tenthlocation,
        'bankname' => $approval_status->bankname,
        'bankbranch' => $approval_status->bankbranch,
        'bankaccno' => $approval_status->bankaccno,
        'ifsc' => $approval_status->ifsc,
        'pan' => $approval_status->pan,
        'esic' => $approval_status->esic,
        'oldcompname' => $approval_status->oldcompname,
        'olddesignation' => $approval_status->olddesignation,
        'startdate' => $approval_status->startdate,
        'enddate' => $approval_status->enddate,
        'jd' => $approval_status->jd,
        'skill' => $approval_status->skill,
        'aadhar_url' => url($approval_status->aadhar_url),
        'pan_url' => url($approval_status->pan_url),
        'photo' => url($approval_status->photo),

    ];
    // return $data;
  

    $response = $client->post('https://www.whiteforcepayroll.com/admin/new-joinee-details', [
        'form_params' => $data
    ]);

    $statusCode = $response->getStatusCode();
    $content = $response->getBody()->getContents();
    // return $content;

} 

    

        return redirect('newjoinee')->with('msg', 'Status updated successfully!');
    }
}
