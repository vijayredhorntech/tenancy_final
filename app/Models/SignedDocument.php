<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignedDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'signed_documents'; // Specify the custom table name

    protected $fillable = [
        'agency_id',
        'title',
        'path',
        'description',
        'mimetype',
        'size',
        'is_active',
        'current_version',
    ];

    // Optional: Relationship to agency (if needed)
    // public function agency()
    // {
    //     return $this->belongsTo(Agency::class);
    // }
}
