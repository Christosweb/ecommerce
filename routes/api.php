<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//get all products
Route::get('/product/v1', [ProductController::class, 'index']);
//get single product
Route::get('/product/v1/{id}', [ProductController::class, 'show']);
//store product
Route::post('/product/v1', [ProductController::class, 'store']);
//update a product
Route::put('/product/v1/{id}/update', [ProductController::class, 'update']);
//delete a product
Route::delete('/product/v1/{id}/delete', [ProductController::class, 'destroy']);
