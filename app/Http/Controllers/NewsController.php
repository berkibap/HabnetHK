<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HkPermissions;
use App\Models\User;
use App\Models\HkLogs;

class NewsController extends Controller
{
    public function showList(Request $request) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "news_list") == true) {
            return view("news.list", ["currentUser" => $user]);
        } else{
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'news list' page without permission.");
            return view("access_denied", ["currentUser" => $user]);
        }
    }
    public function showNewArticle(Request $request) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "new_article") == true) {
            return view("news.new_article", ["currentUser" => $user]);
        } else{
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'news list' page without permission.");
            return view("access_denied", ["currentUser" => $user]);
        }
    }
}
