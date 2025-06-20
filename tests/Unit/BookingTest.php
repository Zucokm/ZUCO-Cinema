<?php

use App\Models\Booking;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Schedule;
use App\Models\User;

it('belong to a user and a schedule', function () {
    $user = User::factory()->create();
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

    $booking = Booking::factory()->create([
        'user_id' => $user,
        'schedule_id' => $schedule,
    ]);

    expect($booking->user->is($user))->toBeTrue()
        ->and($booking->schedule->is($schedule))->toBeTrue();
});

it('can have seats', function() {
    $user = User::factory()->create();
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

    $booking = Booking::factory()->create([
        'user_id' => $user,
        'schedule_id' => $schedule,
    ]);

    $booking->seat('A-6');

    expect($booking->seats)->toHaveCount(1);
});