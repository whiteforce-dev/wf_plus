<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Gift;
use Illuminate\Http\Request;
use App\Models\Hr;
use App\Models\Investment;
use App\Models\Hrgift;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = User::find(Auth::user()->id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)Auth::user()->id);
        $client_id = Client::whereIn('created_by', $allChilds)->pluck('id')->toArray();
        $hrs = Hr::whereIn('client_id', $client_id)->get();
        return view('pages.investment.hrList', compact('hrs'));
    }

    public function giftDetail($hrId)
    {
        $hrs = Hr::with('clientName')->where('id', $hrId)->first();
        $Hrgift = Gift::get();
        $giftInvestment = DB::table('investments')->where('hrId', $hrId)->orderBy('id','DESC')->get();
        // return $giftInvestment;
        return view('pages.investment.allinvestment', compact('Hrgift', 'hrId', 'hrs', 'giftInvestment'));
    }


    public function saveInvestment(Request $request, $hrId)
    {
        $hr = Hr::find($hrId);
        $Investment = new Investment();
        $Investment->hrId = $hrId;
        $Investment->gift =  $request->gift;
        $Investment->price = $request->price;
        $Investment->remark = $request->remark;
        $Investment->docketnumber = $request->docket;
        $Investment->delivery= $request->delivery;
        $image_code = $request->imageBaseString;
        if (!empty($image_code)) {
            $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$image_code);
            $filepath = time() . '_' . rand() . '.png';
            Storage::disk('s3')->put('gift_images/' . $filepath, base64_decode($image_code), 'public');
            $Investment->image = $filepath;
        }

        $Investment->software_category = $hr->software_category ?? 'onrole';
        $Investment->save();
        return back()->with('success', 'Gift details added successfully..');
    }

    public function editInvestment($investId)
    {
        $Investment = Investment::find($investId);
        $Hrgift = Gift::get();
        if (!empty($Investment->image)) {
            $disk = Storage::disk('s3');
            $Investment->image = $disk->temporaryUrl('gift_images/' . $Investment->image, now()->addMinutes(5));
        }
        return view('pages.investment.editinvestment', compact('Investment', 'Hrgift'));
    }
    public function updateInvestment(request $request, $id)
    {
        $Investment = Investment::find($id);
        $Investment->gift =  $request->gift;
        $Investment->price = $request->price;
        $Investment->remark = $request->remark;
        $Investment->docketnumber = $request->docket;
        $Investment->delivery= $request->delivery;
        $image_code = $request->imageBaseString;
        if (!empty($image_code)) {
            $image_code = preg_replace('#^data:image/\w+;base64,#i', '',$image_code);
            $filepath = time() . '_' . rand() . '.png';
            Storage::disk('s3')->put('gift_images/' . $filepath, base64_decode($image_code), 'public');
            $disk = Storage::disk('s3');
            $disk->delete($Investment->image);
            $Investment->image = $filepath;
        }
        $Investment->save();
        return redirect('gift-details/' . $Investment->hrId)->with('success', 'Gift details updated successfully..');
    }

    public function deleteInvestment($id)
    {
        $hrinvestments = Investment::find($id);
        $disk = Storage::disk('s3');
            $disk->delete($hrinvestments->image);
        $hrinvestments = Investment::find($id)->delete();
        return redirect()->back()->with('success', 'Gift details deleted successfully..');;
    }
    public function hrConsolidate()
    {
        $parent = User::find(Auth::user()->id);
        $allChilds = $parent->descendantIds();
        array_unshift($allChilds, (int)Auth::user()->id);
        $client_id = Client::whereIn('created_by', $allChilds)->pluck('id','name')->toArray();
        // $client_id = ["Etsy"=> 165,'esses'=>31];
        $allInvestment = [];
        $company = [];
        $hrsArray =[];
        foreach ($client_id as $companyName => $i) {
            $hrNames = Hr::where('client_id', $i)->pluck('id', 'name');
            foreach ($hrNames as $name => $value) {
                $allInvestment = Investment::where('hrId', $value)->get();
                $company[$companyName][$name] = $allInvestment;
            }
        }
        // return $company;
        return view('pages.investment.hrConsolidate', compact('company'));
    }
}
