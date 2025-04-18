<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisaSubtype extends Model
{
    //
    use HasFactory;

    protected $fillable = ['visa_type_id', 'name', 'price', 'commission', 'status'];

    // Relationship with VisaType model
    public function visaType()
    {
        return $this->belongsTo(VisaType::class);
    }
}
