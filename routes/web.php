<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('clients', App\Http\Controllers\ClientController::class);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
