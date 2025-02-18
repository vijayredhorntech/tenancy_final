<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;


    public function ticket() {
        return $this->belongsTo(Support::class, 'ticket_id');
    }

    // Relationship: Message belongs to the sender (user)
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship: Message belongs to the receiver (user)
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    //
}
