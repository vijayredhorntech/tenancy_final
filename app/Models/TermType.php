<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ CORRECT


/**
 * TermType Model
 *
 * This model represents different types of terms (e.g., visa terms, agreement terms).
 * 
 * Attributes:
 * - id
 * - type
 * - status (boolean)
 * - created_at
 * - updated_at
 * - deleted_at (for soft deletes)
 */

 class TermType extends Model
 {
     use HasFactory, SoftDeletes;
 
     protected $fillable = [
        'type',
        'description',
        'status',
    ];

    public function terms()
    {
        return $this->hasMany(TermsCondition::class, 'termtype_id', 'id');
    }
 }
 
