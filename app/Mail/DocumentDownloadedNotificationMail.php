<?php
// app/Mail/DocumentDownloadedNotificationMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\VisaBooking;

class DocumentDownloadedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(VisaBooking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Document Downloaded - Application Submitted')
                    ->view('emails.document_downloaded_notification');
    }
}
