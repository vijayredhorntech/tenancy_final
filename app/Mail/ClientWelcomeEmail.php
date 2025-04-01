<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ClientDetails;
use Illuminate\Contracts\Queue\ShouldQueue;


class ClientWelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $client;
    public $agency;

    public function __construct(ClientDetails $client,$agency)
    {
        $this->client = $client;
        $this->agency = $agency;
    }

    public function build()
    {
        
        return $this->subject('Welcome to Our Service')
                    ->view('emails.client_welcome') // This will be your email template
                    ->with([
                        'client' => $this->client,
                        'agency' => $this->agency,
                    ]);
    }
}