<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('home');
});

Route::post('/send-message', [OrderController::class, 'sendMessage'])->name('send-message');

Route::resource('portfolios', PortfolioController::class);
Route::resource('products', ProductController::class);
Route::resource('services', ServiceController::class);


