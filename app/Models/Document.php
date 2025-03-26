<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'fromdocuments'; // Set custom table name

    protected $fillable = ['form_name', 'form_description', 'form_html', 'document'];
}
