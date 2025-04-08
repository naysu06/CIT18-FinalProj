<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user with the correct fields
        User::factory()->create([
            'username' => 'testuser',  // Use 'username' instead of 'name'
            'password' => Hash::make('password'),  // Uncomment if you want to hash the password
            'role' => 'user',  // Add 'role' here if required
        ]);
        // Create a test user with the correct fields
        User::factory()->create([
            'username' => 'testadmin',  // Use 'username' instead of 'name'
            'password' => Hash::make('password'),  // Uncomment if you want to hash the password
            'role' => 'admin',  // Add 'role' here if required
        ]);
        // Create 20 random users
        User::factory()->count(20)->create();
    }
}
