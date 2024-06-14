<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->address(),
            'location' => fake()->address(),
            'path' => fake()->imageUrl(1080 , 1080 , $format = "jpg"),
            'user_id' => fake()->numberBetween(1 , 10)

        ];
    }
}
