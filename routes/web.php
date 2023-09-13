<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
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

// Route::get('/', [UserController::class, "home"]);

Route::middleware(OnlyGuestMiddleware::class)->group(function () {
    Route::get("/login", [UserController::class, "login"]);
});

Route::post("/login", [UserController::class, "doLogin"]);
