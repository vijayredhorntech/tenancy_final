<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocumentMovement extends Model
{
    protected $connection = 'user_database';
    protected $fillable = [
        'client_document_id',
        'action', // received | returned
        'action_at',
        'remarks',
        'agency_id',
        'user_id',
    ];

    protected $casts = [
        'action_at' => 'datetime',
    ];

    public function document()
    {
        return $this->belongsTo(ClientDocument::class, 'client_document_id');
    }
}


