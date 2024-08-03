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

    public function updateTodo(int $id, Request $request)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => 'Invalid Todo ID',
                'success' => false
            ], 400);
        }

        $todo->completed = $request->completed ?? $todo->completed;

        if ($todo->save()) {
            return response()->json([
                'message' => 'Car updated',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

}
