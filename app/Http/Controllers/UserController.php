<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function home()
    {
        return response()->view("todolist", [
            "title" => "Todolist"
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
            return redirect("/");
            $request->session()->put("username", $username);
        } else {
            return response()->view("login", [
                "title" => "Login",
                "error" => "Username or password is wrong"
            ]);
        }
    }
}
