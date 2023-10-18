<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use App\Models\Hr;
use App\Models\Investment;
use App\Models\Hrgift;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hrs = Hr::where('software_category', Auth::user()->software_category ?? 'onrole')->get();
        // return $hrs;
        return view('pages.investment.hrList', compact('hrs'));
    }

    public function giftDetail($id)
    {
      
        $hrId = $id;
        $hrs = Hr::with('clientName')->where('software_category', Auth::user()->software_category ?? 'onrole')->where('id',$hrId)->first();
        $Hrgift = Gift::get();
        // return $Hrgift;

        return view('pages.investment.allinvestment', compact('Hrgift', 'hrId','hrs'));
    }


    public function saveInvestment(Request $request, $id)
    {
// dd($request);
        $Investment = new Investment();
        $hrId = $id;
        $giftId = request('giftId');
        $Investment->hrId = $hrId;
        $Investment->giftId = $giftId;
        $Investment->price = request('price');
        $Investment->remark = request('remark');
        $Investment->software_category = Auth::user()->software_category ?? 'onrole';
        $Investment->save();

        $hrinvestments = Investment::where('hrId', $hrId)->where('software_category', Auth::user()->software_category ?? 'onrole')->get();
            
        $hrpricesum = Investment::where('hrId', $hrId)->sum('price');
return redirect('investment')->with('success','Gift details added successfully..');

        // return view('pages.investment.showAllInvestment', compact('hrinvestments', 'hrpricesum', 'hrId'))->with('success','Gift details added successfully..');
    }
    public function showInvestment(Request $request, $id)
    {
        $hrId = $id;
        $hrinvestments = Investment::where('hrId', $hrId)->where('software_category', Auth::user()->software_category ?? 'onrole')->get();
            
        $hrpricesum = Investment::where('hrId', $hrId)->sum('price');
        return view('pages.investment.showAllInvestment', compact('hrinvestments', 'hrpricesum', 'hrId'));
    }
    public function deleteInvestment( $id)
    {
        // return
        $hrId = $id;
        $hrinvestments = Investment::find($id)->delete();
        // return  $hrinvestments;
            
        // $hrpricesum = Investment::where('hrId', $hrId)->sum('price');
        return redirect()->back()->with('success','Gift details deleted successfully..');;
    }
    public function editInvestment( $id)
    {
        $hrId = $id;
        $hrinvestments = Investment::find($id);
        $Hrgift = Gift::where('id', $hrinvestments->giftId)->value('name');
        // return  $Hrgift;

        return view('pages.investment.editinvestment', compact('hrinvestments', 'Hrgift','hrId'));
        // $hrId = $id;
        // $hrinvestments = Investment::find($id)->delete();
        // return  $hrinvestments;
            
        // $hrpricesum = Investment::where('hrId', $hrId)->sum('price');
        // return redirect()->back();
    }
    public function updateInvestment(request $request, $id)
    {
        
        $hrinvestments = Investment::find($id);
        // return $hrinvestments;
        $hrinvestments->remark= $request->remark;
        $hrinvestments->update();
            
        return redirect('show-investment/'.$hrinvestments->hrId)->with('success','Gift details updated successfully..');;
        // return redirect()->back();
    }


    public function hrConsolidate()
    {
        $hrs = Hr::with('clientName')->where('software_category', Auth::user()->software_category ?? 'onrole')->get();
        $hrinvestments = Investment::with('HrWithClient')->where('software_category', Auth::user()->software_category ?? 'onrole')->get();
        
        return view('pages.investment.hrConsolidate', compact('hrs', 'hrinvestments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
