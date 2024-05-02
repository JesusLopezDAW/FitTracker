<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Exercise;
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
        Route::delete('/profile','destroy')->name('profile.destroy');
    });

    // Recursos
    Route::resource("/user", UserController::class);
    Route::resource("/food", FoodController::class);
    Route::resource("/exercise", FoodController::class);
});

require __DIR__ . '/auth.php';
