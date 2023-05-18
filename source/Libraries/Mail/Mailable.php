<?php

namespace Libraries\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

abstract class Mailable
{
    private PHPMailer $mail;

    abstract protected function handle(): Mailable;

    public function send(): bool
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mail->SMTPAuth = true;
        $this->mail->isSMTP();
        $this->mail->Host = env('MAIL_HOST') ?? 'smtp.gmail.com';
        $this->mail->SMTPSecure = env('MAIL_ENCRYPTION') ?? 'tls';
        $this->mail->Port = env('MAIL_PORT') ?? '587';
        $this->mail->Username = env('MAIL_USERNAME');
        $this->mail->Password = env('MAIL_PASSWORD');

        $this->handle();

        return $this->mail->send();
    }

    public function to($email): static
    {
        $this->mail->AddAddress($email);

        return $this;
    }

    public function from($email, $name = ''): static
    {
        $this->mail->setFrom($email, $name);

        return $this;
    }

    public function subject($subject): static
    {
        $this->mail->Subject = $subject;

        return $this;
    }

    public function view($view_name, $data = []): static
    {
        ob_start();
        view($view_name, $data);
        $html = ob_get_clean();
        $this->mail->Body = $html;
        $this->mail->AltBody = strip_tags($html);

        return $this;
    }

    public function bcc($emails): static
    {
        foreach ($emails as $email) {
            $this->mail->addBCC($email);
        }

        return $this;
    }

    public function cc($emails): static
    {
        foreach ($emails as $email) {
            $this->mail->addCC($email);
        }

        return $this;
    }



}