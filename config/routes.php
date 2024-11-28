<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use Core\Router\Route;

// Authentication
Route::get('/login', [AuthController::class, 'index'])->name('users.login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::get('/logout', [AuthController::class, 'destroy']);


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('root');
    
});