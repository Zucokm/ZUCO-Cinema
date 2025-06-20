<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCinemaRequest;
use App\Http\Requests\UpdateCinemaRequest;
use App\Models\Cinema;
use App\Models\Place;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($placeId)
    {
        $place = Place::find($placeId);
        return view('cinemas.create', [
            'place' => $place,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cinemaAttributes = $request->validate([
            'place_id' => ['required'],
            'name'     => ['required'],
            'photo'    => ['required', File::types(['png', 'jpg', 'webp', 'jpeg'])],
        ]);

        $cinemaPath = $request->file('photo')->store('cinemas', 'public');


        $cinema = Cinema::create([
            'place_id' => $cinemaAttributes['place_id'],
            'name'     => $cinemaAttributes['name'],
            'photo'    => $cinemaPath,
        ]);


        $index = 1;
        $rows = range('A', 'E'); // A to E = 5 rows

        foreach ($rows as $row) {
            for ($i = 1; $i <= 20; $i++) { // 20 seats per row
                Seat::create([
                    'cinema_id' => $cinema->id,
                    'seat_number' => $row . $i, // A1, A2, ..., E20
                    'seat_type_id' => $index,   // 1 to 5 (matching each row)
                ]);
            }
            $index++;
        }

        return redirect("/places/{$cinemaAttributes['place_id']}")->with('success', 'Cinema created with seats!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema)
    {
        dd('hello');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cinema $cinema)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCinemaRequest $request, Cinema $cinema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema)
    {
        $placeId = $cinema->place_id; 

        if ($cinema->photo && Storage::exists('public/' . $cinema->photo)) {
            Storage::delete('public/' . $cinema->photo);
        }

        $cinema->delete();

        return redirect("/places/{$placeId}")->with('success', 'Cinema deleted successfully.');
    }
}
