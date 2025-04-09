<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment to Create 20 car posts and associate them with 20 random users(testing purposes)
        //Post::factory()->count(20)->create();
    }
}
