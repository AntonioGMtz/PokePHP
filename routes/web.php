<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokeController;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/', [PokeController::class, 'index']); //Mostrar el index principal de la web
//Route::get('/pokemon/{name?}', [PokeController::class, 'show']); 
Route::get('/', [PokeController::class, 'index'])->name('pokedex');
