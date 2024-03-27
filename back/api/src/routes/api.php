<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostOperations\AddLikePostController;
use App\Http\Controllers\Post\PostOperations\AddViewPostController;
use App\Http\Controllers\Product\Comment\CommentController;
use App\Http\Controllers\Product\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Vendor\JoinToVendors\JoinToVendorsController;
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

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::post('filter/products', [ProductController::class,'filteredProducts']);
Route::apiResource('comments', CommentController::class)->only(['store', 'show']);

Route::apiResource('brands', BrandController::class)->only(['index', 'show']);
Route::get('/brand/products/{id}', [BrandController::class, 'get_products_on_brand']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::get('/category/products/{id}', [CategoryController::class, 'get_products_on_category']);

Route::apiResource('vendors', VendorController::class)->only(['index', 'show']);
Route::get('/vendor/products/{id}', [VendorController::class, 'get_products_on_vendor']);

Route::apiResource('posts', PostController::class)->only(['index', 'show']);
Route::post('posts/add_view', AddViewPostController::class);
Route::middleware('check.auth.jwt')->group(function () {
    Route::post('/posts/add_like', AddLikePostController::class);
});

Route::post('/make-order', OrderController::class);

Route::post('/join-to-vendors', JoinToVendorsController::class);
