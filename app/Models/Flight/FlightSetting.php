<?php

namespace App\Models\Flight;

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
