<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Libraries\Request\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $movies = (new Movie)->orderByDesc('premiered_date')->limit(4)->get();

        return view('customer.index', [
            'movies' => $movies,
        ]);
    }
}