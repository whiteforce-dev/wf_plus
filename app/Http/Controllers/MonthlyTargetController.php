<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTarget;
use App\Models\Target;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyTargetController extends Controller
{

    function target(Request $request){
        $users = User::where(['role' => 'senior_manager', 'software_category'=> Auth::user()->software_category ??'onrole'])->where('is_active', 1)->get();

        return view('pages.monthly_target.userTarget', compact('users'));
    }
    function teamTarget($manager, Request $request){
        $managerId = $manager;
        $team = User::with('descendants', 'targets')->find($manager);
        $month = $request->month ?? date('m');

    
        $buttonShowStatus = true;
        return view('pages.monthly_target.managerTeamTarget', compact('team', 'buttonShowStatus', 'month', 'managerId'));
    }

    function saveUserTarget(Request $request){
        // return $request;
        $team_member = array_keys($request->all());
        $month = date('m');
        foreach ($team_member as $team) {
            $teamid = (explode("_", $team)[1]);

            if (is_numeric($teamid)) {
                $check = MonthlyTarget::where(['user_id' => $teamid, 'month' => $month])->first();
                if($check){
                    $target_one = MonthlyTarget::find($check->id);
                }else{
                    $target_one = new MonthlyTarget();
                }
                $target_one->user_id = $teamid;
                $target_one->target = $request['target_' . $teamid];
                $target_one->month = $month;
                $target_one->quarter = ceil(date('n', time()) / 3);
                $target_one->year = date('Y');
                $target_one->software_category = Auth::user()->software_category;
                $target_one->save();
            }
        }
        return back()->with('success','Target saved successfully..');
    }
}
