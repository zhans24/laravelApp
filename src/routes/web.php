<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    // Categories
    Route::post('/categories', [CategoryController::class, 'store']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{code}', [ProductController::class, 'showWithReviews']);
    Route::post('/products/{code}/reviews', [ProductController::class, 'storeReview']);
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/');
