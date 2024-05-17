<?php

use App\Http\Controllers\API\ExerciseController;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por el middleware auth:api
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // TODO 
    // Route::resource('/likes', LikeController::class);
    // Route::resource('/posts', PostController::class);
    // Route::resource('/routines', RoutineController::class);

    Route::resource("/exercise", ExerciseController::class);
    Route::resource("/food", FoodController::class);

});
