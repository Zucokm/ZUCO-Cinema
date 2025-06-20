<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'schedule_id' => Schedule::inRandomOrder()->first()?->id ?? Schedule::factory(),
            'price' => $this->faker->randomFloat(2, 3000, 15000), 
            'payment' => $this->faker->randomElement(['cash', 'kbz', 'wave']),
            'booking_date' => $this->faker->dateTimeBetween('now', '+7 days')->format('Y-m-d'),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
