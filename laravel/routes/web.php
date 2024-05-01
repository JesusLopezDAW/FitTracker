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

// Rutas AdminLTE
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserController::class, 'listUsers'])->middleware(['auth', 'verified'])->name('users');

Route::get('/users/{userName}', function () {
    return view('admin.user-details');
})->middleware(['auth', 'verified'])->name('user-details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Listar -> Index (GET)
// Insertar -> Store (POST)
// Listar usuario especifico -> Show (GET): /user/{user} 
// Update (PUT/PATCH): /user/{user} - Esta ruta actualiza un usuario existente en la base de datos. También podría ser /user/{user}/edit.
// Destroy (DELETE): /user/{user} - Esta ruta elimina un usuario de la base de datos.
Route::resource("/user",UserController::class);
Route::resource("/food",FoodController::class);
Route::resource("/exercise",ExerciseController::class);

// Route::get('/user/{userName}', [UserController::class, 'userDetails']);
