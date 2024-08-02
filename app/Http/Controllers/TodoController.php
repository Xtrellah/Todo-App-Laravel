<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function getTodoList()
    {
        $list = Todo::all();
        return $list;
    }

    public function getTodoBy(int $completed)
    {
        if ($completed > 0) {
            $todos = Todo::where('completed', '>', 0)->get();
        }
        else {
            $todos = Todo::where('completed', 0)->get();
        }
        return $todos;
    }

}
