<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

Route::post('/send-message', [OrderController::class, 'sendMessage'])->name('send-message');
