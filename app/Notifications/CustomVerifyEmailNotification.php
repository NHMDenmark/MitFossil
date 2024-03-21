<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomVerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject(Lang::get('Bekræft e-mailadresse'))
            ->line(Lang::get('Velkommen til MitFossil!'))
            ->line(Lang::get('Tak for at oprette dig som bruger på MitFossil og slutte dig til fællesskabet. Det er vigtigt at huske, at MitFossil kun er til indsendelse og identifikation af fossiler fundet i Danmark.'))
            ->line(Lang::get('Du mangler kun et sidste skridt for at være helt klar. Bekræft din e-mailadresse ved at trykke på knappen nedenunder :D'))
            ->action(Lang::get('Tryk her for at komme i gang med at bruge MitFossil'), $verificationUrl);
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
