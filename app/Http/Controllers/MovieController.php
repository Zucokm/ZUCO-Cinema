<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $movieAttributes = $request->validate([
            'image'       => ['required', File::types(['png', 'jpg', 'webp', 'jpeg'])],
            'like'        => ['required'],
            'name'        => ['required'],
            'description' => ['required'],
            'duration'    => ['required'],
            'director'    => ['required'],
            'bgImage'     => ['required', File::types(['png', 'jpg', 'webp', 'jpeg'])],
            'type'        => ['required'],
            'trailer'     => ['required', 'active_url'],
            'rating'      => ['required'],
            'language'    => ['required'],
        ]);


        // Store images
        $moviePath = $request->file('image')->store('movies', 'public');
        $bgMoviePath = $request->file('bgImage')->store('bgMovies', 'public');

        // Save to database
        Movie::create([ 
            'image'       => $moviePath,
            'like'        => $movieAttributes['like'],
            'name'        => $movieAttributes['name'],
            'description' => $movieAttributes['description'],
            'duration'    => $movieAttributes['duration'],
            'director'    => $movieAttributes['director'],
            'bgImage'     => $bgMoviePath,
            'type'        => $movieAttributes['type'],
            'trailer'     => $movieAttributes['trailer'],
            'rating'      => $movieAttributes['rating'],
            'language'    => $movieAttributes['language'],
        ]);

        return redirect('/movies');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit',[
            'movie' => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Movie $movie) {
        $movieAttributes = request()->validate([
            'image'       => ['nullable', File::types(['png', 'jpg', 'webp', 'jpeg'])],
            'like'        => ['required'],
            'name'        => ['required'],
            'description' => ['required'],
            'duration'    => ['required', 'integer'], // Added integer for duration
            'director'    => ['required'],
            'bgImage'     => ['nullable', File::types(['png', 'jpg', 'webp', 'jpeg'])],
            'type'        => ['required'],
            'trailer'     => ['required', 'active_url'],
            'rating'      => ['required', 'numeric'], // Added numeric for rating
            'language'    => ['required'],
        ]);

        $dataToUpdate = $movieAttributes;

        // Handle Movie Image Upload
        if (request()->hasFile('image')) {
            if ($movie->image && Storage::exists('public/' . $movie->image)) {
                Storage::delete('public/' . $movie->image);
            }
            // Ensure consistency: use 'movies' as in your store method, or choose one folder name and stick to it.
            $dataToUpdate['image'] = request()->file('image')->store('movies', 'public');
        } else {
            // If no new image is uploaded, retain the existing one
            // This line is correct as it retains the old image path if no new one is provided.
            $dataToUpdate['image'] = $movie->image;
        }

        // Handle Background Image Upload
        if (request()->hasFile('bgImage')) {
            if ($movie->bgImage && Storage::exists('public/' . $movie->bgImage)) {
                Storage::delete('public/' . $movie->bgImage);
            }
            // Ensure consistency: use 'bgMovies' as in your store method, or choose one folder name and stick to it.
            $dataToUpdate['bgImage'] = request()->file('bgImage')->store('bgMovies', 'public');
        } else {
            // If no new background image is uploaded, retain the existing one
            $dataToUpdate['bgImage'] = $movie->bgImage;
        }

        $movie->update($dataToUpdate);

        return redirect('/movies/' . $movie->id)->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie) {
        if ($movie->image && Storage::exists('public/' . $movie->image)) {
            Storage::delete('public/' . $movie->image);
        }

        if ($movie->bgImage && Storage::exists('public/' . $movie->bgImage)) {
            Storage::delete('public/' . $movie->bgImage);
        }

        $movie->delete();
        return redirect('/movies');
    }
}
