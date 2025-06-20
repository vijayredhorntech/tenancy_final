<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocSignProcess extends Model
{
    use SoftDeletes;

    protected $table = 'document_signatures';

    protected $fillable = [
        'core_member_id',
        'document_id',
        'signing_token',
        'status',
        'message',
        'signed_at',
        'expires_at',
        'signature_hash',
        'signed_document_path',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function audits()
    {
        return $this->hasMany(DocSignAudit::class, 'document_signature_id');
    }
}
