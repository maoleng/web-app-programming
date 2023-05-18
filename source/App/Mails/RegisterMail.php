<?php

namespace App\Mails;

use Libraries\Mail\Mailable;
use PHPMailer\PHPMailer\Exception;

class RegisterMail extends Mailable
{

    private string $email;
    private string $name;
    private string $code;
    private string $view;

    public function __construct($user, $view)
    {
        $this->email = $user->email;
        $this->name = $user->name;
        $this->code = $user->verify_code;
        $this->view = $view;
    }

    public function handle(): RegisterMail
    {
        $link = url('verify_register')."/$this->code";

        return $this->to($this->email)
            ->subject('ACTIVE YOUR ACCOUNT - '.env('APP_NAME'))
            ->view($this->view, [
                'name' => $this->name,
                'link' => $link,
            ]);
    }
}