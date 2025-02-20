<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;





Route::get('/', [WelcomeController::class, 'index']);



Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

Route::resource('categories', CategoryController::class);
