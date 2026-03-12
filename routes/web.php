<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TvController;
use App\Http\Controllers\Web\IframeController;
use App\Http\Controllers\Web\DaddyController;
use App\Http\Controllers\Web\StreamProxyController;
use App\Http\Controllers\Web\YoutubeController;
use App\Http\Controllers\Web\YtController;


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

Route::middleware(['web' ])->group(function () {
    Route::controller(DaddyController::class)->group(function () {
        Route::get('/view-live/{channelId}', 'viewlive')->name('viewlive');
        Route::get('/killerplayer/tv', 'embed')->name('killerplayer.tv.embed')->middleware('adblock');
    });
});

Route::get('/proxy/stream/{id}', [StreamProxyController::class, 'stream'])->name('proxy.stream')->where('id', '[0-9]+');
Route::get('/proxy/res', [StreamProxyController::class, 'resource'])->name('proxy.resource');

// Debug tool — remove in production
Route::get('/proxy/debug/{id}', [StreamProxyController::class, 'debug'])->where('id', '[0-9]+');
    

require __DIR__.'/auth.php';


Route::controller(YoutubeController::class)->group(function () {
    Route::get('/killerplayer',       'killer')->name('killerplayer');
    Route::get('/killerplayer/embed', 'embed')->name('killerplayer.embed');
});


Route::controller(YtController::class)->group(function () {
    // The "Engine" Route (The page inside the iframe)
    Route::get('yt/player/{id}',  'player')->name('player');
    
    // The Demo Page
    Route::get('yt/killerplayer', 'killer')->name('killerplayer');
});