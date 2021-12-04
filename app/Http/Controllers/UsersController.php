<?php

namespace App\Http\Controllers;

use App\Models\HkLogs;
use App\Models\HkPermissions;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function detailedSearch(Request $request) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "detailed_user_search") == true) {
            return view("user.detailed-search", ["currentUser" => $user]);
        } else{
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'detailed search' function without permission.");
            return view("access_denied", ["currentUser" => $user]);
        }
    }
}
