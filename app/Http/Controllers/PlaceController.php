<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Movie;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::all();
        return view('places.index',[
            'places' => $places
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $placeAttributes = $request->validate([
            'township'      =>['required'],
            'photo'         => ['required', File::types(['png', 'jpg', 'webp', 'jpeg'])],
            'place'         => ['required'],
            'location'      => ['required'],
        ]);

        $placePath = $request->file('photo')->store('places', 'public');
        Place::create([
            'township'      => $placeAttributes['township'],
            'photo'         => $placePath,
            'place'         => $placeAttributes['place'],
            'location'      => $placeAttributes['location']
        ]);

        return redirect('/places');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $place = Place::find($id);
        $cinemas = $place->cinemas;
        return view('places.show', [
            'place' => $place,
            'cinemas' => $cinemas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('places.edit', [
            'place' => $place
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Place $place)
    {
        // 1. Validate the incoming request data
        $placeAttributes = request()->validate([
            'township'  => ['required', 'string', 'max:255'], // Added string and max:255 for better validation
            'photo'     => ['nullable', File::types(['png', 'jpg', 'webp', 'jpeg'])], // Changed to nullable
            'place'     => ['required', 'string', 'max:255'], // Added string and max:255
            'location'  => ['required', 'string', 'max:255'], // Added string and max:255
        ]);

        // Initialize an array to hold the data for updating the place
        $dataToUpdate = $placeAttributes;

        // 2. Handle Photo Upload
        if (request()->hasFile('photo')) {

            if ($place->photo && Storage::exists('public/' . $place->photo)) {
                Storage::delete('public/' . $place->photo);
            }

            $dataToUpdate['photo'] = request()->file('photo')->store('places', 'public');
        } else {

            $dataToUpdate['photo'] = $place->photo;
        }

        // 3. Update the Place model with the prepared data
        $place->update($dataToUpdate);

        // 4. Redirect with a success message (adjust as per your routing)
        return redirect('/places/' . $place->id)->with('success', 'Place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        if ($place->photo && Storage::exists('public/' . $place->photo)) {
            Storage::delete('public/' . $place->photo);
        }

  

        $place->delete();
        return redirect('/places');
    }
}
