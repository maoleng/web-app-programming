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

        return view('customer.now_showing', [
            'movies' => $movies,
        ]);
    }

}