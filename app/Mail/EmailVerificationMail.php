<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $url;
    private string $email;

    public function __construct(string $url, string $email)
    {
        $this->url = $url;
        $this->email = $email;
    }

    public function build(): EmailVerificationMail
    {
        return $this->view('mails.emailVerification')
            ->with([
                'url' => $this->url,
                'email' => $this->email
            ]);
    }
}
