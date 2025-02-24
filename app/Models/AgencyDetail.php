<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class AgencyDetail extends Model
{
    use HasFactory; 


      /**
     * Get the agency associated with this detail.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * Get the user associated with this detail.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
