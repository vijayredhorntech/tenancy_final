<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisaApplicationMail extends Mailable implements ShouldQueue // Implementing ShouldQueue
{
    use Queueable, SerializesModels;

    public $data; // To store the dynamic data (subject, message)
    public $agency; 

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param object $agency
     */
    public function __construct(array $data, $agency)
    {
        $this->data = $data; // Store the data passed to the constructor
        $this->agency = $agency; // Store the agency data passed to the constructor
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'], // Dynamic subject
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.visa_application', // Blade view for the email content
            with: ['data' => $this->data, 'agency' => $this->agency] // Pass data to the view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return []; // No attachments for now, but this method is flexible for future use
    }
}
