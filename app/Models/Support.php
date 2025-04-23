<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory,SoftDeletes;

    
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    // Relationship: Support belongs to a user (who created the ticket)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relationship: Support is assigned to a support agent
    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relationship: Support has many messages
    public function messages() {
        return $this->hasMany(Message::class, 'ticket_id');
    }
}
