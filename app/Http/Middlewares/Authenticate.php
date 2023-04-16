<?php

namespace App\Http\Middlewares;

class Authenticate extends Middleware
{

    public function handle()
    {
        $a = 4;
        if ($a === 6) {
            return true;
        }

        redirect()->back();
    }


}