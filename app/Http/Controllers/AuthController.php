<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;

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

    public function processLogin(LoginRequest $request): void
    {
        $data = $request->validated();
        $admin = (new Admin)->where('email', $data['email'])->first();
        if ($admin === null) {
            redirectBackWithError('Wrong email address or password');
        }
        if (! $admin->verify($data['password'])) {
            redirectBackWithError('Wrong email address or password');
        }
        session()->put('auth', $admin);

        redirect()->route('/');
    }

    public function processRegister()
    {

    }

    public function logout(): void
    {
        session()->forget('auth');

        redirect()->route('/');
    }




}