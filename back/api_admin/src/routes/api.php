<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Report\ReportCommentController;
use App\Http\Controllers\Report\ReportPostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('admin')->group(function (){
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class)->name('auth.login');
        Route::middleware(['check.auth.jwt'])->group(function () {
            Route::post('register', RegisterController::class)->name('auth.register');
            Route::get('logout', LogoutController::class)->name('auth.logout');
        });
    });
});

Route::get("/hello",function (){
   return 'Hello';
});
