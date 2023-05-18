<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mails\RegisterMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Libraries\Request\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view('customer.auth.login');
    }

    public function register()
    {
        return view('customer.auth.register');
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
        if (! (int) $user->active) {
            $this->sendMailVerify($user);

            redirectBackWithError('Account is not active, please check your mailbox');
        }
        session()->put('auth', $user);

        redirect()->route('/');
    }

    public function processRegister(RegisterRequest $request): void
    {
        $data = $request->validated();
        $user = (new User)->where('email', $data['email'])->first();
        if ($user !== null) {
            redirectBackWithError('Email already exists');
        }
        $user = (new User)->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'is_admin' => 0,
            'active' => 0,
            'created_at' => now()->format('Y-m-d H:i:s'),
        ]);
        $this->sendMailVerify($user);

        session()->flash('success', 'Registered successfully, check your email for verify');

        redirect()->route('/');
    }

    public function verifyRegister(Request $request, $code): void
    {
        $user = (new User)->where('verify_code', $code)->first();
        if ($user === null) {
            redirectWithError('/', 'Invalid code');
        }
        if ((int) $user->active) {
            redirectWithError('/', 'Account is already active');
        }
        if (Carbon::make($user->verified_at)->addMinutes(10)->lt(now())) {
            redirectWithError('/', 'Out of time');
        }
        $user->update(['active' => 1]);
        redirectWithSuccess('/', 'Verify successfully');
    }

    public function logout(): void
    {
        session()->forget('auth');

        redirect()->route('/');
    }

    private function sendMailVerify(User $user): void
    {
        $code = Str::random();
        $user->verify_code = $code;
        $user->verified_at = now()->toDateTimeString();
        $user->save();
        (new RegisterMail($user, 'mail.register'))->send();
    }


}