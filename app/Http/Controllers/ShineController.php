<?php

namespace App\Http\Controllers;

use App\Shine;
use App\Models\ShineCity;
use App\Models\ShineDegreeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ShineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->type == "admin") {

            $jobs = DB::table('shines')
            ->join('master_jobs','master_jobs.id',"=","shines.job_id")
           ->join('cities','cities.city_id',"=","master_jobs.city_id")
            ->orderBy('job_id', 'desc')
            ->paginate(15);

                 return view('backend.shine.index')->with(compact('jobs'));


        } else {
            $login_id = Auth::user()->id;
            $login_email = Auth::user()->email;
            $login_type = Auth::user()->type;

            $jobs = DB::table('shines')
            ->join('master_jobs','master_jobs.id',"=","shines.job_id")
           ->join('cities','cities.city_id',"=","master_jobs.city_id")
           ->where(['master_jobs.login_id' => $login_id, 'master_jobs.login_email' => $login_email, 'master_jobs.login_type' => $login_type])
            ->orderBy('job_id', 'desc')
            ->paginate(15);

                 return view('backend.shine.index')->with(compact('jobs'));
        }

    }

    public function getShineCity()
    {
        $shine_cities = ShineCity::where('city_grouping_id', request('shine_cities_groups_id'))->orderBy('city_desc')->get();

        return view('backend.ajax_forms.shine_cities', compact('shine_cities'));
    }

    public function getShineEducationStream()
    {
        // dd($_REQUEST);
        $shine_studies = ShineDegreeLevel::where('study_field_grouping_id', request('shine_study_field_grouping_id'))->orderBy('study_desc')->cursor();
        // dd($shine_cities);

        return view('backend.ajax_forms.shine_studies', compact('shine_studies'));
    }

}