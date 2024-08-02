<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'getTodoList']);
route::get('/todo/{completed}', [\App\Http\Controllers\TodoController::class, 'getTodoBy']);
