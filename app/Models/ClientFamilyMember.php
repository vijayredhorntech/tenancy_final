<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientFamilyMember extends Model
{
    use SoftDeletes;

    protected $connection = 'user_database';

    protected $fillable = [
        'client_id',
        'relationship',
        'first_name',
        'last_name',
        'date_of_birth',
        'nationality',
        'birth_place',
        'country_of_birth',
        'email',
        'phone_number',
        'passport_number',
        'passport_country',
        'passport_issue_place',
        'passport_ic_number',
        'passport_issue_date',
        'passport_expiry_date',
        'employment',
        'employer_name',
        'employer_address',
        'employer_phone',
        'address',
        'city',
        'country',
        'educational_qualification',
        'identification_marks',
        'religion',
        'military_status',
        'military_organization',
        'military_designation',
        'military_rank',
        'military_posting_place',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
        'military_status' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relationship with Client
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Scope for active family members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific relationship
     */
    public function scopeRelationship($query, $relationship)
    {
        return $query->where('relationship', $relationship);
    }

    /**
     * Get relationship options
     */
    public static function getRelationshipOptions(): array
    {
        return [
            'father' => 'Father',
            'mother' => 'Mother',
            'spouse' => 'Spouse',
            'child' => 'Child',
            'parent' => 'Parent',
            'sibling' => 'Sibling',
            'other' => 'Other',
        ];
    }
}
