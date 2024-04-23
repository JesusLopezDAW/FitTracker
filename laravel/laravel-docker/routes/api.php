<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function (){
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
});
