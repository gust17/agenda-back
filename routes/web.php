<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('criar-registro', function () {
    return view('register');
});



Route::post('/register', [RegisterController::class, 'register'])->name('register');
