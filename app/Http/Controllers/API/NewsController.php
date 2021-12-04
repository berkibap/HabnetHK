<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HkPermissions;
use App\Models\User;
use App\Models\HkLogs;
use App\Models\News;

class NewsController extends Controller
{
    public function get(Request $request) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "news_list") == true) {
           $news = News::orderByDesc("id")->get();
           $a = [];
           foreach($news as $item) {
               $item->staff_username = User::where('id', $item->author)->first()->username;
               $a[] = $item;
           }
           HkLogs::logAction($user->id, "news_list", $request->ip(), false, 0, "User accessed news list API successfully.");
           return response()->json([
               "count"=> $news->count(),
               "list" => $a
           ]);
        } else{
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'news list' api function without permission.");
            return response()->json([
                "count" => 0,
                "list"=> [],
                "error" => "Access Denied"
            ]);
        }
    }
    public function delete(Request $request, $id) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "news_delete") == true) {
         $article = News::where('id', $id);
         if($article->count() > 0) {
            $article->delete();
            HkLogs::logAction($user->id, "news_list", $request->ip(), false, 0, "User deleted article ID: $id");
            return response()->json([
                "msg" => "ok"
            ]);
         } else {
            return response()->json([
                "msg" => "nok",
                "error" => "not_found"
            ]);
         }
        } else{
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'delete news' api function without permission.");
            return response()->json([
                "msg" => "nok",
                "error" => "access_denied"
            ]);
        }
    }

    public function newarticle(Request $request) {
        $user = User::where('id', $request->session()->get('user_id'))->first();
        if(HkPermissions::checkPermission($user->rank, "new_article") == true) {
            $title = $request->input('title');
            $shortstory = $request->input('shortstory');
            $image = $request->input('image');
            $longstory = $request->input('longstory');
           
            $article = new News();
            $article->title = $title;
            $article->image = $image;
            $article->shortstory = $shortstory;
            $article->longstory = $longstory;
            $article->author = $user->id;
            $article->date = time();
            
            $article->save();
            HkLogs::logAction($user->id, "new_article", $request->ip(), false, 0, "User created a new article with ID $article->id.");
            return response()->json([
                "msg" => "ok"
            ]);
        } else {
            HkLogs::logAction($user->id, "access_denied", $request->ip(), true, 0, "User tried to access 'new article' api function without permission.");
            return response()->json([
                "msg" => "nok",
                "error" => "access_denied"
            ]);
        }
       
    }
}
