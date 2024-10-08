<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
Route::get('/properties', [\App\Http\Controllers\PropertyController::class, 'index']);