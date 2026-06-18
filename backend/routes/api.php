<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [App\Http\Controllers\Api\TestController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/product')->group(function () {
        Route::post('/create', [ProductController::class, 'createProduct']);
        Route::get('/list', [ProductController::class, 'index']);
        Route::get('/get-product-details/{id}', [ProductController::class, 'getProductById']);
        Route::put('/{id}', [ProductController::class, 'updateProduct']);
    });
});