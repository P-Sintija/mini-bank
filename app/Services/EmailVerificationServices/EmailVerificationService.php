<?php

namespace App\Services\EmailVerificationServices;

use App\Mail\EmailVerificationMail;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService
{
    const VERIFICATION_TIMEOUT = 10;
    const VERIFICATION_ROUT = '/register/?email=';

    public function sendVerification(array $request): void
    {
        $verifyUrl = $_SERVER['APP_URL'] . ':' . $_SERVER['SERVER_PORT'] . self::VERIFICATION_ROUT;
        $this->setTimeLimit($request);
        Mail::to($request['email'])->send(new EmailVerificationMail($verifyUrl, $request['email']));
    }


    private function setTimeLimit(array $request): void
    {
        $email = new EmailVerification($request);
        $email->setTimeLimit(self::VERIFICATION_TIMEOUT);
    }
}
