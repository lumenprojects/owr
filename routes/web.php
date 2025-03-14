<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use Illuminate\Http\Request;

// Главная страница
Route::get('/', function () {
    return view('home');
});

// Маршрут для случайного выбора персонажа по роли
Route::get('/character/random', [CharacterController::class, 'randomByRole']);
