<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Libraries\Request\Request;

class HomeController extends Controller
{

    public function index()
    {
        $movies = (new Movie)->orderByDesc('premiered_date')->limit(4)->get();

        return view('customer.index', [
            'movies' => $movies,
        ]);
    }

    public function nowShowing()
    {
        $movies = (new Movie)->raw('
            SELECT * FROM movies
            WHERE premiered_date <= CURDATE()
            ORDER BY premiered_date DESC
            LIMIT 20
        ');

        return view('customer.movie.index', [
            'movies' => $movies,
            'title' => 'NOW SHOWING MOVIE',
        ]);
    }

    public function comingSoon()
    {
        $movies = (new Movie)->raw('
            SELECT * FROM movies
            WHERE premiered_date > CURDATE()
            ORDER BY premiered_date DESC
            LIMIT 20
        ');

        return view('customer.movie.index', [
            'movies' => $movies,
            'title' => 'COMING SOON MOVIE',
        ]);
    }

    public function show(Request $request, $name)
    {
        $movie = (new Movie)->raw("
            SELECT *, REPLACE(LOWER(name), ' ', '-') FROM movies
           WHERE REPLACE(LOWER(name), ' ', '-') = '$name.'
        ");
        if (empty($movie)) {
            abort(404);
        }

        return view('customer.movie.show', [
            'movie' => $movie[0],
        ]);
    }
}