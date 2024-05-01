<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Cambiar
Route::get('/users', [UserController::class, 'listUsers'])->middleware(['auth', 'verified'])->name('users');

Route::get('/users/{userName}', function () {
    return view('admin.user-details');
})->name('user-details');

Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas AdminLTE
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile','destroy')->name('profile.destroy');
    });

    Route::resource("/user", UserController::class);
    Route::resource("/food", FoodController::class);
    Route::resource("/exercise", FoodController::class);
});

require __DIR__ . '/auth.php';

// Listar -> Index (GET)
// Insertar -> Store (POST)
// Listar usuario especifico -> Show (GET): /user/{user} 
// Update (PUT/PATCH): /user/{user} - Esta ruta actualiza un usuario existente en la base de datos. También podría ser /user/{user}/edit.
// Destroy (DELETE): /user/{user} - Esta ruta elimina un usuario de la base de datos.


// Route::get('/user/{userName}', [UserController::class, 'userDetails']);
