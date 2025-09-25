<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyMember extends Model
{
    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'relationship',
        'date_of_birth',
        'nationality',
        'passport_number',
        'passport_issue_date',
        'passport_expiry_date',
        'email_address',
        'phone_number',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
    ];

    /**
     * Get the client that owns the family member.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }
}