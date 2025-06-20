<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CusscheduleController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        $schedulesByDate = $movie->schedules
            ->sortBy('show_date') // sort first
            ->groupBy('show_date'); // then group

        return view('cusschedules.show', [
            'movie' => $movie,
            'schedulesByDate' => $schedulesByDate,
        ]);
    }
}
