<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\Comment\CommentController;
use App\Http\Controllers\Product\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Vendor\RequestForTheVendors\RequestForTheVendorsController;
use App\Http\Controllers\Vendor\VendorController;
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

// Products
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::post('filter/products', [ProductController::class,'filteredProducts']);
Route::apiResource('comments', CommentController::class)->only(['store', 'show']);
// Brands
Route::apiResource('brands', BrandController::class)->only(['index', 'show']);
Route::get('/brand/products/{id}', [BrandController::class, 'get_products_on_brand']);

// Categories
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::get('/category/products/{id}', [CategoryController::class, 'get_products_on_category']);

// Vendors
Route::apiResource('vendors', VendorController::class)->only(['index', 'show']);
Route::get('/vendor/products/{id}', [VendorController::class, 'get_products_on_vendor']);

// Order
Route::post('/make-order', OrderController::class);

// Vendor Requests
Route::post('/join-to-vendors', RequestForTheVendorsController::class);
