<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisaBookingInProcessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $client;
    public $agency;

    public function __construct($client, $agency)
    {
        $this->client = $client;
        $this->agency = $agency;
    }


    public function build()
    {
        return $this->subject('Your Visa Booking is Under Process')
                    ->view('emails.booking_in_process')
                    ->with([
                        'client' => $this->client,
                        'agency' => $this->agency,
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
