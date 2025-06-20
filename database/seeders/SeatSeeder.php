<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cinema = Cinema::firstOrCreate(['name' => 'Test Cinema']);
        $seatType = SeatType::firstOrCreate(['name' => 'Standard', 'price' => 1000]);

        $start = 1;
        foreach (range(0, 19) as $i) {
            Seat::create([
                'cinema_id' => $cinema->id,
                'seat_type_id' => $seatType->id,
                'seat_number' => 'A' . ($start + $i),
            ]);
        }
    }
}
