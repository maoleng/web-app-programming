<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

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
        $user = (new User)->where('email', $data['email'])->first();
        if ($user === null) {
            redirectBackWithError('Wrong email address or password');
        }
        if (! $user->verify($data['password'])) {
            redirectBackWithError('Wrong email address or password');
        }
        session()->put('auth', $user);

        redirect()->route('/');
    }

    public function processRegister(RegisterRequest $request)
    {
        $data = $request->validated();

    }

    public function logout(): void
    {
        session()->forget('auth');

        redirect()->route('/');
    }




}