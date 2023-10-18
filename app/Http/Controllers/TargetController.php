<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    public function userTarget()
    {
        $users = User::where(['role' => 'senior_manager', 'software_category'=> Auth::user()->software_category ??'onrole'])->where('is_active', 1)->get();

        return view('pages.target.userTarget', compact('users'));
    }
    public function managerTeamTarget($manager)
    {

        $manager = User::with('descendants', 'targets')->find($manager);
        $team = $manager;

        $lastInsertedRecord = Target::where('user_id', $manager->id)->orderBy('id', 'desc')->first();
        $buttonShowStatus = true;
        if (isset($lastInsertedRecord)) {
            $lastInsertedMonth = Carbon::parse($lastInsertedRecord->created_at)->format('F');
            $currentMonth = date('F');

            if ($currentMonth == $lastInsertedMonth) {
                $buttonShowStatus = false;
            } else {
                $buttonShowStatus = true;
            }
        }
        return view('pages.target.managerTeamTarget', compact('team', 'buttonShowStatus'));
    }
    public function managerTeamTargetEdit($manager)
    {
        $manager = User::with('descendants', 'targets')->find($manager);
        $team = $manager;

        $lastInsertedRecord = Target::where('user_id', $manager->id)->orderBy('id', 'desc')->first();

        // return $lastInsertedRecord;


        $buttonShowStatus = true;
        if (isset($lastInsertedRecord)) {
            $lastInsertedMonth = Carbon::parse($lastInsertedRecord->created_at)->format('F');
            $currentMonth = date('F');

            if ($currentMonth == $lastInsertedMonth) {
                $buttonShowStatus = false;
            } else {
                $buttonShowStatus = true;
            }
        }
        return view('pages.target.managerTeamTargetEdit', compact('team', 'buttonShowStatus', 'lastInsertedRecord'));
    }
    public function saveUserTarget(Request $request)
    {

        $team_member = array_keys($request->all());

        foreach ($team_member as $team) {
            $teamid = (explode("_", $team)[1]);

            if (is_numeric($teamid)) {


                $lastRemainingRecord = Target::where('user_id', $teamid)->orderBy('id', 'desc')->first();
                $remaining = isset($lastRemainingRecord) ? $lastRemainingRecord->remaining : 0;
                $target_one = new Target();
                $target_one->user_id = $teamid;
                $target_one->month_target = $request['target_' . $teamid];
                $target_one->target = $request['target_' . $teamid] + $remaining;
                $target_one->complete = 0;
                $target_one->remaining = $target_one->target;
                $target_one->save();

            }
        }
        return back()->with('success','Target saved successfully..');
    }
    public function updateUserTarget(Request $request)
    {

        $team_member = array_keys($request->all());
        foreach ($team_member as $team) {
            $teamid = (explode("_", $team)[1]);

            if (is_numeric($teamid)) {
                // Get Last Record
                $lastRemainingRecord = Target::where('user_id', $teamid)->orderBy('id', 'desc')->first();
                if($lastRemainingRecord) {
                    $completeFormLast = $lastRemainingRecord->complete ?? 0;
                    $lastRemainingRecord->delete();
                    // Get Last Record
                    $lastRemainingRecord = Target::where('user_id', $teamid)->orderBy('id', 'desc')->first();
                    $remaining = isset($lastRemainingRecord) ? $lastRemainingRecord->remaining : 0;
                    $target_one = new Target();
                    $target_one->user_id = $teamid;
                    $target_one->month_target = $request['target_' . $teamid];
                    $target_one->target = $request['target_' . $teamid] + $remaining;
                    $target_one->complete = $completeFormLast ?? 0;
                    $target_one->remaining = $target_one->target- $target_one->complete;
                    $target_one->save();
                }else{
                    $target_one = new Target();
                    $target_one->user_id = $teamid;
                    $target_one->month_target = $request['target_' . $teamid];
                    $target_one->target = $request['target_' . $teamid];
                    $target_one->complete = $completeFormLast ?? 0;
                    $target_one->remaining = $target_one->target;
                    $target_one->save();
                }
            }
        }
         return back()->with('success', 'Target Updated Successfully..');
    }
}
