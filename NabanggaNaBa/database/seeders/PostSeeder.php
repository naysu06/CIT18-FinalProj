<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear table before seeding
        DB::table('vehicles')->truncate();

        // Insert sample posts
        Post::create([
            'user_id' => 1, // Assuming you have a user with ID 1
            'plate_number' => 'ABC1234',
            'model_year' => '2020',
            'image' => 'sample-image.jpg', // Ensure you have a sample image in public/storage/posts/
            'date' => now(),
            'place' => 'Test Location',
            'status' => 'approved', // Directly approve for testing
        ]);

        Post::create([
            'user_id' => 1,
            'plate_number' => 'XYZ5678',
            'model_year' => '2021',
            'image' => 'sample-image2.jpg',
            'date' => now(),
            'place' => 'Another Location',
            'status' => 'pending', // You can also test pending statuses
        ]);
    }
}
