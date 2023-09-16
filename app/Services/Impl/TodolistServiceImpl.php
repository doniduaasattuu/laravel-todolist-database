<?php

namespace App\Services\Impl;

use App\Models\Todolist;
use App\Services\TodolistService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TodolistServiceImpl implements TodolistService
{
    public function save(string $todo): void
    {
        Todolist::create([
            "todo" => $todo
        ]);
    }

    public function remove(string $id): void
    {
        $todolist = Todolist::query()->find($id);
        if ($todolist != null) {
            $todolist->first()->delete();
        }
    }

    public function getAll(): Collection
    {
        $collection = Todolist::get();
        return $collection;
    }
}
