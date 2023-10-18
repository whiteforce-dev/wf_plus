<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Client;
use App\Models\Event;
use App\Models\Pipeline;
use App\Models\Position;
use App\Models\Target;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ClientAllotment;
use App\Models\MonthlyTarget;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        if (Cache::has('dashboard_view_cache_'.Auth::user()->id)) {
            return Cache::get('dashboard_view_cache_'.Auth::user()->id);
        }

        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentMonth = $date->format('F');
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(90);
        $pastDate = $pastDate->format('Y-m-d');

        $currentUser = User::find($currentUser);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);

        $candidates = 0;
        $positions = 0;
        $clients = 0;
        $openPositionCurrentMonth = 0;
        $closePositionCurrentMonth = 0;
        $candidateApproachCurrentMonth = 0;
        $candidateOfferedCtcCurrentMonth = 0;
        $candidateJoinedAchivedCurrentMonth = 0;
        $totalPosition = 0;
        $totalOffered = 0;
        $totalInterview = 0;
        $totalCompany = 0;
        $hotCompany = 0;
        $coldCompany = 0;
        $deadCompany = 0;



        $monthlyTarget = Target::whereIn('user_id', $childUsers)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->get();
        $monthlyJoinTarget = (int) $monthlyTarget->sum('month_target');
        $monthlyJoinAchived = (int) $monthlyTarget->sum('complete');
        $monthlyJoinPending = (int) $monthlyTarget->sum('remaining');


        $upcoming_interview = [];
        $offered_candidate = [];

        // Events
        $events = Event::whereDate('date', '=', date('Y-m-d'))->get();

        // Quarter Amount
        $joinedSum = [];


        date_default_timezone_set('Asia/Kolkata'); // Set the timezone to India (Asia/Kolkata)

        $currentHour = date('G');
        if ($currentHour >= 0 && $currentHour <= 12
        ) {
            $greeting = 'Good morning!!';
        } elseif ($currentHour >= 12 && $currentHour < 16) {
            $greeting = 'Good Afternoon!!';
        } elseif ($currentHour >= 16 && $currentHour < 19) {
            $greeting = 'Good evening!!';
        } elseif ($currentHour >= 19 && $currentHour < 24){
            $greeting = 'Good night! - Tata Bye-Bye';
        }




        // If not cached, render the view and cache it
        $view = view('pages.dashboard', compact('candidates', 'positions', 'clients', 'openPositionCurrentMonth', 'closePositionCurrentMonth', 'candidateApproachCurrentMonth', 'candidateOfferedCtcCurrentMonth', 'candidateJoinedAchivedCurrentMonth', 'currentMonth', 'currentUser', 'currentDate', 'pastDate', 'monthlyJoinTarget', 'monthlyJoinAchived', 'monthlyJoinPending', 'users', 'totalPosition', 'totalOffered', 'totalInterview', 'totalCompany', 'hotCompany', 'coldCompany', 'deadCompany', 'upcoming_interview', 'offered_candidate', 'events', 'joinedSum', 'greeting'))->render();

        $cachedView = Cache::remember('dashboard_view_cache_'.Auth::user()->id, 300 , function () use ($view) {
            return $view;
        });

        return $cachedView;
    }

    function companyCount(){

        $currentUser = Auth::user();
        $childUsers = $currentUser->descendantIds();

        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);


        $clients = 0;
        $clientChildUsers = $childUsers;
        if(in_array(Auth::user()->role,['manager','assistant_manager','talent_acquisition'])){
            $getupperHierarchy = User::where('software_category',Auth::user()->software_category)->whereIn('role',['admin','business_head','general_manager'])->pluck('id')->toArray();
            $parentids = array_diff($currentUser->ascendantIds(),$getupperHierarchy);
            $clientChildUsers = array_merge($childUsers,$parentids);
        }

        $allotted_clients = ClientAllotment::whereIn('alloted_to',$clientChildUsers)->pluck('client_id')->toArray();
        $clients = Client::where(function ($query) use ($clientChildUsers, $allotted_clients) {
            $query->whereIn('created_by', $clientChildUsers)
                ->orWhereIn('id', $allotted_clients);
        })->where('software_category', Auth::user()->software_category)->where('is_active', 1)->count();

        return $clients;
    }


    function positionCount(){

        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);

        return Position::whereIn('created_by', $childUsers)->where('software_category', Auth::user()->software_category)->where('is_active', 1)->count();
    }

    function candidateCount(){
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);

        return inc_format(Candidate::whereIn('created_by', $childUsers)->where('software_category', Auth::user()->software_category)->where('is_active', 1)->count());
    }

    function openClosePosition(){
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);

        $openPositionCurrentMonth = Position::whereIn('created_by', $childUsers)->where('is_active', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->count();

        $closePositionCurrentMonth = Position::whereIn('created_by', $childUsers)->where('is_close', 1)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->count();

        return [
            'openPositionCurrentMonth' => $openPositionCurrentMonth,
            'closePositionCurrentMonth' => $closePositionCurrentMonth,
        ];
    }

    function candidateStats(){
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);

        $candidateApproachCurrentMonth = Pipeline::whereIn('created_by', $childUsers)->whereNotNull('stage')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->count();

        $candidateOfferedCtcCurrentMonth = Pipeline::whereIn('created_by', $childUsers)->whereNotNull('offerd_ctc')->where('stage','offered')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->sum('offerd_ctc');

        $candidateJoinedAchivedCurrentMonth = Pipeline::whereIn('created_by', $childUsers)->where('stage', 'joined')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('software_category', Auth::user()->software_category)->sum('offerd_ctc');

        return [
            'candidateApproachCurrentMonth' => inc_format($candidateApproachCurrentMonth),
            'candidateOfferedCtcCurrentMonth' => inc_format($candidateOfferedCtcCurrentMonth),
            'candidateJoinedAchivedCurrentMonth' => inc_format($candidateJoinedAchivedCurrentMonth),
        ];
    }

    function joinedStats(){
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers, $currentUser->id);

        $joinedSum = Pipeline::whereIn('created_by', $childUsers)->select('join_quarter', DB::raw('SUM(offerd_ctc) as sum'))->where(['join_quarter_year' => date('Y')])->groupBy('join_quarter')->pluck('sum', 'join_quarter')->toArray();

        return [
            'q1' => inc_format($joinedSum[1] ?? 0),
            'q2' => inc_format($joinedSum[2] ?? 0),
            'q3' => inc_format($joinedSum[3] ?? 0),
            'q4' => inc_format($joinedSum[4] ?? 0),
        ];
    }
    function targetStats(){
        $currentUser = User::find(Auth::user()->id);
        $childUsers = $currentUser->descendantIds();
        array_unshift($childUsers, $currentUser->id);

        $quarters = [1, 2, 3, 4];
        $quarterTargets = [];

        $quarterlyTargets = MonthlyTarget::whereIn('user_id', $childUsers)
            ->where('year', date('Y'))
            ->groupBy('quarter')
            ->selectRaw('quarter, COALESCE(SUM(target), 0) as total_target')
            ->pluck('total_target', 'quarter')
            ->toArray();

        foreach ($quarters as $quarter) {
            $quarterTargets[$quarter] = $quarterlyTargets[$quarter] ?? 0;
        }

        $quarterTarget = [1 => $quarterTargets[1] , 2 => $quarterTargets[2]  , 3 =>$quarterTargets[3] , 4 => $quarterTargets[4]];

        $quarterlyCompleted = Pipeline::whereIn('created_by', $childUsers)
            ->where('join_quarter_year', date('Y'))
            ->groupBy('join_quarter')
            ->selectRaw('join_quarter, COALESCE(SUM(offerd_ctc), 0) as total_offerd_ctc')
            ->pluck('total_offerd_ctc', 'join_quarter')
            ->toArray();

        foreach ($quarters as $quarter) {
                $quarterlyCompleted[$quarter] = $quarterlyCompleted[$quarter] ?? 0;
        }

        $quarterComplate= [1 => $quarterlyCompleted[1] , 2 => $quarterlyCompleted[2]  , 3 =>$quarterlyCompleted[3] , 4 =>$quarterlyCompleted[4]];


        $quarterPendings = [1 => $quarterTargets[1] - $quarterlyCompleted[1] , 2 => $quarterTargets[2] -$quarterlyCompleted[2] , 3 =>$quarterTargets[3] - $quarterlyCompleted[3] , 4 => $quarterTargets[4] - $quarterlyCompleted[4]];

        return view('pages.dashboard-target-section', compact('quarterTarget','quarterComplate','quarterPendings'));
    }

    public function positionReport(Request $request)
    {
        $startDate = $request->fromDate;
        $endDate = $request->toDate;
        $manager_id = $request->id;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $position = Position::whereIn('created_by', $childUsers)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)->where('software_category', Auth::user()->software_category)->get();
        $totalPosition = count($position);
        $openPosition = count($position->where('is_active', 1));
        $closePosition = count($position->where('is_close', 1));
        $holdPosition = count($position->where('is_hold', 1));
        return ["total" => $totalPosition, "opened" => $openPosition, "closed" => $closePosition, "hold" => $holdPosition];
    }
    public function companyReport(Request $request)
    {
        $date = Carbon::now();
        $startDate = $request->fromDate;
        $endDate = $request->toDate;
        $manager_id = $request->id;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $totalCompany = Client::whereIn('created_by', $childUsers)->where('is_active', 1)->where('software_category', Auth::user()->software_category)->get();
        $clientId = [];
        $clientId = $totalCompany->pluck('id')->unique()->toArray();
        $hotCompany = 0;
        $coldCompany = 0;
        $deadCompany = 0;
        foreach ($clientId as $id) {
            $position = Position::where('client_id', $id)->orderBy('id', 'DESC')->where('software_category', Auth::user()->software_category)->first();
            if ($position != null) {
                $lastDate = $position->created_at->format('Y-m-d') ?? '-';
                $difference = $date->diffInDays(Carbon::parse($lastDate));
                if ($difference >= 0 && $difference <= 90) {
                    $hotCompany++;
                } elseif ($difference > 90 && $difference <= 180) {
                    $coldCompany++;
                } elseif ($difference > 180) {
                    $deadCompany++;
                }
            } else {
                $deadCompany++;
            }
        }

        return ["totalCompany" => $totalCompany->count(), "hot" => $hotCompany, "cold" => $coldCompany, "dead" => $deadCompany];
    }

    public function offeredReport(Request $request)
    {
        $startDate = $request->fromDate;
        $endDate = $request->toDate;
        $manager_id = $request->id;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $offered = Pipeline::whereIn('created_by', $childUsers)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('software_category', Auth::user()->software_category)->whereIn('stage', ['offered', 'joined', 'backout'])->get();
        $offerCandidate = count($offered->where('stage', 'offered'));
        $joinCandidate = count($offered->where('stage', 'joined'));
        $rejectCandidate = count($offered->where('stage', 'backout'));
        return ["offered" => $offerCandidate, "joined" => $joinCandidate, "notJoined" => $rejectCandidate];
    }

    public function interviewReport(Request $request)
    {
        $startDate = $request->fromDate;
        $endDate = $request->toDate;
        $manager_id = $request->id;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $interview = Pipeline::whereNotNull('interview_date')->whereIn('created_by', $childUsers)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('software_category', Auth::user()->software_category)->get();
        $totalInterview = $interview->count();
        $totalSelected = $interview->where('stage', 'selected')->count();
        $totalRejected = $interview->where('stage', 'rejected')->count();
        $totalNotAttend = $interview->where('stage', 'not_attend')->count();
        return ["total" => $totalInterview, "selected" => $totalSelected, "rejected" => $totalRejected, "notAttend" => $totalNotAttend];
    }

    public function getInterview(Request $request)
    {
        $manager_id = $request->id;
        $pastDate = $request->last;
        $currentDate = $request->present;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $upcoming_interview = Pipeline::with(['candidate', 'position', 'pco'])->whereNotNull('interview_date')->whereIn('created_by', $childUsers)
            ->whereDate('interview_date', '>=', $currentDate)
            ->where('software_category', Auth::user()->software_category)->get();
            // foreach($upcoming_interview as $interview){
            //     $manager=$interview['pco']['parent_id'];
            //     if($manager != 1){
            //         $parentName=User::find($manager);
            //         $interview['pco']['parent_id']=$parentName->name;
            //     }
            //     else{
            //         $interview['pco']['parent_id'] = $interview['pco']['name'] ?? "Admin";
            //     }
            // }
        return view('pages.cards.upcoming_interview_card', compact('upcoming_interview'));
    }

    public function getOffered(Request $request)
    {
        $manager_id = $request->id;
        $pastDate = $request->last;
        $currentDate = $request->present;
        $currentUser = User::find($manager_id);
        $childUsers = $currentUser->descendantIds();
        $users = User::whereIn('id', $childUsers)->get();
        array_unshift($childUsers, $currentUser->id);
        $offered_candidate = Pipeline::whereIn('created_by', $childUsers)->where('stage', 'offered')->whereBetween('created_at', [$pastDate . ' 00:00:00', $currentDate . ' 23:59:59'])->where('software_category', Auth::user()->software_category)->get();
        
        return view('pages.cards.offered_candidate_card', compact('offered_candidate'));
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function changeAdminCategory(Request $request)
    {
        $admin = User::find(Auth::user()->id);
        $admin->software_category = $request->value;
        $admin->save();
        Cache::forget('dashboard_view_cache_'.Auth::user()->id);
        Cache::forget('position_list_cache_'.Auth::user()->id);
        return 1;
    }

    public function refreshCache($param){
        $position = 'position_list_cache_'.Auth::user()->id;
        $dashboard='dashboard_view_cache_'.Auth::user()->id;
        if($param=='position'){
        DB::table('cache')->where('key','like', '%' . $position . '%')->delete();
        }
        else if($param=='dashboard'){
            Cache::forget($dashboard);
        }
        return back();
    }

}
