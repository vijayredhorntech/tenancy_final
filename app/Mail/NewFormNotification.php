<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;
use App\Models\VisaServiceTypeDocument;

class NewFormNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $form;
    public $originCountry;
    public $destinationCountry;

    /**
     * Create a new message instance.
     */
    public function __construct(Document $form)
    {
        $this->form = $form;

        // Fetch VisaServiceTypeDocument with origin and destination
        $data = VisaServiceTypeDocument::with(['origin', 'destination'])
            ->where('form_id', $this->form->id)
            ->first();

        // Assign country names (handle null cases)
        $this->originCountry = $data->origin->name ?? 'Unknown';
        $this->destinationCountry = $data->destination->name ?? 'Unknown';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Visa Form Added',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_form_notification',
            with: [
                'formName' => $this->form->form_name,
                'formDescription' => $this->form->form_description,
                'formLink' => asset($this->form->document),
                'originCountry' => $this->originCountry,
                'destinationCountry' => $this->destinationCountry,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
