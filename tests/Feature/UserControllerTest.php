<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get("/login")
            ->assertSeeText("Login");
    }

    public function testLoginRedirect()
    {
        $this->withSession([
            "username" => "doni"
        ])->get("/login")->assertRedirect("/");
    }

    public function testDoLogin()
    {
        $this->post("/login", [
            "username" => "doni",
            "password" => "rahasia"
        ])
            ->assertRedirect("/");
    }
}
