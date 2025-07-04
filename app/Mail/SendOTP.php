<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $subject = null)
    {
        $this->mailData = $mailData;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject ?? env('APP_NAME'))
                    ->view('emails.message');
    }
}
