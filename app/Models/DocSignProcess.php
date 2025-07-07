<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\DocSignAudit;

class DocSignProcess extends Model
{
    use SoftDeletes;

    protected $table = 'document_signatures';

    protected $fillable = [
        'user_id',
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


    public function agency(){
        return $this->hasOne(Agency::class, 'id','user_id');
        
    }

    public function audits()
    {
        return $this->hasMany(DocSignAudit::class, 'document_signature_id');
    }

    /***save Record *** */
    public function recordEvent(string $event, string $details, Request $request): DocSignAudit
{
    return $this->audits()->create([
        'event'      => $event,
        'details'    => $details,
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
    ]);
}
}
