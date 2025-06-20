<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $places = Place::with('cinemas.schedules.movie')->get();

    foreach ($places as $place) {
        foreach ($place->cinemas as $cinema) {
            $cinema->groupedSchedules = $cinema->schedules->groupBy(function ($schedule) {
                return $schedule->show_date; // group by 'show_date' directly
            });
        }
    }

    return view('schedules.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($placeId)
    {
        $movies = Movie::all();
        $place = Place::find($placeId);
        return view('schedules.create', [
            'place' => $place,
            'movies' => $movies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'movie_id' => 'required|exists:movies,id',
            'show_date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);

        Schedule::create([
            'cinema_id' => $request->cinema_id,
            'movie_id' => $request->movie_id,
            'show_date' => $request->show_date,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect('/schedules')->with('success', 'Schedule created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $movies = Movie::all();
        $township = $schedule->cinema->place->township;
        return view('schedules.edit', [
            'schedule' => $schedule,
            'township' => $township,
            'movies' => $movies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update($id)
{

    $scheduleAttribute = request()->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'movie_id' => 'required|exists:movies,id',
            'show_date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
        ]);
    $schedule = Schedule::find($id);
    $schedule->update([
        'movie_id' => $scheduleAttribute['movie_id'],
        'cinema_id' => $scheduleAttribute['cinema_id'],
        'show_date' => $scheduleAttribute['show_date'],
        'start' => $scheduleAttribute['start'],
        'end' => $scheduleAttribute['end'],
    ]);

    return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Schedule $schedule)
{
    $schedule->delete();

    return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
}
}
