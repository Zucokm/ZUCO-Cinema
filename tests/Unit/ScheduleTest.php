<?php

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Schedule;

it('belongs to a cinema and a movie', function () {
    // Arrange
    $movie = Movie::factory()->create();
    $place = Place::factory()->create();
    $cinema = Cinema::factory()->create([
        'place_id' => $place->id,
    ]);

    // Act
    $schedule = Schedule::factory()->create([
        'movie_id' => $movie->id,
        'cinema_id' => $cinema->id,
    ]);

    // Assert
    expect($schedule->cinema->is($cinema))->toBeTrue()
        ->and($schedule->movie->is($movie))->toBeTrue();
});
