<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    protected $fillable = ['image', 'like', 'name', 'description', 'duration', 'director', 'bgImage', 'type', 'trailer', 'rating', 'language'];

    public function schedules(): HasMany {
        return $this->hasMany(Schedule::class);
    }
}
