<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocSignAudit extends Model
{
    protected $table = 'document_signature_audits';

    protected $fillable = [
        'document_signature_id',
        'event',
        'details',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function signature()
    {
        return $this->belongsTo(DocSignProcess::class, 'document_signature_id');
    }
}
