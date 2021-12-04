<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OnlineChart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function userList(Request $request) {
        $users = User::select(["id", "username", "look", "motto"])->orderBy("id", "desc")->limit(10)->get();
        $response = [
            "users" => $users
        ];
        return response()->json($response);
    }
     public function banList(Request $request) {
        $bans = DB::select("select b.id, b.*, u.username from bans b inner join users u on u.id = b.user_id GROUP BY u.username ORDER BY b.id DESC LIMIT 10");
        foreach($bans as $ban) {
            $staff = DB::select("select username from users where id = ?", [$ban->user_staff_id])[0]->username;
            $ban->staff_username = $staff;
            $ban->timestamp = date("d-m-Y H:s:i", $ban->timestamp);
            $ban->ban_expire = date("d-m-Y H:s:i", $ban->ban_expire);
        }
        $response = [
            "bans" => $bans
        ];
        return response()->json($response);
    }
    public function onlineChart(Request $request) {
        $datas = OnlineChart::orderBy("timestamp", "asc")->limit(10)->get();
        $response = [];
        $response['labels'] = [];
        $response['data'] = [];

        foreach($datas as $data) {
            array_push($response['labels'], date("H:s:i", $data->timestamp));
            array_push($response['data'], $data->online_count);
        }
        return response()->json($response);
    }
}
