<?php

use App\Controllers\AuthController;
use App\Controllers\ClientTableController;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use App\Controllers\TableController;
use App\Controllers\UsersController;
use App\Controllers\ProfileController;
use Core\Router\Route;

// Authentication
Route::get('/login', [AuthController::class, 'index'])->name('users.login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::get('/logout', [AuthController::class, 'destroy'])->name('users.logout');

// Admin routes
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('root');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::put('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.remove');

    // profile
    Route::get('/profile', [UsersController::class, 'profile'])->name('users.profile');

    // Users crud
    Route::get('/users/new', [UsersController::class, 'new'])->name('users.new');
    Route::post('/users/create', [UsersController::class, 'create'])->name('users.create');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/page', [UsersController::class, 'index'])->name('users.paginate');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');

    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Tables  crud
    Route::get('/tables/new', [TableController::class, 'new'])->name('tables.new');
    Route::post('/tables/create', [TableController::class, 'create'])->name('tables.create');

    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::get('/tables/page', [TableController::class, 'index'])->name('tables.paginate');

    Route::get('/tables/{id}/edit', [TableController::class, 'edit'])->name('tables.edit');
    Route::put('/tables/{id}', [TableController::class, 'update'])->name('tables.update');

    Route::delete('/tables/{id}', [TableController::class, 'destroy'])->name('tables.destroy');
});

// Client routes
Route::middleware('valid-table')->group(function () {
    Route::get('/table/{table_number}', [ClientTableController::class, 'index'])->name('client.index');

    // Orders crud
    Route::get('/table/{table_number}/orders', [OrderController::class, 'index'])->name('table.orders.paginate');
    Route::post('/table/{table_number}/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/table/{table_number}/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});
