<?php
// app/Mail/DocumentVerificationRequestMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentVerificationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationNumber;

    public function __construct($applicationNumber)
    {
        $this->applicationNumber = $applicationNumber;
    }

    public function build()
    {
        return $this->subject('Document Verification Required')
                    ->view('emails.document_verification_request')
                    ->with([
                        'applicationNumber' => $this->applicationNumber,
                    ]);
    }
}
