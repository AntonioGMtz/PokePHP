<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon/{name?}', [PokeController::class, 'show']);

