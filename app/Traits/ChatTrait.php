<?php

namespace App\Traits;

use App\Models\Message;

trait ChatTrait
{
    public function clientChats()
    {
        return $this->hasMany(Message::class, 'client_id', 'id')
                    ->where('sender_user_type', 'client');
    }

    public function agencyChats()
    {
        return $this->hasMany(Message::class, 'client_id', 'id')
                    ->where('sender_user_type', 'agency');
    }

    /****Store chat*** */
    public function getStoreClient($data, $ticket_code, $type, $filename, $agencyid, $clientid, $loginuserid)
    {
        $message = new Message();
        $message->ticket_code = $ticket_code;
        $message->sender_id = $data->sender_id;
        $message->receiver_id = $data->recevier_id;
        $message->message = $data->message ?? null;
        $message->type = $data->type;
        $message->attachments = $filename ? json_encode([$filename]) : null;
        $message->status = 'sent';
        $message->agency_id = $agencyid;
        $message->sender_user_type = $type;
        $message->uploaded_file = $filename;
        $message->main_userid = $loginuserid;
        $message->client_id = $clientid;
        $message->save();
    
        return $message;
    }
    
    // Add other common chat logic methods if needed
}
