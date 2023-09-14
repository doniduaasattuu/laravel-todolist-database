<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    public function testOnlyGuestMiddleware()
    {
        $this->get("/")
            ->assertRedirect("/login");

        $this->withSession(["username" => "doni"])
            ->get("/")
            ->assertSeeText("Doni Darmawan");
    }

    public function testOnlyMemberMiddleware()
    {
        $this->withSession(["username" => "doni"])
            ->get("/login")
            ->assertRedirect("/");
    }
}
