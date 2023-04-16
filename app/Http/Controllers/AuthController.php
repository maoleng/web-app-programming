<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function processLogin()
    {

    }

    public function processRegister()
    {

    }




}