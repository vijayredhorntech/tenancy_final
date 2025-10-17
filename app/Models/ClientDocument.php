<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model
{
    protected $connection = 'user_database';
    protected $fillable = [
        'agency_id',
        'client_id',
        'document_name',
        'received_on',
        'remarks',
        'returned_on',
        'return_remarks',
        'created_by',
    ];

    protected $casts = [
        'received_on' => 'datetime',
        'returned_on' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }

    public function movements()
    {
        return $this->hasMany(ClientDocumentMovement::class);
    }
}


