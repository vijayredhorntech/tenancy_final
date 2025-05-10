<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class MessageSent implements ShouldBroadcastNow
{
    public $sender_id;
    public $receiver_id;
    public $type;
    public $client_id;
    public $message;

    public function __construct($sender_id, $receiver_id, $type, $client_id, $message)
    {
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->type = $type;
        $this->client_id = $client_id;
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('my-chanal');
    }

    public function broadcastAs(): string
    {
        return 'cloudtravel';
    }
}
