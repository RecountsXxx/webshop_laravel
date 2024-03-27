<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
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
    Route::post('categories/{category}', [\App\Http\Controllers\Category\CategoryController::class, 'update']);

    Route::apiResource('brands',\App\Http\Controllers\Brand\BrandController::class);
    Route::post('brands/{brand}', [\App\Http\Controllers\Brand\BrandController::class, 'update']);

    Route::apiResource('vendors',\App\Http\Controllers\Vendor\VendorController::class);
    Route::post('vendors/{vendor}', [\App\Http\Controllers\Vendor\VendorController::class, 'update']);

    Route::apiResource('users',\App\Http\Controllers\User\UserController::class);
    Route::apiResource('admins',\App\Http\Controllers\Admin\AdminController::class);
    Route::apiResource('vendor-users', \App\Http\Controllers\Vendor\VendorUser\VendorUserController::class);

    Route::apiResource('orders', \App\Http\Controllers\Product\Order\OrderController::class)->except(['store','update','show']);

    Route::apiResource( 'posts',\App\Http\Controllers\Post\PostController::class);
    Route::post('posts/{post}', [\App\Http\Controllers\Post\PostController::class, 'update']);

    Route::apiResource('join-to-vendors', \App\Http\Controllers\Vendor\JoinToVendors\JoinToVendorsController::class)->except(['store','update','show']);
    Route::get('/add-to-vendors/{id}',[\App\Http\Controllers\Vendor\JoinToVendors\JoinToVendorsController::class,'addToVendors']);

    Route::get('/dashboard',DashboardController::class);
});

