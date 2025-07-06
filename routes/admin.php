<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    // Admin Dashboard and Profile routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});