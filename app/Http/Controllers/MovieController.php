<?php

namespace App\Http\Controllers;

use Libraries\Request\Request;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.movie.index');
    }
}