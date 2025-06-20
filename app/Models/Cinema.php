<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    /** @use HasFactory<\Database\Factories\CinemaFactory> */
    use HasFactory;

    public function place() {
        return $this->belongsTo(Place::class);
    }

    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }

    public function seats(): HasMany {
        return $this->hasMany(Seat::class);
    }
}
