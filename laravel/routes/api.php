<?php

use App\Http\Controllers\Api\ApiUserController;
use Illuminate\Routing\Route;

Route::controller(ApiUserController::class)->group(function (){
    Route::post('/login', 'login')->name('api.login');
    Route::post('/register', 'register')->name('api.register');
});