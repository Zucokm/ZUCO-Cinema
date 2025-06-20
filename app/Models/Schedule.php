<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function cinema() {
        return $this->belongsTo(Cinema::class);
    }

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class);
    }
}
