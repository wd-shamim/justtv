<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TvController;
use App\Http\Controllers\Web\IframeController;
use App\Http\Controllers\Web\DaddyController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TvController::class)->group(function () {
    Route::get('/tv', 'index')->name('tv.index');
    Route::get('/tv/{channel}', 'show')->name('tv.show');
    
    Route::get('/allchannel', 'allchannel')->name('allchannel');
});

Route::controller(DaddyController::class)->group(function () {
    Route::get('/view-live/{channelId}', 'viewlive')->name('viewlive')->where('channelId', '[0-9]+');
});

// iFrame Routes
Route::controller(IframeController::class)->group(function () {
    Route::get('/embed/{channelId}', 'embed')->name('embed')->where('channelId', '[0-9]+');
    Route::get('/player/{channelId}', 'player')->name('player')->where('channelId', '[0-9]+');
});
