<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentSignRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $clientName;
    public $documentLink;
    public $customMessage;

    /**
     * Create a new message instance.
     *
     * @param $clientName
     * @param $documentLink
     * @param $customMessage
     */
    public function __construct($clientName, $documentLink, $customMessage)
    {
        $this->clientName = $clientName;
        $this->documentLink = $documentLink;
        $this->customMessage = $customMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Document Signing Request')
                    ->view('emails.document-sign-request')
                    ->with([
                        'clientName' => $this->clientName,
                        'documentLink' => $this->documentLink,
                        'customMessage' => $this->customMessage,
                    ]);
    }
}
