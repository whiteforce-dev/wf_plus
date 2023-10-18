<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function loginAsUser($userId)
    {
        // Store the admin session data
        $adminSession = Auth::user()->id;
        Session::put('admin_session', $adminSession);
     

        // Log out the admin
        Auth::logout();

        // Log in as the selected user
        $user = User::findOrFail($userId);
        Auth::login($user);

        // Redirect to the user's dashboard or any desired page
        return redirect('welcome');
    }

    public function backToAdmin()
    {
        // Log out the user
        Auth::logout();
        $user = User::findOrFail(session('admin_session'));
        Auth::login($user);
        session()->forget('admin_session');
        return redirect('welcome');
        // return redirect('dashboard');
    }
}
