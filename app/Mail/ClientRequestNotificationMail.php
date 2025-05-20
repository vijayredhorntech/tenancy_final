<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientRequestNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $deduction;

    public function __construct($deduction) // or Deduction $deduction
    {
        $this->deduction = $deduction;
    }

    public function build()
    {
        return $this->subject('New Visa  Request Submitted')
                    ->view('emails.client_request')
                    ->with([
                        'deduction' => $this->deduction,
                    ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
