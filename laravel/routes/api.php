<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ExerciseController;
use App\Http\Controllers\API\FollowController;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\RoutineController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WorkoutController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por el middleware auth:api
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    // TODO: 
    // Route::resource("/exercise-log", ExerciseController::class);
    // Route::resource("/log", ExerciseController::class);
    // Route::resource("/followers", ExerciseController::class);


    Route::resource("/exercise", ExerciseController::class);

    Route::resource("/food", FoodController::class);

    Route::resource('/posts', PostController::class);

    Route::get('/feed', [PostController::class, 'getInterestingPosts']);
    Route::get('/feed/followed', [PostController::class, 'getFollowedPosts']);

    Route::resource("/workout", WorkoutController::class);
    Route::get("/routine-workout/{id}", [WorkoutController::class, 'getRoutineWorkout']);

    Route::resource('/routines', RoutineController::class);

    Route::get('/likes/{id}', [LikeController::class, 'likesInPost']);
    Route::resource('/likes', LikeController::class);

    Route::get('/comments/{id}', [CommentController::class, 'commentsInPost']);
    Route::resource('/comments', CommentController::class);

    Route::get('/search/user', [UserController::class, 'search']);

    Route::controller(FollowController::class)->group(function (){
        Route::post('/follow/{user}', 'follow')->name('follow');
        Route::post('/unfollow/{user}', 'unfollow')->name('unfollow');
        Route::get('/followers', 'followers');
        Route::get('/following', 'following');
        Route::get('/followers/count', 'followersNumber');
        Route::get('/following/count', 'followingNumber');
    });
    



});
