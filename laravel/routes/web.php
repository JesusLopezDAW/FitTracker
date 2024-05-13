<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseSuggestionController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodSuggestionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use App\Models\Exercise;
use App\Models\Like;
use App\Models\Post;
use App\Models\Routine;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Inicio
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Rutas AdminLTE
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Perfil
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Recursos
    Route::resource("/user", UserController::class);
    Route::get('/api/users_registered_per_day', [UserController::class, 'getUsersRegisteredPerDay']);
    Route::get('/api/users_registered_per_month', [UserController::class, 'getUsersRegisteredPerMonth']);
    Route::get('/api/users_registered_per_year', [UserController::class, 'getUsersRegisteredPerYear']);

    Route::resource("/food", FoodController::class);
    Route::resource("/exercise", ExerciseController::class);
    Route::resource('/likes', LikeController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/routines', RoutineController::class);

    // Sugerencias
    Route::prefix('suggestion')->group(function () {
        Route::resource('/exercise', ExerciseSuggestionController::class);
        Route::resource('/food', FoodSuggestionController::class);
    });

    Route::get('exercise/getExercisesByPeriod/{period}', [ExerciseController::class, 'getExercisesByPeriod']);
    Route::get('user/getUsersByPeriod/{period}', [UserController::class, 'getUsersByPeriod']);
    Route::get('food/getFoodsByPeriod/{period}', [FoodController::class, 'getFoodsByPeriod']);
    Route::get('like/getLikesByPeriod/{period}', [LikeController::class, 'getLikesByPeriod']);
    Route::get('post/getPostsByPeriod/{period}', [PostController::class, 'getPostsByPeriod']);
    Route::get('comment/getCommentsByPeriod/{period}', [CommentController::class, 'getCommentsByPeriod']);
    Route::get('routine/getRoutinesByPeriod/{period}', [RoutineController::class, 'getRoutinesByPeriod']);

});

require __DIR__ . '/auth.php';