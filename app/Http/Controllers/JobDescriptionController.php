<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobDescription;
use Illuminate\Support\Facades\Auth;
class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $job_descriptions=JobDescription::get();
        $serch=$request->serch;
        if(isset($serch)){
            $job_descriptions = JobDescription::where('role','LIKE',"%{$serch}%")->get();

        }
        $currentUser=Auth::user()->name;
        return view('pages.job_descriptions.job_descriptions',compact('job_descriptions','serch','currentUser'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.job_descriptions.create_job_description');
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
            'role' => 'required',
            'MinExperience' => 'required',
            'MaxExperience' => 'required',
            'description' => 'required|min:250'
        ]);

            $job_description=new JobDescription();
            $job_description->role=$request->role;
            $job_description->min_exp=$request->MinExperience;
            $job_description->max_exp=$request->MaxExperience;
            $job_description->description=$request->description;
            // $job_description->software_category=Auth::user()->software_category??'onrole';
            $job_description->save();
            return redirect('job_description');
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
        $job_description=JobDescription::where('id',$id)->first();
        $selectedMinExperience = $job_description->min_exp;
        $selectedMaxExperience = $job_description->max_exp;
      return view('pages.job_descriptions.edit_job_description',compact('job_description','selectedMinExperience','selectedMaxExperience'));
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
            'role' => 'required',
            'MinExperience' => 'required',
            'MaxExperience' => 'required',
            'description' => 'required|min:250'
        ]);
            $job_description=JobDescription::where('id',$id)->first();
            $job_description->role=$request->role;
            $job_description->min_exp=$request->MinExperience;
            $job_description->max_exp=$request->MaxExperience;
            $job_description->description=$request->description;
            $job_description->software_category=Auth::user()->software_category??'onrole';
            $job_description->save();
            return redirect('job_description');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job_description=JobDescription::where('id',$id)->first();
        $job_description->delete();
        return redirect('job_description');
    }
}