<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    /** @use HasFactory<\Database\Factories\SeatFactory> */
    use HasFactory;

    public function cinema() {
        return $this->belongsTo(Cinema::class);
    }

    public function seatType() {
        return $this->belongsTo(SeatType::class);
    }
}
