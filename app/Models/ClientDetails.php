<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDetails extends Model
{
    //
    use SoftDeletes;

    public function clientinfo()
    {
        return $this->hasOne(ClientMoreInfo::class, 'clientid', 'id');
    }

    
}
