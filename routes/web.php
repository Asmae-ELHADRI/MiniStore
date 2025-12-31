<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public routes for guest ordering
Route::get('orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::post('orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');

Route::middleware(['auth'])->group(function () {
    // Authenticated users can list and view orders
    Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');

    Route::middleware(['admin'])->group(function () {
        Route::resource('categories', App\Http\Controllers\CategoryController::class);
        Route::resource('products', App\Http\Controllers\ProductController::class);
        Route::resource('clients', App\Http\Controllers\ClientController::class);
        // Allow admin to manage other order aspects if any (edit, update, destroy)
        Route::resource('orders', App\Http\Controllers\OrderController::class)->except(['index', 'show', 'create', 'store']);
    });
});
