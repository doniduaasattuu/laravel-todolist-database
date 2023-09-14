<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface TodolistService
{
    public function save(string $todo): void;

    public function remove(string $id): void;

    public function getAll(): Collection;
}
