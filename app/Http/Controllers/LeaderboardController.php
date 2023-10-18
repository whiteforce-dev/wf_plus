<?php

namespace App\Http\Controllers;

use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    function leaderBoard()
    {

        $descendantIds = Auth::user()->descendantIds();
        $all_users_id = User::whereIn('id', $descendantIds)->whereNotIn('role', ['admin', 'business_head', 'general_manager'])->orderBy('id', 'asc')->pluck('id')->toArray();

        $curQuarter = ceil(date('n', time()) / 3);




        $leaderBoard = Pipeline::select('created_by', DB::raw('sum(offerd_ctc) as total'), DB::raw('count(id) as count'))
            ->where('join_quarter', $curQuarter)
            ->whereIn('created_by', $all_users_id)
            ->where('stage', '=', 'joined')
            ->groupBy('created_by')
            ->orderByDesc('total')
            ->get();




        $data = [];
        foreach ($all_users_id as $key => $user) {
            $data[] = [
                'user_id' => $user,
                'total' => $leaderBoard->where('created_by', $user)->first()->total ?? 0,
                'candidates' => $leaderBoard->where('created_by', $user)->first()->count ?? 0,
            ];
        }

        $quarters = collect($data);
        $numbers = $quarters->sortByDesc('total')->values()->all();


        return view('reports.leaderboard', compact('numbers'));
    }
}
