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
    private string $authentication;

    public function __construct(int $twoFactorCode, int $userId, string $authentication)
    {
        $this->twoFactorCode = $twoFactorCode;
        $this->userId = $userId;
        $this->authentication = $authentication;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->line('Your code is: '. $this->twoFactorCode)
                    ->line('authentication' . $this->authentication)
                    ->action('Notification Action', route('authenticationForm.show', ['id' => $this->userId]))
                    ->line('Thank you for using our application!');
    }
}
