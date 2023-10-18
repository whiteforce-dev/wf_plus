<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;

class JobSubmissionController extends Controller
{
    public function submitJob(Request $request)
    {
        $Position = new Position();
        $Position->client_id = request('client_id');
        $Position->jd_json = request('jd_json');
        $Position->position_Name = request('position_name');
        $Position->openings = request('openings');
        $Position->job_description = request('job_description');
        $Position->management_fee = request('management_fee');
        $Position->flat_amount = request('flat_amount');
        $Position->min_year_exp = request('min_year_exp');
        $Position->max_year_exp = request('max_year_exp');
        $Position->specification = request('specification');
        $Position->salary_type = request('salary_type');
        $Position->pay_type = request('pay_type');
        $Position->min_salary = request('min_salary');
        $Position->max_salary = request('max_salary');

        $Position->job_type = request('job_type');
        $Position->industry = request('industry');


        $Position->gender = request('gender');
        $Position->is_remote_work = request('is_remote_work') ?? 0;

        $countries = Country::where('id', request('countries'))->value('name');
        $states = State::where('id', request('states'))->value('name');
        $city = Cities::where('id', request('city'))->value('name');

        $Position->countries = $countries ?? 'Update country';
        $Position->states = $states ?? 'Update State';
        $Position->city = $city ?? 'Update City';

        $Position->locations = $city ?? 'Update Location';
        $Position->job_address = $city ?? 'Update Address';

        $Position->postal_code = request('postal_code');
        $skills = implode(',', $request->skill_set ?? 'No Skills Found');
        $Position->skill_set = $skills;
        $Position->edu_qualification = request('edu_qualification');
        $Position->close_Date = Carbon::parse(request('close_date'))->format('Y-m-d');
        $Position->contact_person_name = Auth::user()->name ?? '-';
        $Position->person_email = Auth::user()->email ?? '-';
        $Position->person_contact = Auth::user()->contact ?? '-';
        $Position->software_category = Auth::user()->software_category ?? 'onrole';
        $Position->created_by = Auth::user()->id;
        $Position->save();

        $Position->clientname = $Position->findClientGet->name ?? '-';
        $Position->save();

        return response()->json(['message' => 'Job submission received successfully'], 201);
    }
}
