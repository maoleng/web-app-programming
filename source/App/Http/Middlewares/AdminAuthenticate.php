<?php

namespace App\Http\Middlewares;

class AdminAuthenticate extends Middleware
{

    public function handle(): void
    {
        if (authed() === null || ! authed()->is_admin) {
            redirect()->route('login');
        }
    }


}