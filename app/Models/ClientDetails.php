<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
class ClientDetails extends Authenticatable
{
    //
    use SoftDeletes;

    public function clientinfo()
    {
        return $this->hasOne(ClientMoreInfo::class, 'clientid', 'id');
    }

    
    public function clientChats()
    {
        return $this->hasMany(Message::class, 'client_id', 'id');
                    // ->where('sender_user_type', 'client');
    }

    
}
