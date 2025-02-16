<?php

namespace App\Models;

use App\Models\FlightSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'markupType',
        'markupValue',
        'fareType',
        'type',
        'validFrom',
        'validTill',
    ];
}
