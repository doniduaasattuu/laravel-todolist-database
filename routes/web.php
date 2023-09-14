<?php

use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(OnlyGuestMiddleware::class)->group(function () {
    Route::get("/login", [UserController::class, "login"]);
    Route::post("/login", [UserController::class, "doLogin"]);
});

Route::middleware(OnlyMemberMiddleware::class)->group(function () {
    Route::get('/', [UserController::class, "home"])->name("home");
    Route::post("/logout", [UserController::class, "logout"]);
    Route::post("/todolist", [TodolistController::class, "addTodo"]);
    Route::post("/delete", [TodolistController::class, "removeTodo"]);
});

Route::fallback(function () {
    return "404 by Doni Darmawan";
});
