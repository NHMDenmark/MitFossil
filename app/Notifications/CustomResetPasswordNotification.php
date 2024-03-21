<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPasswordNotification extends ResetPassword
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('Nulstil adgangskode'))
            ->line('Du modtager denne e-mail, fordi vi har modtaget en anmodning om nulstilling af adgangskoden til din bruger.')
            ->action('Nulstil adgangskode', $this->resetUrl($notifiable))
            ->line('Dette link til nulstilling af adgangskode udløber om 60 minutter.')
            ->line('Hvis du ikke har anmodet om en nulstilling af adgangskoden, er der ikke behov for yderligere handling.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
