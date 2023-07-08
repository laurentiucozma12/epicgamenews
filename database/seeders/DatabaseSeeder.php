<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key constraints for users and enable it again.
        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();

        Schema::enableForeignKeyConstraints();

        // Create Roles and Users
        \App\Models\Role::factory(1)->create();
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(100)->create();
    }
}
