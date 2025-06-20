<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocSignDocument extends Model
{
    // Tell Laravel the custom table name
    protected $table = 'docsigndocuments';

    protected $fillable = [
        'name',
        'document_type',
        'document_name',
        'termandcondition',
        'termstype',
        'terms_data',
        'document_file',
        'user_type',
        'user_id',
    ];

    protected $casts = [
        'document_type' => 'array',
        'document_name' => 'array',
        'termandcondition' => 'array',
        'termstype' => 'array',
        'terms_data' => 'array',
        'document_file' => 'array',
    ];

    // Optional: Link to users table if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
