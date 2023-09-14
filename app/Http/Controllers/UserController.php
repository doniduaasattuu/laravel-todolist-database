<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TodolistService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;
    private TodolistService $todolistService;

    public function __construct(UserService $userService, TodolistService $todolistService)
    {
        $this->userService = $userService;
        $this->todolistService = $todolistService;
    }

    public function home()
    {
        $todolist = $this->todolistService->getAll();

        return response()->view("todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function login()
    {
        return view("login", [
            "title" => "Login"
        ]);
    }

    public function doLogin(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        if (!isset($username) || !isset($password)) {
            return response()->view("login", [
                "title" => "Login",
                "error" => "Username and password is required"
            ]);
        }

        $clientRequest = $this->userService->login($username, $password);

        if ($clientRequest) {
            $request->session()->put("username", $username);
            return redirect("/");
        } else {
            return response()->view("login", [
                "title" => "Login",
                "error" => "Username or password is wrong"
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget("username");
        return redirect("/");
    }
}
