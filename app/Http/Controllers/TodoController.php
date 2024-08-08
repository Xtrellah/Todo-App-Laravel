<?php

namespace App\Http\Controllers;

use App\Services\BoolConverter;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function viewList()
    {
        $todos = Todo::all();

        foreach ($todos as $todo) {
            $todo->completed = BoolConverter::StatusConverter($todo->completed);
        }

        return view('TodoList', ['title'=>'To Do List', 'todos'=>$todos]);
    }

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

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:20',
            'description' => 'required|string|min:1|max:100',
        ]);

        $todo = new Todo();

        $todo->name = $request->name;
        $todo->description = $request->description;

        if ($todo->save()) {
            return response()->json([
                'message' => 'Todo added',
                'success' => true
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

    public function delete(int $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'message' => 'Invalid Todo ID',
                'success' => false
            ], 400);
        }

        if ($todo->delete()) {
            return response()->json([
                'message' => 'Todo deleted',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
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
                'message' => 'Todo updated',
                'success' => true
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }

}
