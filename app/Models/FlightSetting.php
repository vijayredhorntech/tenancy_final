<?php

namespace App\Models;

use App\Models\FlightSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightSetting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'markupType',
        'markupValue',
        'fareType',
        'type',
        'validFrom',
        'validTill',
    ];
}
