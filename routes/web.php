<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::resource('casts', CastController::class);
        Route::resource('genres', GenreController::class);
        Route::resource('films', FilmController::class);
    });
});

require __DIR__ . '/auth.php';
