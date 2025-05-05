<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsCondition extends Model
{
    use HasFactory,SoftDeletes;

   
    protected $table = 'terms_and_conditions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'termtype_id',
        'heading',
        'select_default',
        'required',
        'type',
        'description',
        'display_invoice',
        'agency_id',
        'status',
    ];

    /**
     * Relationship: Each term belongs to one term type.
     */
    public function termType()
    {
        return $this->belongsTo(TermType::class, 'termtype_id');
    }

    /**
     * Optional accessors: Convert tinyint to boolean when accessed.
     */
    public function getSelectDefaultAttribute($value)
    {
        return (bool) $value;
    }

    public function getRequiredAttribute($value)
    {
        return (bool) $value;
    }
}
