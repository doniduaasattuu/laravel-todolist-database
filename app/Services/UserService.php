<?php

namespace App\Services;

interface UserService
{
    public function login(string $username, string $password): bool;
}
