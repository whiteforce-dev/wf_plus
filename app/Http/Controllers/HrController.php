<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hr;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientAllotment;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $currentUser=Auth::user()->id;
        // $currentUser = User::find($currentUser);
        // $childUsers = $currentUser->descendantIds();
        // array_unshift($childUsers,$currentUser->id);
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        if (in_array(Auth::user()->role, ['manager', 'assistant_manager', 'talent_acquisition'])) {
            $getupperHierarchy = User::where('software_category', Auth::user()->software_category)->whereIn('role', ['business_head', 'general_manager'])->pluck('id')->toArray();
            array_push($getupperHierarchy, 1);
            $parentids = array_diff($currentUser->ascendantIds(), $getupperHierarchy);
            $childUsers = array_merge($childUsers, $parentids);
        }
        array_unshift($childUsers, $currentUser->id);
        // $users = User::whereIn('id', $childUsers)->get();

        $allotted_clients = ClientAllotment::whereIn('alloted_to', $childUsers)->pluck('client_id')->toArray();

        $clients = Client::where(function ($query) use ($childUsers, $allotted_clients) {
            $query->whereIn('created_by', $childUsers)
                ->orWhereIn('id', $allotted_clients);
        })->pluck('id')->toArray();
        // return $clients; 
        if ($request->client) {

            $list = Hr::with('clientName')->where('client_id', $request->client)->get();
            return view('client.hr_list', compact('list'));
        }
        $list = Hr::with('clientName')->where('is_active',1)->whereIn('client_id',$clients)->get();


        return view('client.hr_list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::where('is_active', 1)->get();
        return view('client.hr_create', compact('clients'));
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
            'client_name' => 'required',
            'hr_name' => 'required',
            'hr_email' => 'required',
            'birthday' => 'required',
            'hr_mobile' => 'required',
            'hr_location' => 'required',
            'hr_designation' => 'required',
        ]);
        $hr = new Hr();
        $hr->client_id = $request->client_name;
        $hr->name = $request->hr_name;
        $hr->email = $request->hr_email;
        $hr->dob = $request->birthday;
        $hr->mobile = $request->hr_mobile;
        $hr->location = $request->hr_location;
        $hr->designation = $request->hr_designation;
        $hr->software_category = Auth::user()->software_category;
        $hr->save();
        return redirect('hr');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $hr=Hr::where('id',$id)->first();
        $hr = Hr::with('clientName')->where('id', $id)->first();
        $clients = Client::get();
        return view('client.hr_edit', compact('hr', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
    }

    //this function for update hr if someone edit hr //
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name' => 'required',
            'hr_name' => 'required',
            'hr_email' => 'required',
            'birthday' => 'required',
            'hr_mobile' => 'required',
            'hr_location' => 'required',
            'hr_designation' => 'required',
        ]);
        $hr = Hr::where('id', $id)->first();
        $hr->client_id = $request->client_name;
        $hr->name = $request->hr_name;
        $hr->email = $request->hr_email;
        $hr->dob = $request->birthday;
        $hr->mobile = $request->hr_mobile;
        $hr->location = $request->hr_location;
        $hr->designation = $request->hr_designation;
        $hr->software_category = Auth::user()->software_category;
        $hr->save();
        return redirect('hr');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hr = Hr::where('id', $id)->first();
        $hr->is_active = 0;
        $hr->save();
        return redirect('hr');
    }
}
