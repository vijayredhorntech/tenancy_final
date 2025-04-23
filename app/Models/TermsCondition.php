<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsCondition extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'terms_conditions';
}
