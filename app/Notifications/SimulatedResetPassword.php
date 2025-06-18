<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use URL;

class SimulatedResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['database']; 
    
    }

   
    public function toArray($notifiable)
    {
        return [
            'reset_url' => URL::route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->email
            ]),
            'email' => $notifiable->email,
            'created_at' => now()->toDateTimeString(),
            'expires_at' => now()->addMinutes(config('auth.passwords.users.expire'))->toDateTimeString()
        ];
    }
}