<?php

use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(ApiUserController::class)->group(function (){
    Route::post('/login', 'login')->name('api.login');
    Route::post('/register', 'register')->name('api.register');
});