<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/', function () {
    return view('home');
});

Route::get('/character/random', [CharacterController::class, 'randomByRole']);
