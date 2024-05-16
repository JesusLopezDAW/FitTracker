<?php

use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [ApiUserController::class, 'register'])->name('api.register');

Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por el middleware auth:api
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::resource("/user", ApiUserController::class);
    // Route::resource("/food", FoodController::class);
    // Route::resource("/exercise", ExerciseController::class);
    // Route::resource('/likes', LikeController::class);
    // Route::resource('/posts', PostController::class);
    // Route::resource('/routines', RoutineController::class);
});
