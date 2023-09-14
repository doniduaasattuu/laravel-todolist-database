<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todolist')->insert([
            "todo" => "Laravel Dasar"
        ]);
        DB::table('todolist')->insert([
            "todo" => "Laravel MVC"
        ]);
        DB::table('todolist')->insert([
            "todo" => "Laravel Database"
        ]);
        DB::table('todolist')->insert([
            "todo" => "Laravel Eloquent"
        ]);
    }
}
