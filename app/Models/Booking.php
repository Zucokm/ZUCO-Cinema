<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function seat(string $seat_number) {
        $this->loadMissing('schedule');

        $cinema_id = $this->schedule->cinema_id;

        // check if seat_type_id = 1 exists, otherwise create a fake one
        if (!SeatType::find(1)) {
            SeatType::factory()->create(['id' => 1]);
        }

        $seat = Seat::firstOrCreate(
            ['seat_number' => $seat_number, 'cinema_id' => $cinema_id],
            ['seat_type_id' => 1]
        );

        $this->seats()->attach($seat);
    }

    public function seats() {
        return $this->belongsToMany(Seat::class);
    }
}
