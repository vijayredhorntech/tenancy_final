<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory,SoftDeletes;

     protected $fillable = [
        'ticket_code',
        'sender_id',
        'receiver_id',
        'message',
        'type',
        'attachments',
        'status',

        // edit / delete tracking
        'is_edit',
        'edited_at',
        'updated_user_id',
        'is_delete',
        'deleted_at_manual',
        'deleted_user_id',
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_edit' => 'boolean',
        'is_delete' => 'boolean',
        'edited_at' => 'datetime',
        'deleted_at_manual' => 'datetime',
    ];

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
