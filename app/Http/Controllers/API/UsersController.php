<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HkLogs;
use App\Models\HkPermissions;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function search(Request $request, $data) {
        $users = User::where("username", "like", "%" . $data . "%")->orWhere("id", $data)->get(['id', 'username', 'look']);
        $response = [];
        $response['aa'] = $users;
        if($users->count() < 1 ) {
            $response['count'] = 0;
            return response()->json($response);
        }
        $response['users'] = [];
        $response['count'] = $users->count();
        foreach($users as $user) {
            array_push($response['users'], $user);
        }
        HkLogs::logAction($request->session()->get("user_id"),"search_user", $request->ip(), false, 0, "User used 'search user' function with data: '$data'");
        return response()->json($response);
    }
    public function save(Request $request, $id) {
        $user = User::where("id", $id)->orWhere('username', $id)->first();
        $response = [];
        if(!$user) {
            $response['msg'] = 'user_not_found';
            return response()->json($response);
            HkLogs::logAction($request->input('staffId'), "edit_user", $request->ip(), true, $user->id);
        }
        $staff = User::where("id",$request->input('staffId'))->first();
        if(!$staff) {
            $response['msg'] = 'unknown_error';
            return response()->json($response);
            HkLogs::logAction($staff->id, "edit_user", $request->ip(), true, $user->id);
        }
        $check = HkPermissions::checkPermission($staff->rank, "edit_users");
        if($check === true) {
            $user->mail = $request->input('email');
            $user->motto = $request->input('motto');
            $user->save();

            HkLogs::logAction($staff->id, "edit_user", $request->ip(), false, $user->id);
            $response['msg'] = 'ok';
            return response()->json($response);
            
        }
    }
}
