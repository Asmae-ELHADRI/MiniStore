<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin MiniStore',
            'email' => 'admin@ministore.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Client User
        User::factory()->create([
            'name' => 'Client MiniStore',
            'email' => 'client@ministore.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);
    }
}
