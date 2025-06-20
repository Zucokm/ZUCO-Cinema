<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\SeatType;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ 1. Create Seat Types
        $seatTypes = [
            ['id' => 1, 'name' => 'Regular',  'price' => 3000],
            ['id' => 2, 'name' => 'Premium',  'price' => 5000],
            ['id' => 3, 'name' => 'VIP',      'price' => 7000],
            ['id' => 4, 'name' => 'Couple',   'price' => 8000],
            ['id' => 5, 'name' => 'Recliner', 'price' => 9000],
        ];

        foreach ($seatTypes as $type) {
            SeatType::factory()->create($type);
        }

        // ✅ 2. Create Places
        $places = Place::factory(4)->create();

        // ✅ 3. Create Movies
        $movies = Movie::factory(10)->create();

        // ✅ 4. Create Cinemas per Place
        $cinemas = collect();

        foreach ($places as $place) {
            for ($i = 1; $i <= 4; $i++) {
                $cinemas->push(
                    Cinema::factory()->create([
                        'place_id' => $place->id,
                        'name' => 'Zuco Cinema ' . $i,
                    ])
                );
            }
        }

        // ✅ 5. Create 100 seats per cinema with unique seat numbers
        $cinemas->each(function ($cinema) {
            $index = 1;
            $rows = range('A', 'E'); // A to E = 5 rows
            foreach ($rows as $row) {
                for ($i = 1; $i <= 20; $i++) { // 20 seats per row
                    Seat::factory()->create([
                        'cinema_id' => $cinema->id,
                        'seat_number' => $row . $i, // A1, A2, ..., E20
                        'seat_type_id' => $index,
                    ]);
                }
                $index++;
            }
            $index = 1;
        });

        // ✅ 6. Create Users
        $users = User::factory(50)->create();

        // ✅ 7. Create Schedules
        $schedules = Schedule::factory(50)->make()->each(function ($schedule) use ($cinemas, $movies) {
            $schedule->cinema_id = $cinemas->random()->id;
            $schedule->movie_id = $movies->random()->id;
            $schedule->save();
        });

        // ✅ 8. Create Bookings
        $users->each(function ($user) use ($schedules) {
            $schedule = $schedules->random();

            $booking = Booking::factory()->create([
                'user_id' => $user->id,
                'schedule_id' => $schedule->id,
            ]);

            $cinema = $schedule->cinema;
            $seats = Seat::where('cinema_id', $cinema->id)
                         ->inRandomOrder()
                         ->limit(rand(1, 3))
                         ->pluck('id');

            $booking->seats()->attach($seats);
        });
    }
}
