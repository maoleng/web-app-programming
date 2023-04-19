<?php

namespace App\Http\Controllers;

use Libraries\Request\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return view('customer.index', [

        ]);
    }
}