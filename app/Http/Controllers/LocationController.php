<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\Cities;



class LocationController extends Controller
{
    function addCountry(Request $request)
    {
        $search = $request['search'] ?? " ";
        if ($search != " ") {
            $countries = Country::where('name', 'Like', "%$search%")->paginate(9);
        } else {
            $countries = Country::with('states.cities')->paginate(9);
        }
        return view('Locations.AddCountry', compact('countries'));
    }


    public function storeCountry(Request $request)
    {

        $request->validate([
            'country_name' => 'required|unique:countries,name',
        ]);

        $country = new Country();
        $country->name = $request->country_name;
        $country->save();

        $country->phonecode = $country->id;

        $sortName = substr($country->name, 0, 3);
        $country->shortname = strtoupper($sortName);


        $country->save();

        return redirect('addCountry');
    }

    function deleteCountry($id)
    {

        $country = Country::with('states.cities')->find($id);

        if ($country) {
            // Delete the associated cities
            $country->states->each(function ($state) {
                $state->cities()->delete();
            });

            // Delete the associated states
            $country->states()->delete();

            // Delete the country
            $country->delete();
        }
        return back();
    }

    function EditCountry($id)
    {

        $Country = Country::where('id', $id)->first();
        return view('Locations.EditCountry', compact('Country'));
    }

    function UpdateCountry(Request $request, $id)
    {

        $request->validate([
            'country_name' => 'required|unique:countries,name',
        ]);

        $country = Country::where('id', $id)->first();
        $country->name = $request->country_name;
        $country->save();

        $country->phonecode = $country->id;

        $sortName = substr($country->name, 0, 3);
        $country->shortname = strtoupper($sortName);


        $country->save();
        return redirect('addCountry');
    }

    function AddState(Request $request)
    {
        $search = $request['search'] ?? " ";
        if ($search != " ") {
            $State = State::where('name', 'Like', "%$search%")->paginate(9);
        } else {
            $State = State::with('cities')->paginate(9);
        }

        return view('Locations.AddState', compact('State'));
    }

    public function storeState(Request $request)
    {
        $request->validate([
            'state_name' => 'required|unique:states,name',
        ]);

        $State = new State();
        $State->name = $request->state_name;
        $State->country_id = $request->country_id;
        $State->save();

        return redirect('addState');
    }

    public function getState($id)
    {
        $State = State::where('country_id', $id)->get();
        return response()->json($State);
    }

    public function getStateList(Request $request)
    {
        $Country = $request->country_id;
        $State = State::where('country_id', $Country)->get();
        echo '<option value"">Select State</option>';
        foreach ($State as $State) {
            echo '<option value="' . $State->id . '">' . $State->name . '</option>';
        }
    }

    function EditState($id)
    {

        $State = State::where('id', $id)->first();
        $selected_state_id = $State->country_id;
        return view('Locations.EditState', compact('State', 'selected_state_id'));
    }


    function UpdateState(Request $request, $id)
    {
        $request->validate([
            'state_name' => 'required|unique:states,name',
        ]);

        $State = State::where('id', $id)->first();
        $State->name = $request->state_name;
        $State->save();
        return redirect('addState');
    }

    function deleteState($id)
    {

        $state = State::with('cities')->find($id);

        if ($state) {
            // Delete the associated cities
            $state->cities()->delete();

            // Delete the state
            $state->delete();

            return redirect()->back()->with('success', 'State deleted successfully.');
        }

        return back();
    }


    function AddCity(Request $request)
    {
        $search = $request['search'] ?? " ";
        if ($search != " ") {
            $City = Cities::where('name', 'Like', "%$search%")->paginate(9);
        } else {
            $City = Cities::paginate(9);
        }

        return view('Locations.AddCity', compact('City'));
    }


    public function storeCity(Request $request)
    {

        $request->validate([
            'city_name' => 'required|unique:cities,name',
            'state_id' => 'required',

        ]);

        $City = new Cities();
        $City->name = $request->city_name;
        $City->state_id = $request->state_id;

        $City->save();

        return back();
    }

    function EditCity($id)
    {
        $City = Cities::where('id', $id)->first();
        return view('Locations.EditCity', compact('City'));
    }

    function UpdateCity(Request $request, $id)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,name',

        ]);

        $City = Cities::where('id', $id)->first();
        $City->name = $request->city_name;

        $City->save();
        return redirect('addCity');
    }

    function deleteCity($id)
    {
        $City = Cities::where('id', $id)->delete();
        return back();
    }



    //Get State List
    function stateList($country){
        $country = Country::findOrFail($country);
        $states = $country->states()->pluck('name', 'id');
        return response()->json($states);
    }

    //Get City List
    function cityList($state){
        $state = State::findOrFail($state);
        $cities = $state->cities()->pluck('name', 'id');
        return response()->json($cities);
    }
}
