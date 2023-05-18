<?php

namespace App\Http\Middlewares;

class IfAlreadyLogin extends Middleware
{

    public function handle(): void
    {
        if (authed() !== null) {
            redirect()->back();
        }
    }


}