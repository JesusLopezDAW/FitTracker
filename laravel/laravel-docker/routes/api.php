<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function (){
    Route::post('/log', 'login')->name('log');
    Route::post('/reg', 'register')->name('reg');
});
