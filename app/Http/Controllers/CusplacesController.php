<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Place;
use Illuminate\Http\Request;

class CusplacesController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('cusplaces.index', [
            'places' => $places,
        ]);
    }

    public function show($id)
    {
        $place = Place::find($id);
        $cinemas = $place->cinemas;
        return view('cusplaces.show', [
            'place' => $place,
            'cinemas' => $cinemas
        ]);
    }

    public function choose($id) {
        $cinema = Cinema::findOrFail($id);
        $schedules = $cinema->schedules
            ->sortBy('show_date')
            ->groupBy('show_date');;
        return view('cusplaces.choose',[
            'cinema' => $cinema,
            'schedules' => $schedules,
        ]);
    }
}
