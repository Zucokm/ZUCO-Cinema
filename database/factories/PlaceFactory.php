<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'township'  => fake()->randomElement(['Insein', 'Mingalardon', 'PanBaeDan', 'Alone']),
            'photo' => fake()->imageUrl(),
            'place'     => fake()->unique()->randomElement(['JCity', 'Ocean', 'JSquare', 'TimeCity']),
            'location'  => fake()->randomElement(['4th Floor', '2nd Floor', '5th Floor']),
        ];
    }
}
