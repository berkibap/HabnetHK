<?php

use App\Http\Controllers\API\DashboardController as APIDashboardController;
use App\Http\Controllers\API\NewsController as APINewsController;
use App\Http\Controllers\API\UsersController as APIUsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\LogicalOr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['login'])->group(function () {
   Route::get('/dashboard', [DashboardController::class, "show"])->name("dashboard");
   Route::get('/logout', [DashboardController::class, "logout"])->name("logout");
    Route::get('/users/detailed-search', [UsersController::class, "detailedSearch"]);
    Route::get('/news/list', [NewsController::class, "showList"]);
    Route::get('/news/new-article', [NewsController::class, "showNewArticle"]);

   Route::get("/api/dashboard/user-list",[APIDashboardController::class, "userList"]);
   Route::get("/api/dashboard/ban-list",[APIDashboardController::class, "banList"]);
   Route::get("/api/dashboard/online-chart",[APIDashboardController::class, "onlineChart"]);
   Route::get("/api/user/modal/{id}", function($id) {
       $user = User::where("id", $id)->first();

       return view("modals.user", ["user"=> $user]);
   });
   Route::get("/api/user/search/{username}", [APIUsersController::class, "search"]);
   Route::post("/api/user/{id}", [APIUsersController::class, "save"]);
   Route::get("/api/news/list", [APINewsController::class, "get"]);
   Route::delete("/api/news/delete/{id}", [APINewsController::class, "delete"]);
   Route::post("/api/news/new-article", [APINewsController::class, "newArticle"]);
});
Route::middleware(['guest'])->group(function () {
    Route::get("/", [LoginController::class, "show"])->name("login");
    Route::get("/login", [LoginController::class, "show"])->name("login");
    Route::post("/api/login", [LoginController::class, "login"])->name("doLogin");
    Route::post("/api/set-login", [LoginController::class, "setLogin"]);
});