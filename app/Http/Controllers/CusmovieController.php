<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CusmovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('cusmovies.index', [
            'movies' => $movies,
        ]);
    }

     public function show($id)
    {
        $movie = Movie::find($id);
        return view('cusmovies.show', [
            'movie' => $movie,
        ]);
    }

}
