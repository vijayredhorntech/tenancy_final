<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientDocumentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $document;
    protected $agency;
    protected $message;
    protected $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($document, $agency, $message, $subject = null)
    {
        $this->document = $document;
        $this->agency = $agency;
        $this->message = $message;
        $this->subject = $subject ?? 'Document Notification - ' . $agency->agency_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.client-document-notification',
            with: [
                'document' => $this->document,
                'agency' => $this->agency,
                'message' => $this->message,
            ],
        );
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
