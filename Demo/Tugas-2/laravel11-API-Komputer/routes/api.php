<?php

use Illuminate\Auth\Middleware\Authenticate; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/products', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/customers', App\Http\Controllers\Api\CustomerController::class);

// Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class); 
