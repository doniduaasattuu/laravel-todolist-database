<?php

namespace Tests\Feature;

use App\Models\Todolist;
use App\Services\TodolistService;
use App\Services\UserService;
use Database\Seeders\TodolistSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        Todolist::truncate();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testAddTodo()
    {
        $this->todolistService->save("Laravel Dasar");
        $this->todolistService->save("Laravel MVC");
        $this->todolistService->save("Laravel Database");
        $this->todolistService->save("Laravel Eloquent");

        $collection = Todolist::get();
        self::assertNotNull($collection);
        self::assertCount(4, $collection);

        self::assertEquals("Laravel Dasar", $collection[0]->todo);
        self::assertEquals("Laravel MVC", $collection[1]->todo);
        self::assertEquals("Laravel Database", $collection[2]->todo);
        self::assertEquals("Laravel Eloquent", $collection[3]->todo);

        foreach ($collection as $todo) {
            Log::info(json_encode($todo));
        }
    }

    public function testRemoveTodoSuccess()
    {
        $this->seed(TodolistSeeder::class);

        $this->todolistService->remove("1");

        $collection = Todolist::get();
        self::assertCount(3, $collection);
    }

    public function testRemoveTodoNotFound()
    {
        $this->seed(TodolistSeeder::class);

        $this->todolistService->remove("50");

        $collection = Todolist::get();
        self::assertCount(4, $collection);
    }

    public function testGetAllTodo()
    {
        $this->seed(TodolistSeeder::class);
        $collection = $this->todolistService->getAll();
        self::assertCount(4, $collection);
    }
}
