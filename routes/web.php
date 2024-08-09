<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// JSON
Route::get('/todo', [\App\Http\Controllers\TodoController::class, 'getTodoList']);
route::get('/todo/{completed}', [\App\Http\Controllers\TodoController::class, 'getTodoBy']);

// BLADE
route::get('/view', [\App\Http\Controllers\TodoController::class, 'viewTodoList']);
route::get('/view/{completed}', [\App\Http\Controllers\TodoController::class, 'viewTodoBy']);
route::get('/view/list/{list}', [\App\Http\Controllers\TodoController::class, 'viewTodoByList']);
