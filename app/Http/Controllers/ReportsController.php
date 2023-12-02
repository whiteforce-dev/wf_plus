<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use App\Models\Hr;
use App\Models\Pipeline;
use App\Models\Sheet;
use App\Models\Target;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Models\Source;
use App\Models\Candidate;
use App\Models\Client;
use App\Models\ClientAllotment;
use App\Models\Position;
use App\Models\ThirdPartyJobs;

class ReportsController extends Controller
{
    public function index()
    {
        $user = Auth::user()->role;
        return view('reports.index',compact('user'));
    }


    public function job_analysis_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();
        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d M');
            $start->addDay(); // Increment the date by one day
        }
        $allParents = getAllParentRollWise();
        return view('reports.job_analysis_report', compact('allParents', 'currentDate', 'pastDate', 'dates'));

    }

    public function job_analysis_report_data(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $manager_id = $request->parent_id;

        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d M');
            $start->addDay();
        }

        $allChilds = User::where('parent_id', $manager_id)->where('software_category', Auth::user()->software_category)->pluck('id')->toArray();

        array_unshift($allChilds, (int) $manager_id);

        $team = User::whereIn('id', $allChilds)->orderByRaw("FIELD(id, '" . implode("','", $allChilds) . "')")->pluck('name')->toArray();

        $combine = [];
        $counts = [];
        foreach ($allChilds as $key => $id) {
            $countsRow = [];
            for ($i = 0; $i < count($dates); $i++) {
                $countsRow[$i] = Analysis::where('user_id', $id)->whereDate('created_at', Carbon::parse($dates[$i]))->count();
            }
            $score =[];
            for ($i = 0; $i < count($dates); $i++) {
                $score[$i] = Analysis::where('user_id', $id)->whereDate('created_at', Carbon::parse($dates[$i]))->select('score', 'created_at','jd_name','resume_name')
                ->get();
            }

            $counts['id'] = $id;
            $counts['name'] = $team[$key];
            $counts['counts'] = $countsRow;
            $counts['score'] = $score;
            $combine[] = $counts;
        }
        // return $combine;
        return view('reports.job_analysis_report_data', compact('dates', 'combine'));
    }

    public function monthly_target_report()
    {
        $allParents = getAllParentRollWise();
        return view('reports.monthly_target_report', compact('allParents'));
    }

    public function monthly_target_report_data(Request $request)
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        $curQuarter = ceil(date('n', time()) / 3);
        $roles = allRoles();
        $users = collect(User::where('parent_id', $request->parent_id)->orWhere('id', $request->parent_id)->select('id', 'name', 'profile_image', 'role')->orderByRaw("FIELD(role, '" . implode("','", array_flip($roles)) . "')")->get());
        $all_users_id = $users->pluck('id')->toArray();

        $joined = [];
        $backout = [];
        $quarter_joined = [];
        $currency = '';

        $approach = Pipeline::select('created_by', \DB::raw('count(id) as approach_candidate'))->whereBetween('created_at', [$start_date, $end_date])->whereIn('created_by', $all_users_id)->groupBy('created_by')->pluck('approach_candidate', 'created_by')->toArray();

        if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
            $joined = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_join_ctc'))->whereBetween('joining_date', [$start_date, $end_date])->whereIn('created_by', $all_users_id)->where('stage', '=', 'joined')->groupBy('created_by')->pluck('total_join_ctc', 'created_by')->toArray();

            $backout = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_backout_ctc'))->whereBetween('updated_at', [$start_date, $end_date])->whereIn('created_by', $all_users_id)->where('stage', '=', 'backout')->groupBy('created_by')->pluck('total_backout_ctc', 'created_by')->toArray();

            $quarter_joined = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_join_ctc'))->where('join_quarter', $curQuarter)->whereIn('created_by', $all_users_id)->where('stage', '=', 'joined')->groupBy('created_by')->pluck('total_join_ctc', 'created_by')->toArray();

            $currency = '₹';
        } elseif (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {
            $joined = Pipeline::select('created_by', \DB::raw('count(id) as total_joined'))->whereBetween('joining_date', [$start_date, $end_date])->whereIn('created_by', $all_users_id)->where('stage', '=', 'joined')->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();

            $backout = Pipeline::select('created_by', \DB::raw('count(id) as total_backout'))->whereBetween('updated_at', [$start_date, $end_date])->whereIn('created_by', $all_users_id)->where('stage', '=', 'backout')->groupBy('created_by')->pluck('total_backout', 'created_by')->toArray();

            $quarter_joined = Pipeline::select('created_by', \DB::raw('count(id) as total_joined'))->where('join_quarter', $curQuarter)->whereIn('created_by', $all_users_id)->where('stage', '=', 'joined')->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();
        }

        $total_approach = !empty($approach) ? array_sum($approach) : 0;
        $total_joined = !empty($joined) ? array_sum($joined) : 0;
        $total_backout = !empty($backout) ? array_sum($backout) : 0;
        $total_quarter_joined = !empty($quarter_joined) ? array_sum($quarter_joined) : 0;

        return view('reports.monthly_target_report_data', compact('approach', 'joined', 'backout', 'quarter_joined', 'users', 'currency', 'total_approach', 'total_joined', 'total_backout', 'total_quarter_joined'));
    }

    public function month_wise_report()
    {
        $allParents = getAllParentRollWise();
        return view('reports.month_wise_report', compact('allParents'));
    }

    public function month_wise_report_data(Request $request)
    {
        $roles = allRoles();
        $months = monthsArray();
        $users = collect(User::where('parent_id', $request->parent)->orWhere('id', $request->parent)->select('id', 'name', 'profile_image', 'role')->orderByRaw("FIELD(role, '" . implode("','", array_flip($roles)) . "')")->get());
        $all_users_id = $users->pluck('id')->toArray();
        $all_approach_array = [];
        $all_achieved_array = [];
        $currency = '';
        foreach ($months as $month => $month_name) {
            $approach = Pipeline::select('created_by', \DB::raw('count(id) as approach_candidate'))->whereMonth('created_at', '=', date($month))->whereYear('created_at', $request->year)->whereIn('created_by', $all_users_id)->groupBy('created_by')->pluck('approach_candidate', 'created_by')->toArray();
            $all_approach_array[$month] = $approach;
            if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
                $achieved = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as achieved_candidate'))->where('stage', '=', 'joined')->whereMonth('joining_date', '=', date($month))->whereYear('joining_date', $request->year)->whereIn('created_by', $all_users_id)->groupBy('created_by')->pluck('achieved_candidate', 'created_by')->toArray();
                $currency = '₹';
            } elseif (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {
                $achieved = Pipeline::select('created_by', \DB::raw('count(id) as achieved_candidate'))->where('stage', '=', 'joined')->whereMonth('joining_date', '=', date($month))->whereYear('joining_date', $request->year)->whereIn('created_by', $all_users_id)->groupBy('created_by')->pluck('achieved_candidate', 'created_by')->toArray();
            }
            $all_achieved_array[$month] = $achieved;
        }
        return view('reports.month_wise_report_data', compact('months', 'users', 'all_approach_array', 'all_achieved_array', 'currency'));
    }

    public function interview_pannel_report()
    {
        $allParents = getAllParentRollWise();
        $from_date = Carbon::today()->subDays(7)->format('Y-m-d');
        $to_date = Carbon::today()->format('Y-m-d');
        return view('reports.interview_pannel_report', compact('allParents', 'from_date', 'to_date'));
    }

    public function interview_pannel_report_data(Request $request)
    {
        if (empty($request->team)) {
            $parent = User::find($request->parent);
            $user_ids = $parent->descendantIds();
            array_unshift($user_ids, $request->parent);
        } else {
            $user_ids = [$request->team];
        }
        $interviews = Pipeline::select('position_id', 'candidate_id', 'stage', 'interview_date', 'created_by', 'owner')->whereBetween('interview_date', [$request->from_date, $request->to_date])->whereIn('created_by', $user_ids);
        if (!empty($request->stage)) {
            $interviews = $interviews->where('stage', $request->stage);
        }
        if (!empty($request->client)) {
            $interviews = $interviews->whereHas('position.findClientGet', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->client . '%');
            });
        }
        $interviews = $interviews->with(['position:id,client_id,position_name', 'position.findClientGet:id,name', 'candidate:id,name', 'pco:id,name', 'position_owner:id,name'])
       ->get();
        return view('reports.interview_pannel_report_data', compact('interviews'));
    }

    public function quarter_wise_report()
    {
        $allParents = getAllParentRollWise();
        return view('reports.quarter_wise_report', compact('allParents'));
    }

    public function quarter_wise_report_data(Request $request)
    {
        $months = getQuarterMonths($request->quarter);
        $roles = allRoles();
        if (empty($request->team)) {
            $parent = User::find($request->parent);
            $user_ids = $parent->descendantIds();
            array_unshift($user_ids, $request->parent);
        } else {
            $user_ids = [$request->team];
        }
        $users = User::whereIn('id', $user_ids)->select('id', 'name', 'role')->orderByRaw("FIELD(role, '" . implode("','", array_flip($roles)) . "')")->get();

        $all_target = $all_offered = $all_joined = [];
        $grand_total_offered = $grand_total_joined = $grand_total_remaining = 0;
        $spillover_quarter = ($request->quarter == 1) ? 4 : ($request->quarter - 1);
        $spillover_quarter_year = ($request->quarter == 1) ? ($request->year - 1) : $request->year;

        foreach ($months as $key => $month) {
            $user_target = Target::whereIn('user_id', $user_ids)->whereMonth('created_at', $key)->pluck('month_target', 'user_id')->toArray();
            $all_target[$key] = !empty($user_target) ? $user_target : [];
            if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
                $offered = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_offered'))->whereMonth('created_at', $key)->whereYear('created_at', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_offered', 'created_by')->toArray();
                $all_offered[$key] = !empty($offered) ? $offered : [];

                $joined = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_joined'))->whereMonth('joining_date', $key)->whereYear('joining_date', $request->year)->where('stage', '=', 'joined')->where('cre_quarter', $request->quarter)->where('cre_quarter_year', $request->year)->where('join_quarter', $request->quarter)->where('join_quarter_year', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();
                $all_joined[$key] = !empty($joined) ? $joined : [];
            } elseif (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {
                $offered = Pipeline::select('created_by', \DB::raw('count(id) as total_offered'))->whereMonth('created_at', $key)->whereYear('created_at', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_offered', 'created_by')->toArray();
                $all_offered[$key] = !empty($offered) ? $offered : [];

                $joined = Pipeline::select('created_by', \DB::raw('count(id) as total_joined'))->whereMonth('joining_date', $key)->whereYear('joining_date', $request->year)->where('stage', '=', 'joined')->where('cre_quarter', $request->quarter)->where('cre_quarter_year', $request->year)->where('join_quarter', $request->quarter)->where('join_quarter_year', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();
                $all_joined[$key] = !empty($joined) ? $joined : [];
            }
        }

        if (in_array(Auth::user()->software_category, ONROLE_CATEGORY())) {
            $spillover = Pipeline::select('created_by', \DB::raw('sum(offerd_ctc) as total_joined'))->where('stage', '=', 'joined')->where('cre_quarter', $spillover_quarter)->where('cre_quarter_year', $spillover_quarter_year)->where('join_quarter', $request->quarter)->where('join_quarter_year', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();
        } elseif (in_array(Auth::user()->software_category, OFFROLE_CATEGORY())) {
            $spillover = Pipeline::select('created_by', \DB::raw('count(id) as total_joined'))->where('stage', '=', 'joined')->where('cre_quarter', $spillover_quarter)->where('cre_quarter_year', $spillover_quarter_year)->where('join_quarter', $request->quarter)->where('join_quarter_year', $request->year)->whereIn('created_by', $user_ids)->groupBy('created_by')->pluck('total_joined', 'created_by')->toArray();
        }

        return view('reports.quarter_wise_report_data', compact('months', 'all_target', 'all_offered', 'all_joined', 'users', 'grand_total_offered', 'grand_total_joined', 'grand_total_remaining', 'spillover'));
    }

    public function company_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();

        $allParents = getAllParentRollWise();
        return view('reports.company_report', compact('allParents', 'currentDate', 'pastDate'));
    }


    public function company_report_data(Request $request)
    {



        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);
        $details = [];
        if ($request->child_id == 0) {
            $users = $allChilds;
        } else {
            $users = [$request->child_id];
        }


        $allotted_clients = ClientAllotment::whereIn('alloted_to', $users)->pluck('client_id')->toArray();
        $clientId = Client::where(function ($query) use ($users, $allotted_clients) {
            $query->whereIn('created_by', $users)
                ->orWhereIn('id', $allotted_clients);
        })->pluck('id')->toArray();



        $date = Carbon::now();
        $hotCompany = [];
        $coldCompany = [];
        $deadCompany = [];


        foreach ($clientId as $id) {
            $position = Position::where('client_id', $id)->orderBy('id', 'DESC')->where('software_category', Auth::user()->software_category)->first();
            if ($position != null) {
                $lastDate = $position->created_at->format('Y-m-d') ?? '-';
                $difference = $date->diffInDays(Carbon::parse($lastDate));
                if ($difference >= 0 && $difference <= 90) {
                    array_push($hotCompany, $position->client_id);
                } elseif ($difference > 90 && $difference <= 180) {
                    array_push($coldCompany, $position->client_id);
                } elseif ($difference > 180) {
                    array_push($deadCompany, $position->client_id);
                }
            } else {
                array_push($deadCompany, $id);
            }
        }



        if ($request->status == 'hot') {
            $clients = $hotCompany;
        }
        if ($request->status == 'cold') {
            $clients = $coldCompany;
        }
        if ($request->status == 'dead') {
            $clients = $deadCompany;
        }

        $status = $request->status;
        $companies = Client::with(['owner', 'getPosition'])->whereIn('id', $clients)->get();
        return view('reports.company_report_data', compact('companies', 'status'));
    }



    public function getChildrenRollWiseWithParent($id)
    {
        $allChilds = getAllChildrenRollWise($id);
        $parent = User::find($id);
        $html = '<option value="">All</option>';
        $html .= '<option value="' . $parent->id . '">' . $parent->name . '</option>';
        foreach ($allChilds as $role => $users) {
            $html .= '<optgroup label="' . $role . '">';
            foreach ($users as $id => $user) {
                $html .= '<option value="' . $id . '">' . $user . '</option>';
            }
            $html .= '</optgroup>';
        }
        return $html;
    }

    public function hr_birthdays(Request $request)
    { 
        $parent = User::find(Auth::user()->id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)Auth::user()->id);
        $users = User::whereIn('id',$allChilds)->get();
        $current_date = Carbon::now();
        $days = $request->days ?? 30;
        $last_date = $current_date->addDays($days)->format('d-m');
        $last = $last_date;
        $client_id = Client::whereIn('created_by',$allChilds)->pluck('id')->toArray();
        $manager = $request->manager;
        if(isset($request->manager) && $request->manager != 1){

            $hrdata = Hr::with('hr_master')->whereIn('client_id',$client_id)->where('software_category',Auth::user()->software_category)
            ->whereHas('hr_master', function ($query) use ($request) {
                $query->where('created_by',$request->manager );
            })->get();
            return view('reports.hr_birthday_report', compact('hrdata','users','manager'));
        }
        $hrdata = Hr::with('hr_master')->whereIn('client_id',$client_id)->where('software_category',Auth::user()->software_category)->get();
        return view('reports.hr_birthday_report', compact('hrdata','users','manager'));
    }

    public function calling_sheet_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();
        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d-M');
            $start->addDay(); // Increment the date by one day
        }
        $allParents = getAllParentRollWise();
        return view('reports.calling_sheet_report', compact('allParents', 'currentDate', 'pastDate', 'dates'));
    }
    public function calling_sheet_report_data(Request $request)
    {
        
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $manager_id = $request->parent_id;
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d-M');
            $start->addDay(); // Increment the date by one day
        }
        $parent = User::find($manager_id);
        $user_ids = $parent->descendantIds();
        array_unshift($user_ids, (int) $manager_id);
        $counts = [];
        // foreach ($user_ids as $id) {
        //     $countsRow = [];
        //     for ($i = 0; $i < count($dates); $i++) {
        //         $countsRow[$i] = Sheet::where('created_by', $id)->whereDate('created_at', Carbon::parse($dates[$i]))->where('software_category', Auth::user()->software_category)->orderBy('id', 'DESC')->count();
        //     }
        //     $counts[$id] = $countsRow;
        // }
        foreach ($user_ids as $id) {
            $countsRow = [];
            for ($i = 0; $i < count($dates); $i++) {
                $d = Carbon::parse($dates[$i])->format('Y-m-d');
                $startOfDay = $d . ' 00:00:00';
                $endOfDay = $d . ' 23:59:59';
                $countsRow[$i] = Sheet::where('created_by', $id)->where('created_at', '>=', $startOfDay)
                ->where('created_at', '<=', $endOfDay)->where('software_category', Auth::user()->software_category)->count();
                // $countsRow["number"] = Sheet::select('mobile')->where('created_by', $id)->where('created_at', '>=', $startOfDay)
                // ->where('created_at', '<=', $endOfDay)->where('software_category', Auth::user()->software_category)->groupBy('mobile')
                // ->havingRaw('COUNT(*) > 1')->get();
                // $countsRow["data"] = Sheet::select('mobile','candidate_name','company_name','position','created_at')->whereIn('mobile', $countsRow["number"])->get(); 
                
            }
            $user = User::where('id',$id)->first();
            $countsRow["user"] = $user->name;
            $counts[] = $countsRow;
        }
        // return $counts;
        return view('reports.calling_sheet_report_data', compact('dates', 'counts'));
    }

    public function get_calling_detail(Request $request){
        return $request;
    }

    public function daily_lineup_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();
        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d M');
            $start->addDay(); // Increment the date by one day
        }
        $allParents = getAllParentRollWise();
        return view('reports.daily_lineup_report', compact('allParents', 'currentDate', 'pastDate', 'dates'));
    }

    public function daily_lineup_report_data(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $manager_id = $request->parent_id;

        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d M');
            $start->addDay(); // Increment the date by one day
        }



        $allChilds = User::where('parent_id', $manager_id)->where('software_category', Auth::user()->software_category)->pluck('id')->toArray();


        array_unshift($allChilds, (int) $manager_id);


        $team = User::whereIn('id', $allChilds)->orderByRaw("FIELD(id, '" . implode("','", $allChilds) . "')")->pluck('name')->toArray();

        $combine = [];
        $counts = [];
        foreach ($allChilds as $key => $id) {
            $countsRow = [];
            for ($i = 0; $i < count($dates); $i++) {
                $countsRow[$i] = Pipeline::where('created_by', $id)->whereDate('created_at', Carbon::parse($dates[$i]))->where('software_category', Auth::user()->software_category)->orderBy('id', 'DESC')->count();
            }
            $total = 0;
            foreach($countsRow as $c){
                $total = $total+(int)$c;
            }
            $counts['id'] = $id;
            $counts['name'] = $team[$key];
            $counts['counts'] = $countsRow;
            $counts['total'] = $total;
            $combine[] = $counts;
        }
        
        return view('reports.daily_lineup_report_data', compact('dates', 'combine'));
    }

    public function get_lineup_report_data(Request $request)
    {

        $candidates = Pipeline::with(['candidate', 'position', 'pco'])->where('created_by', $request->user_id)->whereDate('created_at', Carbon::parse($request->date))->where('software_category', Auth::user()->software_category)->orderBy('id', 'DESC')->get();

        return view('reports.lineup_candidate', compact('candidates'));
    }

    public function pipeline_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();
        $dates = [];
        while ($start->lte($end)) {
            $dates[] = $start->format('d M');
            $start->addDay(); // Increment the date by one day
        }
        $allParents = getAllParentRollWise();
        return view('reports.pipeline_report', compact('allParents', 'currentDate', 'pastDate', 'dates'));
    }

    public function get_user_child(Request $request)
    {
        $allChilds = User::where('parent_id', $request->parent_id)->where('software_category', Auth::user()->software_category)->pluck('id')->toArray();

        array_unshift($allChilds, (int)$request->parent_id);

        $childs = User::whereIn('id', $allChilds)->where('software_category', Auth::user()->software_category)->get();
        echo '<option value="0">All</option>';
        foreach ($childs as $child) {
            echo '<option value="' . $child->id . '">' . $child->name . '</option>';
        }
    }

    public function pipeline_report_data(Request $request)
    {

        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);

        if ($request->child_id == 0) {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->whereIn('created_by', $allChilds)
                ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->whereIn('stage', ['hot', 'selected'])
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        } else {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->where('created_by', $request->child_id)
                ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->whereIn('stage', ['hot', 'selected'])
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        }

        return view('reports.pipeline_report_data', compact('candidates'));
    }
    public function joining_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();

        $allParents = getAllParentRollWise();
        return view('reports.joining_report', compact('allParents', 'currentDate', 'pastDate'));
    }

    public function joining_report_data(Request $request)
    {
        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);

        if ($request->status == 0) {
            $status = ['joined', 'backout', 'offered'];
        } else {
            $status = [$request->status];
        }



        if ($request->child_id == 0) {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->whereIn('created_by', $allChilds)
                ->whereNotNull('offerd_ctc')
                ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->whereIn('stage', $status)
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        } else {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->where('created_by', $request->child_id)
                ->whereNotNull('offerd_ctc')
                ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->whereIn('stage', $status)
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        }

        return view('reports.joining_report_data', compact('candidates'));
    }

    public function chrome_extension_report()
    {
        $allParents = getAllParentRollWise();
        $sources = Source::where('extension_created', 1)->get();

        return view('reports.chrome_extension_report', compact('allParents', 'sources'));
    }

    public function chrome_extension_report_data(Request $request)
    {
        $sources = Source::where('extension_created', 1)->get();
        $roles = allRoles();

        if (empty($request->team)) {
            $parent = User::find($request->parent);
            $user_ids = $parent->descendantIds();
            array_unshift($user_ids, $request->parent);
        } else {
            $user_ids = [$request->team];
        }
        $users = User::whereIn('id', $user_ids)->select('id', 'name', 'role')->orderByRaw("FIELD(role, '" . implode("','", array_flip($roles)) . "')")->get();
        $source_wise_candidate = [];
        $all_candidates = Candidate::select('id', 'added_from', 'source', 'created_by', 'created_at', 'software_category')->where('added_from', 'extension')->where('software_category', Auth::user()->software_category);
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $all_candidates = $all_candidates->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
        }
        $all_candidates = collect($all_candidates->get());
        foreach ($users as $user) {
            $candidatesCountBySource = $all_candidates->where('created_by', $user->id)->groupBy('source')
                ->map(function ($groupedCandidates) {
                    return $groupedCandidates->count();
                });
            if ($candidatesCountBySource->isNotEmpty()) {
                $source_wise_candidate[$user->id] = $candidatesCountBySource;
            }
        }
        $all_total = 0;
        $all_src_totals = [];
        return view('reports.chrome_extension_report_data', compact('sources', 'users', 'source_wise_candidate', 'all_total'));
    }

    public function consolidate_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();

        $allParents = getAllParentRollWise();
        return view('reports.consolidate_report', compact('allParents', 'currentDate', 'pastDate'));
    }

    public function consolidate_report_data(Request $request)
    {

        // try {
        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);
        $details = [];
        if ($request->child_id == 0) {
            foreach ($allChilds as $key => $id) {
                $detailsRow["user"] =  User::find($id);
                $detailsRow["parent"] =  User::find($id)->parent;
                $detailsRow["sheet"] =  Sheet::where('created_by', $id)
                    ->whereBetween('created_at', [$request->end_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                    ->where('software_category', Auth::user()->software_category)
                    ->orderBy('id', 'DESC')->count();

                $detailsRow["pipeline"] = Pipeline::where('created_by', $id)
                    ->whereBetween('created_at', [$request->end_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                    ->where('software_category', Auth::user()->software_category)
                    ->orderBy('id', 'DESC')->count();


                $detailsRow["interview"] = Pipeline::where('created_by', $id)
                    ->where('interview_date', $request->end_date)
                    ->where('software_category', Auth::user()->software_category)
                    ->orderBy('id', 'DESC')->count();

                $detailsRow["joining"] = Pipeline::where('created_by', $id)
                    ->where('joining_date', $request->end_date)
                    ->where('software_category', Auth::user()->software_category)
                    ->orderBy('id', 'DESC')->count();

                $detailsRow["joining_ctc"] = Pipeline::where('created_by', $id)
                    ->where('joining_date', $request->end_date)
                    ->where('software_category', Auth::user()->software_category)
                    ->orderBy('id', 'DESC')->sum('offerd_ctc');

                $details[$key] = $detailsRow;
            }
            // return $details;
        } else {
            $id = $request->child_id;

            $detailsRow["user"] =  User::find($id);
            $detailsRow["parent"] =  User::find($id)->parent;
            $detailsRow["sheet"] =  Sheet::where('created_by', $id)
                ->whereBetween('created_at', [$request->end_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->where('software_category', Auth::user()->software_category)
                ->orderBy('id', 'DESC')->count();

            $detailsRow["pipeline"] = Pipeline::where('created_by', $id)
                ->whereBetween('created_at', [$request->end_date . ' 00:00:00', $request->end_date . ' 23:59:59'])
                ->where('software_category', Auth::user()->software_category)
                ->orderBy('id', 'DESC')->count();


            $detailsRow["interview"] = Pipeline::where('created_by', $id)
                ->where('interview_date', $request->end_date)
                ->where('software_category', Auth::user()->software_category)
                ->orderBy('id', 'DESC')->count();

            $detailsRow["joining"] = Pipeline::where('created_by', $id)
                ->where('joining_date', $request->end_date)
                ->where('software_category', Auth::user()->software_category)
                ->orderBy('id', 'DESC')->count();

            $detailsRow["joining_ctc"] = Pipeline::where('created_by', $id)
                ->where('joining_date', $request->end_date)
                ->where('software_category', Auth::user()->software_category)
                ->orderBy('id', 'DESC')->sum('offerd_ctc');

            $details[0] = $detailsRow;
            // return $details;
        }

        return view('reports.consolidate_report_data', compact('details'));
        // $view = view('reports.consolidate_report_data', compact('details'))->render();
        // return response()->json(['status' => 200, 'response' => $details]);
        // } catch (\Exception $e) {
        //     return response()->json(['status' => 500]);
        // }
    }

    public function requirement_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        $currentDate = $date->format('Y-m-d');
        $pastDate = $date->subDays(6);
        $start = $pastDate;
        $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();

        $allParents = getAllParentRollWise();
        return view('reports.requirement_report', compact('allParents', 'currentDate', 'pastDate'));
    }

    public function requirement_report_data(Request $request)
    {

        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);
        $details = [];
        if ($request->child_id == 0) {
            $users = $allChilds;
        } else {
            $users = [$request->child_id];
        }

        $positions = Position::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->whereIn('created_by', $users)->where('is_active', 1)->get();
        return view('reports.requirement_report_data', compact('positions'));
    }

    //     public function get_extension_data(Request $request){
    //         $source = $request->source;
    //         $candidates = Candidate::where('added_from','extension')->where('source',$request->source)->where('created_by',$request->user_id)->where('software_category',Auth::user()->software_category);
    //         if (!empty($request->from_date) && !empty($request->to_date)) {
    //             $candidates = $candidates->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
    //         }
    //         $candidates = $candidates->get();
    //         $total_count = count($candidates);
    //         return view('reports.extension_candidate_data',compact('candidates','source','total_count'));

    //    }



    public function month_joining_report()
    {
        $currentUser = Auth::user()->id;
        $date = Carbon::now();
        // $currentDate = $date->format('Y-m-d');
        // $pastDate = $date->subDays(6);
        // $start = $pastDate;
        // $pastDate = $pastDate->format('Y-m-d');
        $end = Carbon::now();
        $allParents = getAllParentRollWise();
        $month = date('m');
        return view('reports.month_joining_report', compact('allParents', 'month'));
    }

    public function month_joining_report_data(Request $request)
    {
        $parent = User::find($request->parent_id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)$request->parent_id);

        if ($request->child_id == 0) {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->whereIn('created_by', $allChilds)
                ->whereNotNull('offerd_ctc')
                ->whereMonth('joining_date', '=', (int)$request->month)
                ->where('stage', 'joined')
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        } else {
            $candidates = Pipeline::with(['candidate', 'position', 'pco'])
                ->where('created_by', $request->child_id)
                ->whereNotNull('offerd_ctc')
                ->whereMonth('joining_date', '=', (int)$request->month)
                ->where('stage', 'joined')
                ->orderBy('id', 'DESC')
                ->where('software_category', Auth::user()->software_category)
                ->get();
        }
        return view('reports.month_joining_report_data', compact('candidates'));
    }

    public function client_portal_jobs(){
       
        $portals =  ThirdPartyJobs::select('publisher')->distinct()->pluck('publisher')->toArray();
        $totalJobs = ThirdPartyJobs::count();
        $jobCount = [];
        foreach ($portals as $key => $portal) {
            $jobCount[$portal] = ThirdPartyJobs::where('publisher', $portal)->count();
        }
        return view('reports.client_portal_job_report',compact('jobCount','totalJobs'));
    }

    public function applied_candidate_report(){
        $source = Candidate::select('source')->distinct()->pluck('source')->toArray();
            
        return view('reports.applied_candidate_report',compact('source'));
    }

    public function applied_candidate_report_data(Request $request){
        $candidates = Candidate::where('source',$request->source)->whereBetween('created_at', [$request->fromdate . ' 00:00:00', $request->todate . ' 23:59:59'])->paginate(20);
        $total= Candidate::where('source',$request->source)->whereBetween('created_at', [$request->fromdate . ' 00:00:00', $request->todate . ' 23:59:59'])->count();
        return view('reports.applied_candidate_report_data',compact('candidates','total'));
    }
}
