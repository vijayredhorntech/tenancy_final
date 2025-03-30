<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{
    //

    public function clientinfo()
    {
        return $this->hasOne(ClientMoreInfo::class, 'clientid', 'id');
    }

    
}
