<?php

namespace App\Http\Controllers;

use App\Models\HkLogs;
use App\Models\Sessions;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        return view("guest.login");
    }
    public function setLogin(Request $request) {
        $username = $request->input('username');
        $user = User::where("username", $username)->first();
        $session = Sessions::where("user_id", $user->id)->first();
        if(!$session) {
            //create it
            $newS = new Sessions();
            $newS->user_id = $user->id;
            $newS->ip_address = $request->ip();
            $newS->login_time = time();
            $newS->logout_time = 0;
            $newS->save();
        } else {
            $session->ip_address = $request->ip();
            $session->save();
        }
        $request->session()->put("admin_login", true);
        $request->session()->put("user_id", $user->id);

        return response("ok");
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input("password");

        $user = User::where("username", $username)->first();
        $response = [];
        if ($user) {
            if (password_verify($password, $user->password)) {
                $minRank = Settings::where("key", "min_rank")->first()->value;
                if ($user->rank >= $minRank) {
                    $session = Sessions::where("user_id", $user->id)->first();
                    if ($session && $session->ip_address == $request->ip()) {
                        // valid login
                        $request->session()->put("admin_login", true);
                        $request->session()->put("user_id", $user->id);

                        $response["msg"] = "ok";
                        $insertSession = new Sessions;
                        $insertSession->user_id = $user->id;
                        $insertSession->ip_address = $request->ip();
                        $insertSession->login_time = time();
                        $insertSession->logout_time = 0;
                        $insertSession->save();
                        HkLogs::logAction($user->id, "login", $request->ip(), false, $user->id);
                        return response()->json($response);
                    } else {
                        $response["msg"] = "validate_on_discord";
                        $response['username'] = $username;
                        HkLogs::logAction($user->id, "login", $request->ip(), true, $user->id, "User was prompted to verify on Discord.");
                        return response()->json($response);

                    }
                } else {
                    HkLogs::logAction($user->id, "login", $request->ip(), true, $user->id, "User has no permission to login.");
                    $response["msg"] = "invalid_rank";
                    return response()->json($response);
                }
            } else {
                HkLogs::logAction($user->id, "login", $request->ip(), false, $user->id, "User tried to log in with an invalid password.");
                $response["msg"] = "invalid_pass";
                return response()->json($response);
            }
        } else {
            HkLogs::logAction(0, "login", $request->ip(), false, 0, "User was not found. Data given was: \"". $username . "\"");
            $response['msg'] = "user_not_found";
            return response()->json($response);
        }
    }
}
