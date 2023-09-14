<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input("todo");
        $todolist = $this->todolistService->getAll();

        if (empty($todo)) {
            return response()
                ->view("todolist", [
                    "title" => "Todolist",
                    "error" => "Todolist cannot be empty!",
                    "todolist" => $todolist,
                ]);
        } else {
            $this->todolistService->save($todo);
            return redirect()->route("home");
        }
    }

    public function removeTodo(Request $request)
    {
        $id = $request->input("id");

        DB::table('todolist')->where("id", "=", $id)->delete();

        return redirect()->route("home");
    }
}
