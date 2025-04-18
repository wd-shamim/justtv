<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TvController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TvController::class)->group(function () {
    Route::get('/tv', 'index')->name('tv.index');
    Route::get('/tv/{channel}', 'show')->name('tv.show');
});
