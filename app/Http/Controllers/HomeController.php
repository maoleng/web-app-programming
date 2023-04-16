<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Libraries\database_drivers\mysql\DB;
use Libraries\Request\Request;
use Libraries\Session\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {


        return view('post_detail', [

        ]);
    }

    public function test()
    {
        Session::put('name', 'ten tao dc luu vao session');
        Session::flush();
        Session::put('ten moi', 'ten moi');
        Session::forget('ten moi');
        session()->put('from_helper', 'ten tao tu helper');
        $a = Session::get();

        dd($a);
    }
}