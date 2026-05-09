<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'welcome')->name('welcome');

    Route::get('/dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/pokemon', PokemonController::class)
    ->middleware(['auth', 'verified']);

Route::resource('/type', TypeController::class)
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
