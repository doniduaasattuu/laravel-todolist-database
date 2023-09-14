<?php

namespace Tests\Feature;

use Database\Seeders\TodolistSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::table('todolist')->truncate();
    }
    public function testAddTodo()
    {
        $this->withSession(["username" => "doni"])
            ->post("/todolist", [
                "todo" => "Laravel Dasar"
            ])->assertRedirect("/");
    }

    public function testRemoveTodo()
    {
        $this->seed(TodolistSeeder::class);

        $collection = DB::table("todolist")->get();
        self::assertCount(4, $collection);

        $this->withSession(["username" => "doni"])
            ->post("/delete", [
                "id" => "1"
            ])->assertRedirect("/");
        $collection = DB::table("todolist")->get();
        self::assertCount(3, $collection);

        $this->withSession(["username" => "doni"])
            ->post("/delete", [
                "id" => "2"
            ])->assertRedirect("/");
        $collection = DB::table("todolist")->get();
        self::assertCount(2, $collection);

        $this->withSession(["username" => "doni"])
            ->post("/delete", [
                "id" => "5"
            ])->assertRedirect("/");
        $collection = DB::table("todolist")->get();
        self::assertCount(2, $collection);

        $this->withSession(["username" => "doni"])
            ->post("/delete", [
                "id" => "3"
            ])->assertRedirect("/");
        $collection = DB::table("todolist")->get();
        self::assertCount(1, $collection);

        $this->withSession(["username" => "doni"])
            ->post("/delete", [
                "id" => "4"
            ])->assertRedirect("/");
        $collection = DB::table("todolist")->get();
        self::assertCount(0, $collection);

        foreach ($collection as $item) {
            Log::info(json_encode($item));
        }
    }
}
