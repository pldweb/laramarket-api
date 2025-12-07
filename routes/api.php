<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\StoreBalanceController;
use App\Http\Controllers\StoreBalanceHistoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

// Public Routes
// Store
Route::get('store', [StoreController::class, 'index']);
Route::get('store/all/paginated', [StoreController::class, 'getAllPaginated']);
Route::get('store/username/{slug}', [StoreController::class, 'showBySlug']);
Route::get('store/{store}', [StoreController::class, 'show']);

// Product Category
Route::get('product-category', [\App\Http\Controllers\ProductCategoryController::class, 'index']);
Route::get('product-category/all/paginated', [\App\Http\Controllers\ProductCategoryController::class, 'getAllPaginated']);
Route::get('product-category/slug/{slug}', [\App\Http\Controllers\ProductCategoryController::class, 'showBySlug']);
Route::get('product-category/{product_category}', [\App\Http\Controllers\ProductCategoryController::class, 'show']);

// Product
Route::get('product', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('product/all/paginated', [\App\Http\Controllers\ProductController::class, 'getAllPaginated']);
Route::get('product/slug/{slug}', [\App\Http\Controllers\ProductController::class, 'showBySlug']);
Route::get('product/{product}', [\App\Http\Controllers\ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::apiResource('user', UserController::class);
    Route::get('user/all/paginated', [UserController::class, 'getAllPaginated']);

    // Store Management
    Route::post('store', [StoreController::class, 'store']);
    Route::put('store/{store}', [StoreController::class, 'update']);
    Route::delete('store/{store}', [StoreController::class, 'destroy']);
    Route::post('store/{id}/verified', [StoreController::class, 'updateVerifiedStatus']);

    Route::apiResource('store-balance-history', StoreBalanceHistoryController::class);
    Route::get('store-balance-history/all/paginated', [StoreBalanceHistoryController::class, 'getAllPaginated']);

    Route::apiResource('store-balance', StoreBalanceController::class)->except(['store', 'update', 'destroy']);
    Route::get('store-balance/all/paginated', [StoreBalanceController::class, 'getAllPaginated']);

    Route::apiResource('withdrawal', \App\Http\Controllers\WithdrawalController::class)->except(['store', 'update', 'destroy']);
    Route::get('withdrawal/all/paginated', [\App\Http\Controllers\WithdrawalController::class, 'getAllPaginated']);
    Route::post('withdrawal/{id}/approve', [\App\Models\Withdrawal::class, 'approve']);

    Route::apiResource('buyer', \App\Http\Controllers\BuyerController::class);
    Route::get('buyer/all/paginated', [\App\Http\Controllers\BuyerController::class, 'getAllPaginated']);

    // Product Category Management
    Route::post('product-category', [\App\Http\Controllers\ProductCategoryController::class, 'store']);
    Route::put('product-category/{product_category}', [\App\Http\Controllers\ProductCategoryController::class, 'update']);
    Route::delete('product-category/{product_category}', [\App\Http\Controllers\ProductCategoryController::class, 'destroy']);

    // Product Management
    Route::post('product', [\App\Http\Controllers\ProductController::class, 'store']);
    Route::put('product/{product}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('product/{product}', [\App\Http\Controllers\ProductController::class, 'destroy']);

    Route::apiResource('transaction', \App\Http\Controllers\TransactionController::class);
    Route::get('transaction/all/paginated', [\App\Http\Controllers\TransactionController::class, 'getAllPaginated']);
    Route::get('transaction/code/{code}', [\App\Http\Controllers\TransactionController::class, 'showByCode']);

    Route::post('product-review', [ProductReviewController::class, 'store']);
});
