<?php

namespace App\Http\Controllers;

use App\Services\BoolConverter;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function getTodoList()
    {
        $todos = Todo::all();

        return $todos;
    }

    public function viewTodoList()
    {
        $todos = Todo::all();

        foreach ($todos as $todo) {
            $todo->completed = BoolConverter::StatusConverter($todo->completed);
        }

        return view('TodoList', ['title'=>'To Do List', 'todos'=>$todos]);
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

    public function viewTodoBy(int $completed)
    {
        if ($completed > 0) {
            $todos = Todo::where('completed', '>', 0)->get();
            $title = "Complete To Do's";
        }
        else {
            $todos = Todo::where('completed', 0)->get();
            $title = "Incomplete To Do's";
        }
        return view('TodoList', ['title'=>$title, 'todos'=>$todos]);
    }

    public function getTodoByList(int $list)
    {
        $todos = Todo::where('folder', '=', $list)->get();

        return $todos;
    }

    public function viewTodoByList(int $list)
    {
        $todos = Todo::where('folder', '=', $list)->get();

        return view('TodoList', ['title'=>'To Do List', 'todos'=>$todos]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:20',
            'description' => 'required|string|min:1|max:100',
            'folder' => 'required|numeric|min:1|max:99'
        ]);

        $todo = new Todo();

        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->folder = $request->folder;

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

        $todo->name = $request->name ?? $todo->name;
        $todo->description = $request->description ?? $todo->description;;
        $todo->completed = $request->completed ?? $todo->completed;;
        $todo->folder = $request->folder ?? $todo->folder;;


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
