<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    // GET USER
    public function testGetUserFound()
    {
        $result = DB::table('users')->where("username", "=", "doni")->first();
        self::assertEquals("doni", $result->username);
        self::assertEquals("rahasia", $result->password);
    }

    public function testGetUserNotFound()
    {
        $result = DB::table('users')->where("username", "=", "salah")->first();
        self::assertNull($result);
    }

    // LOGIN
    public function testLoginSuccess()
    {
        $loginSuccess = $this->userService->login("doni", "rahasia");

        self::assertTrue($loginSuccess);
    }

    public function testLoginFailed()
    {
        $loginFailed = $this->userService->login("salah", "salah");

        self::assertFalse($loginFailed);
    }

    public function testLoginWrongPassword()
    {
        $loginFailed = $this->userService->login("doni", "salah");

        self::assertFalse($loginFailed);
    }

    public function testLoginWrongUsername()
    {
        $loginFailed = $this->userService->login("salah", "rahasia");

        self::assertFalse($loginFailed);
    }
}
