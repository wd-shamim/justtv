<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TvController;
use App\Http\Controllers\Web\IframeController;
use App\Http\Controllers\Web\DaddyController;
use App\Http\Controllers\Web\StreamProxyController;


Route::view('/home', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::get('/', function () {
    return view('web.welcome');
});

Route::controller(TvController::class)->group(function () {
    Route::get('/tv', 'index')->name('tv.index');
    Route::get('/tv/{channel}', 'show')->name('tv.show');

    Route::get('/allchannel', 'allchannel')->name('allchannel');
});

Route::middleware(['web'])->group(function () {
    Route::controller(DaddyController::class)->group(function () {
        Route::get('/view-live/{channelId}', 'viewlive')->name('viewlive');
    });
});

require __DIR__.'/auth.php';
