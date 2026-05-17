<?php

use App\Http\Controllers\Api\PokemonController;
use App\Http\Controllers\Api\GenerationController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('pokemon', [PokemonController::class, 'index']);
Route::get('/pokemon/{id}', [PokemonController::class, 'show']);


Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{id}', [TypeController::class, 'show']);


Route::get('/generations', [GenerationController::class, 'index']);
Route::get('/generations/{id}', [GenerationController::class, 'show']);

