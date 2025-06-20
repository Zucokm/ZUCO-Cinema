<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first()?->id ?? Movie::factory(),
            'cinema_id' => Cinema::inRandomOrder()->first()?->id ?? Cinema::factory(),
            'show_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start' => $startTime = $this->faker->time('H:i:s'),
            'end' => date('H:i:s', strtotime($startTime . ' +2 hours')),
        ];
    }
}
