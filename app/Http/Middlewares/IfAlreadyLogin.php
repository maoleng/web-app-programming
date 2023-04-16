<?php

namespace App\Http\Middlewares;

class IfAlreadyLogin extends Middleware
{

    public function handle()
    {
        if (authed() !== null) {
            redirect()->back();
        }
    }


}