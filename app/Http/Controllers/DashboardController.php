<?php

namespace App\Http\Controllers;

use App\Models\HkLogs;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request) {
        $user = User::where("id",$request->session()->get("user_id"))->first();
        return view("dashboard.dashboard",["currentUser" => $user]);
    }
    public function logout(Request $request) {
        HkLogs::logAction($request->session()->get("user_id"), "logout", $request->ip(), true, 0, "User logged out.");
        $sess = Sessions::where('user_id', $request->session()->get('user_id'))->first();
        if($sess) {
              $sess->logout_time = time();
        $sess->save();
        }
      
        $request->session()->flush();
        
        return redirect('/');
    }
}
