<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'fromdocuments'; // Set custom table name

    protected $fillable = ['form_name', 'form_description', 'form_html', 'document'];


    public function countries(){
        return $this->hasMany(VisaServiceTypeDocument::class, 'form_id','id');
    }
}
