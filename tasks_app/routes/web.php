<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TodoController;

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'todos');

// Posts Routes
Route::resource('todos', TodoController::class);

// User Posts Route
Route::get('/{user}/todos', [DashboardController::class, 'userTodos'])->name('todos.user');


// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // User Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    // routes/web.php

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // routes/web.php
    //Route::get('search', [TodoController::class, 'search'])->name('search');

    Route::get("profil", [AuthController::class, "profil"])->name("profil");
    Route::post("profil", [AuthController::class, "profil"])->name("profil");

    Route::post('/delete-account', [AuthController::class, 'destroyUser'])->name('delete-account');

  
    //Route::post('/email/verification-notification', [AuthController::class, 'verifyEmailResend'])->middleware('throttle:6,1')->name('verification.send');
});

// Routes for guest users
Route::middleware('guest')->group(function () {
    // Register Routes
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login Routes
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
   
   
    
});
