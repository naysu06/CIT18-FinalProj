<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'plate_number' => strtoupper($this->faker->unique()->bothify('??-####')), // Random plate number
            'model_year' => $this->faker->year(), // Random year
            'image' => 'posts/sample.jpg', // Placeholder image
            'date' => $this->faker->date(),
            'place' => $this->faker->city(),
            'status' => 'pending', // Directly approved for testing, change to pending for real use
            'user_id' => User::factory(), // Generates a random user
        ];
    }
}
