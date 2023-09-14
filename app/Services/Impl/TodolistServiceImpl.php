<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TodolistServiceImpl implements TodolistService
{
    public function save(string $todo): void
    {
        DB::table("todolist")->insert([
            "todo" => $todo
        ]);
    }

    public function remove(string $id): void
    {
        DB::table("todolist")->where("id", "=", $id)->delete();
    }

    public function getAll(): Collection
    {
        $collection = DB::table('todolist')->get();
        return $collection;
    }
}
