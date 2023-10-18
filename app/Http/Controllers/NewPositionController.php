<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Position;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewPositionController extends Controller
{
    public function positionList(Request $request)
    {
        $Positions = Position::where(['is_active'=>'1','software_category'=>(Auth::user()->software_category ?? 'onrole')])->orderBy('id', 'DESC');
        if (Auth::user()->role !== "admin") {
            $user = User::find(Auth::user()->id);
            $ascendantIds = $user->ascendantIds();
            $Positions = $Positions->whereIn('created_by', $ascendantIds);
        }
        $Positions = $Positions->paginate('25');
        return view('pages.position.PositionList', compact('Positions'));
        
    }

}