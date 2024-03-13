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
    Route::apiResource('products',\App\Http\Controllers\Product\ProductController::class);
    Route::delete('/products/delete-image/{id}',[\App\Http\Controllers\Product\ProductController::class,'delete_image']);
    Route::post('/products/add-image',[\App\Http\Controllers\Product\ProductController::class,'add_image']);

    Route::apiResource('categories',\App\Http\Controllers\Category\CategoryController::class);
    Route::apiResource('vendors',\App\Http\Controllers\Vendor\VendorController::class);
    Route::apiResource('brands',\App\Http\Controllers\Brand\BrandController::class);
});

