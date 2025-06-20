<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\SeatType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cinema_id' => Cinema::factory(),
            'seat_number' => 'A1', // Default placeholder
            'seat_type_id' => SeatType::factory(),
        ];
    }
}
