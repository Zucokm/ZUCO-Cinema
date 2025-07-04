<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatType>
 */
class SeatTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Standard', 'VIP', 'Couple', 'Premium', 'Economy',
            ]),
            'price' => $this->faker->randomFloat(2, 5, 20),
        ];
    }
}
