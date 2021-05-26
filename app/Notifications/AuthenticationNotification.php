<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthenticationNotification extends Notification
{
    use Queueable;

    private int $twoFactorCode;
    private int $userId;


    public function __construct(int $twoFactorCode, int $userId)
    {
        $this->twoFactorCode = $twoFactorCode;
        $this->userId = $userId;

    }


    public function via($notifiable): array
    {
        return ['mail'];
    }


    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->line('Your code is: ' . $this->twoFactorCode)
            ->action('Notification Action', route('authenticationForm.show', ['id' => $this->userId]))
            ->line('Thank you for using our application!');
    }
}
