<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Designation;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $parentId = Auth::user()->id;
        $user = User::find($parentId);
        return view('pages.user_section.list', compact('user'));
    }

    function renderDescendants(User $node)
    {
        $html = '<li>' . $node->name;
        if ($node->descendants->isNotEmpty()) {
            $html .= '<ul>';
            foreach ($node->descendants as $descendant) {
                $html .= $this->renderDescendants($descendant);
            }
            $html .= '</ul>';
        }
        $html .= '</li>';
        return $html;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('software_category', Auth::user()->software_category)->get();
        return view('pages.user_section.create', compact('users'));
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
            'name' => 'required|max:100',
            'email' => 'required|unique:users',
            'password' => 'required',
            'software_category' => 'required',
            'role' => 'required',
            'parent_id' => 'required',
            'contact' => 'required',
            'is_dummy' => 'required',
        ]);
        
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $basePath = "user-image/";
        $user->profile_image = $basePath . uploadImageWithBase64($request->imageBaseString, $basePath);
        $user->save();
        return back()->with('success', 'User Added Successfully..');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return $user;
        $users = User::where('software_category', Auth::user()->software_category)->get();
        return view('pages.user_section.edit', compact('user', 'users'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        // return $request->all();
        $user = User::find($user);
        if (!$request->profile) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->software_category = $request->software_category;
            $user->contact = $request->contact;
            $user->is_dummy =$request->is_dummy;
            if ($user->role == 'admin') {
                $user->parent_id = '';
                $user->role = 'admin';
            } else {
                $user->parent_id = $request->parent_id;
                $user->role = $request->role;
            }
            $user->is_active = 1;
        }
        if($request->imageBaseString){
            $basePath = "user-image/";
            $user->profile_image = $basePath . uploadImageWithBase64($request->imageBaseString, $basePath);
        }
        $user->save();
        if (!$request->profile) {
            return redirect('user')->with('success', 'User details updated successfully..');
        } else {
            return redirect('dashboard')->with('success', 'User details updated successfully..');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function leftResion(User $id)
    {

        $ckech_role = User::where('id', $id->id)->value('role');
        if ('admin' == $ckech_role || 'business_head' == $ckech_role) {
            return redirect('user');
        } else

            $userData = $id;
        $userData->is_active = 0;
        $userData->update();
        return back()->with('status', 'User Resined Successfully');
    }



    public function getParentUser(Request $request)
    {
        $role = $request->role;
        $software_category = $request->software_category;
        if ($role == 'business_head') {
            $parent = 'admin';
            $user = User::first();
            $data = "";
            $data .= "<option value=" . $user->id . ">" . ucwords($user->name) . "</option>";
            return $data;
        }
        if ($role == 'general_manager') {
            $parent = 'business_head';
        }
        if ($role == 'senior_manager') {
            $parent = 'general_manager';
        }
        if ($role == 'manager') {
            $parent = 'senior_manager';
        }
        if ($role == 'assistant_manager') {
            $parent = 'manager';
        }
        if ($role == 'talent_acquisition') {
            $parent = 'assistant_manager';
        }
        $users = User::where(['role' => $parent, 'software_category' => $software_category])->get();
        $data = "";
        foreach ($users as $user) {
            $data .= "<option value=" . $user->id . ">" . ucwords($user->name) . "</option>";
        }
        return $data;
    }

    public function editProfile()
    {
        $user = Auth::user();
        $users = User::where('software_category', Auth::user()->software_category)->get();
        $isProfileEdit = 1;
        return view('pages.user_section.edit', compact('user', 'users', 'isProfileEdit'));
    }
}
