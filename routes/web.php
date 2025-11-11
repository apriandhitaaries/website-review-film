<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use App\Models\Film;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('casts', CastController::class);
Route::resource('genres', GenreController::class);
Route::resource('films', FilmController::class);
