<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Client;
use App\Models\Industry;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Cities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientAllotment;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $showClient = true;
        if(in_array(Auth::user()->software_category, FRANCHISE_CATEGORY())){
            if(in_array(Auth::user()->role,['manager', 'assistant_manager', 'talent_acquisition'])){
                $showClient = false;
            }
        }
        if($showClient){
        }else{
            return redirect('dashboard')->with('error', 'Not Authorized');
        }



        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        if (in_array(Auth::user()->role, ['manager', 'assistant_manager', 'talent_acquisition'])) {
            $getupperHierarchy = User::where('software_category', Auth::user()->software_category)->whereIn('role', ['business_head', 'general_manager'])->pluck('id')->toArray();
            array_push($getupperHierarchy, 1);
            $parentids = array_diff($currentUser->ascendantIds(), $getupperHierarchy);
            $childUsers = array_merge($childUsers, $parentids);
        }
        array_unshift($childUsers, $currentUser->id);
        $users = User::whereIn('id', $childUsers)->get();

        if (!empty($request->user)) {
            $allotted_clients = ClientAllotment::where('alloted_to', $request->user)->pluck('client_id')->toArray();
            $childUsers = [$request->user];
        } else {
            $allotted_clients = ClientAllotment::whereIn('alloted_to', $childUsers)->pluck('client_id')->toArray();
        }

        $clients = Client::where(function ($query) use ($childUsers, $allotted_clients) {
            $query->whereIn('created_by', $childUsers)
                ->orWhereIn('id', $allotted_clients);
        });

        $serch = $request->serch;
        if (!empty($serch)) {
            $clients = $clients->where('name', 'like', '%' . $serch . '%');
        }

        $clients = $clients->where('is_active', 1)->orderBy("id", "desc")->where('software_category', Auth::user()->software_category)->with(['owner', 'hrs', 'position'])->paginate(30);
        $selectedUser = $request->user ?? '';
        $currentUser = Auth::user()->role;
        $manager_and_sm_list = getManagerAndSmList();
        // return $clients;
        return view('client.list', compact('clients', 'users', 'selectedUser', 'currentUser', 'serch','childUsers','manager_and_sm_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $showClient = true;
        if(in_array(Auth::user()->software_category, FRANCHISE_CATEGORY())){
            if(in_array(Auth::user()->role,['manager', 'assistant_manager', 'talent_acquisition'])){
                $showClient = false;
            }
        }
        if($showClient){
        }else{
            return redirect('dashboard')->with('error', 'Not Authorized');
        }

        $industries = Industry::get();
        $countries = Country::get();
        return view('client.create', compact('industries', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'company_name' => 'required',
            'company_website' => 'required',
            'type' => 'required',
            'imageBaseString' => 'required',
            'percent' => 'required',
            // 'aggrement' => 'required',
            'about_company' => 'required',
            'countries' => 'required',
            'states' => 'required',
            'city' => 'required',
        ]);
        $client = new Client();
        $client->name = $request->company_name;
        $client->website = $request->company_website;
        $client->email = $request->email;
        $client->created_by = Auth::user()->id;
        $client->percentage = $request->percent;
        $client->type = $request->type;
        //****image cropper path will create using this function ****/

        $image_code = $request->imageBaseString;
        if (!empty($image_code)) {
            $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$image_code);
            $filepath = time() . '_' . rand() . '.png';
            Storage::disk('s3')->put('company/images/' . $filepath, base64_decode($image_code), 'public');
            $client->image = $filepath;
        }

        $aggrement = $request->file('aggrement');
        if (!empty($aggrement)) {
            $filepath = time() . '_' . rand() . '.pdf';
            Storage::disk('s3')->put('company/agreements/' . $filepath, file_get_contents($aggrement), 'public');
            $client->aggrement = $filepath;
        }
        //--------------------------------------//
        $client->alloted_date = $request->alloted_date;
        $client->about = $request->about_company;
        $client->is_local = $request->is_local;
        $country = Country::where('id', $request->countries)->first();
        $client->country = $country->name;
        $state = State::where('id', $request->states)->first();
        $client->state = $state->name;
        $city = Cities::where('id', $request->city)->first();
        $client->location = $city->name;
        $client->sub_type = $request->sub_type;
        $client->software_category = Auth::user()->software_category ? Auth::user()->software_category : 'onrole';
        $client->save();
        return redirect('client')->with('success', 'Client details saved successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showClient = true;
        if(in_array(Auth::user()->software_category, FRANCHISE_CATEGORY())){
            if(in_array(Auth::user()->role,['manager', 'assistant_manager', 'talent_acquisition'])){
                $showClient = false;
            }
        }
        if($showClient){
        }else{
            return redirect('dashboard')->with('error', 'Not Authorized');
        }

        $client = Client::with(['countryName', 'stateName', 'cityName'])->where('id', $id)->first();
        if (!empty($client->aggrement)) {
            $disk = Storage::disk('s3');
            $client->aggrement = $disk->temporaryUrl('company/agreements/' . $client->aggrement, now()->addMinutes(5));
        }
        if (!empty($client->image)) {
            $disk = Storage::disk('s3');
            $client->image = $disk->temporaryUrl('company/images/' . $client->image, now()->addMinutes(5));
        }
        $industries = Industry::get();
        $countries = Country::get();
        $countryId = Country::where('name', $client->country)->first();
        $countryId = $countryId->id ?? '';
        $stateId = State::where('name', $client->state)->first();
        $stateId = $stateId->id ?? '';
        $cityId = Cities::where('name', $client->location)->first();
        $cityId = $cityId->id ?? '';

        return view('client.client_edit', compact('client', 'industries', 'countries', 'countryId', 'stateId', 'cityId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'email' => 'required',
            'company_name' => 'required',
            'company_website' => 'required',
            'type' => 'required',
            'percent' => 'required',
            'about_company' => 'required',
            'countries' => 'required',
            'states' => 'required',
            'city' => 'required',

        ]);
        $client = Client::where('id', $id)->first();
        $client->name = $request->company_name;
        $client->website = $request->company_website;
        $client->email = $request->email;
        $client->percentage = $request->percent;
        $client->type = $request->type;
        $client->alloted_to = $request->alloted_at;
        $client->alloted_by = $request->alloted_by;

        if ($request->imageBaseString) {
            $image_code = $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$request->imageBaseString);
            // $basePath = "client_images/";
            // $fileName = uploadImageWithBase64($image_code, $basePath);
            // $image_path = $basePath . $fileName;
            // $client->image = $image_path;

            $oldImgPath = $client->image;

            if ($image_code) {
                $filepath = time() . '_' . rand() . '.png';
                Storage::disk('s3')->put('company/images/' . $filepath, base64_decode($image_code), 'public');
                $client->image = $filepath;
                if ($oldImgPath) {
                    $deleted = Storage::disk('s3')->delete($oldImgPath);
                    if ($deleted) {

                        echo 'Old file deleted successfully.';
                    } else {

                        echo 'Failed to delete the old image file.';
                    }
                }
            }
        } else {
            $client->image = $client->image;
        }
        if ($request->aggrement) {

            $oldPath = $request->aggrement;

            if ($request->hasFile('aggrement')) {
                $uploadedFile = $request->file('aggrement');

                if ($uploadedFile) {
                    $filepath = time() . '_' . rand() . '.pdf';
                    Storage::disk('s3')->put('company/agreements/' . $filepath, file_get_contents($uploadedFile), 'public');
                    $client->aggrement = $filepath;

                    if ($oldPath) {
                        $deleted = Storage::disk('s3')->delete($oldPath);

                        if ($deleted) {

                            echo 'Old file deleted successfully.';
                        } else {

                            echo 'Failed to delete the old aggrement file.';
                        }
                    }
                }
            }
            //--------------------------------------//
        }
        $client->alloted_date = $request->alloted_date;
        $client->about = $request->about_company;
        $client->is_local = $request->is_local;
        $country = Country::where('id', $request->countries)->first();
        $client->country = $country->name;
        $state = State::where('id', $request->states)->first();
        $client->state = $state->name;
        $city = Cities::where('id', $request->city)->first();
        $client->location = $city->name;
        $client->sub_type = $request->sub_type;
        $client->software_category = Auth::user()->software_category ? Auth::user()->software_category : "onrole";
        $client->save();
        return redirect('client')->with('success', 'Client Updated Successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $showClient = true;
        if(in_array(Auth::user()->software_category, FRANCHISE_CATEGORY())){
            if(in_array(Auth::user()->role,['manager', 'assistant_manager', 'talent_acquisition'])){
                $showClient = false;
            }
        }
        if($showClient){
        }else{
            return redirect('dashboard')->with('error', 'Not Authorized');
        }
        
        $client = Client::where('id', $id)->first();
        $client->is_active = 0;
        $client->save();
        return redirect('client')->with('success', 'Client deleted successfully..');;
    }

    public function saveClientData()
    {
        $clientjson = file_get_contents("https://white-force.com/offrole/api/all-client");
        $clients = json_decode($clientjson, true);
        //dd($clients);
        foreach ($clients['data'] as $client) {

            try {
                $newClient = new Client();
                $newClient->bd_id = $client['bd_id'];
                $newClient->is_added_by_bd = ($client['company_add'] == 'BD') ? 1 : 0;
                $newClient->name = $client['clientName'];
                $newClient->website = $client['website'];
                $newClient->email = $client['email'];
                $newClient->is_active = $client['is_active'];
                $newClient->percentage = $client['percentage'];
                $newClient->type = $client['type'];
                $newClient->alloted_by = $client['alloted_by'];
                $newClient->alloted_date = $client['allote_date'];
                $newClient->about = $client['aboutClient'];
                $newClient->is_local = 1;
                $newClient->location = $client['address_address'];
                $newClient->sub_type = ($client['company_sub_type'] == 'Temp' ? 'temp' : ($client['company_sub_type'] == 'One Time' ? 'one-time' : 'IT'));
                $newClient->software_category = 'offrole';
                $newClient->created_at = $client['created_at'];
                $newClient->updated_at = $client['updated_at'];

                if (!empty($client['clientImage'])) {
                    $filenamearr = explode('/', $client['clientImage']);
                    $extarr = !empty($filenamearr[1]) ? explode('.', $filenamearr[1]) : [];
                    $ext = (!empty($extarr) && !empty($extarr[count($extarr) - 1])) ? $extarr[count($extarr) - 1] : 'png';
                    $filepath = time() . '_' . rand() . '.' . $ext;
                    Storage::disk('s3')->put('company/images/' . $filepath, file_get_contents('https://white-force.com/offrole/' . $client['clientImage']), 'public');
                    $newClient->image = $filepath;
                }

                if (!empty($client['aggrement'])) {
                    $filepath = time() . '_' . rand() . '.pdf';
                    Storage::disk('s3')->put('company/agreements/' . $filepath, file_get_contents('https://white-force.com/offrole/' . $client['aggrement']), 'public');
                    $newClient->aggrement = $filepath;
                }

                if (!empty($client['created_by'])) {
                    $createdByEmail = offroleUser($client['created_by']);
                    $created_by = User::where('email', $createdByEmail)->select('id', 'software_category')->first();
                    $newClient->created_by = $created_by->id ?? 1;
                }

                if (!empty($client['alloted_at'])) {
                    $allotedToEmail = offroleUser($client['alloted_at']);
                    $alloted_to = User::where('email', $allotedToEmail)->select('id', 'software_category')->first();
                    $newClient->alloted_to = $alloted_to->id ?? 1;
                }

                $newClient->save();

                if (!empty($client['client_allotment'])) {
                    foreach ($client['client_allotment'] as $clientallot) {
                        $allotment = new ClientAllotment();
                        $allotment->client_id = $newClient['id'];
                        $allotment->alloted_by = $clientallot['alloted_by'];

                        $allotedEmail = onroleUser($clientallot['alloted_to']);
                        $allotedTo = User::where('email', $allotedEmail)->select('id', 'software_category')->first();
                        $allotment->alloted_to = $allotedTo->id ?? 1;
                        $allotment->software_category = 'offrole';

                        $allotment->created_at = $clientallot['created_at'];
                        $allotment->updated_at = $clientallot['updated_at'];
                        $allotment->save();
                    }
                }
            } catch (\Exception $e) {
                // dd($e->getMessage());
            }
        }
    }

    public function allotOldClients(Request $request){
        $client = Client::find($request->client_id);
        if(!empty($client->alloted_to)){
            $client->alloted_to = $request->allot_user;
        }  
        $client_allotted = ClientAllotment::where('client_id',$request->client_id)->delete();
        $new_client_allot = new ClientAllotment();
        $new_client_allot->client_id = $request->client_id;
        $new_client_allot->alloted_by = $client->alloted_by;
        $new_client_allot->alloted_to = $request->allot_user;
        $new_client_allot->software_category = $client->software_category;
        $new_client_allot->save();
        return back();

    }
}
