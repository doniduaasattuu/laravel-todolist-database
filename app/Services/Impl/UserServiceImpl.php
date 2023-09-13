<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class UserServiceImpl implements UserService
{

    public function login(string $username, string $password): bool
    {
        if (empty($username) || empty($username)) {
            return false;
        }

        $result = DB::table('users')->where("username", "=", $username)->first();

        if ($result !== null) {
            return $result->password == $password;
        } else {
            return false;
        }
    }
}
