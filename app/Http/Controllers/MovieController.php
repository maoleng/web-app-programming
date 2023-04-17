<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Libraries\Request\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $movies = (new Movie)->orderByDesc('created_at')->paginate(2);

        return view('admin.movie.index', [
            'movies' => $movies,
        ]);
    }
}