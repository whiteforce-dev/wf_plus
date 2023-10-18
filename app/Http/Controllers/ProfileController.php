<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  public function profileSetting(Request $request, $id)
  {
    $Details = User::find($id);
    return view('profile_setting.profileSetting')->with(['Details' => $Details]);
  }
  public function updateProfile(Request $request, $id)
  {
    // return $request;

    // $id = $request->id;
    $details = User::find($id);
    $details->name = $request->name;
    $details->email = $request->email;
    $details->contact = $request->contact;
    if ($request->hasFile('profile_image')) {
      $image = $request->file('profile_image');
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = 'profile_image/';
      $path = $image->move($destinationPath, $name);
      $details->profile_image = $path;
    }

    $details->save();

    // return $details;

    return back()->with('success', 'Profile has been updated..');
    //
  }

  public function ChangePassword(Request $request)
  {
    $id = $request->id;
    $Details = User::find($id);
    // return $Details;
    return view('profile_setting.changepassword')->with(['Details' => $Details]);
  }
  public function UpdatePassword(Request $request, $id)
  {
  
    $id = Auth::user()->id;

    $newPassword = $request->new_password;
    User::where('id', $id)->update([
      'password' => Hash::make($newPassword)
    ]);

    return back()->with("success", "Password changed successfully!");






    // $details = User::find($id);
    //     $details->password=  Hash::make($request->password);
    //     $details->save();
    //     // return $details->password;
    //     return back()->with('success','Password has been updated..');

  }
}
