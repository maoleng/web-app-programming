<?php

namespace App\Http\Controllers;

use Libraries\Request\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        redirect()->route('admin/movie');
    }
}