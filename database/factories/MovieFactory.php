<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(),
            'like'  => fake()->randomElement(['147.1K', '150.3K', '100,3K']),
            'name'  => fake()->name,
            'description' => fake()->paragraph(),
            'duration' => 180,
            'director' => fake()->name,
            'bgImage' => fake()->imageUrl(),
            'trailer' => fake()->url(),
            'rating' => fake()->randomElement(['6.5', '7.9', '8.5']),
            'language' => fake()->randomElement(['English', 'Myanamr']),
            'type'  => fake()->name,
        ];
    }
}
