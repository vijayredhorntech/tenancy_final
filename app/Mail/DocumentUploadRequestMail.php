<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentUploadRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $agencyName;
    public $invoiceNumber;

    public function __construct($agencyName, $invoiceNumber)
    {
        $this->agencyName = $agencyName;
        $this->invoiceNumber = $invoiceNumber;
    }

    public function build()
    {
        return $this->subject('Document Upload Request for Application')
                    ->view('emails.document_upload_request')
                    ->with([
                        'agencyName' => $this->agencyName,
                        'invoiceNumber' => $this->invoiceNumber,
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
