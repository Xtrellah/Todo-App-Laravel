<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::get('/todo', [\App\Http\Controllers\TodoController::class, 'getTodoList']);
route::get('/todo/{completed}', [\App\Http\Controllers\TodoController::class, 'getTodoBy']);

route::put('/todo/update/{id}', [\App\Http\Controllers\TodoController::class, 'updateTodo']);
