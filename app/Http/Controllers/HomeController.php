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

}