<?php
use Illuminate\Support\Facades\Route;

Route::prefix('user')->middleware('auth:web')->group(function () {
    Route::get('/profile', function () {
        return 'User Profile';
    })->name('user.profile');
});