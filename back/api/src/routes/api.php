<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Brand\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->name('auth.register');
    Route::post('login', LoginController::class)->name('auth.login');

    Route::middleware(['check.auth.jwt'])->group(function () {
        Route::get('logout', LogoutController::class)->name('auth.logout');
    });
});

Route::apiResource('products',ProductController::class)->except(['destroy','store','update']);

Route::apiResource('brands',BrandController::class)->except(['destroy','store','update']);
Route::get('/brand/products',[BrandController::class,'get_products_on_brand']);

Route::apiResource('categories',CategoryController::class)->except(['destroy','store','update']);
Route::get('/category/products',[CategoryController::class,'get_products_on_category']);

Route::apiResource('vendors',VendorController::class)->except(['destroy','store','update']);
Route::get('/vendor/products',[VendorController::class,'get_products_on_vendor']);
