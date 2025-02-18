<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Message;
use Illuminate\Http\Request;
use Auth; 

class ConversationController extends Controller
{

    public function hs_viewticket(){
   
  
        $conversation=Support::with('agency')->get();   
    
        return view('superadmin.pages.conversation.viewticket',[
            'tickets'=>$conversation,
        ]);
    }

    public function hs_conversation($id)
    {

        $currentUser = auth()->user();
          $details=Support::with('agency')->where('id',$id)->first(); 
           $message=Message::where('ticket_id',$details->ticket_id)->get(); 
        return view('superadmin.pages.conversation.index',[
            'detials'=>$details,
             'messages'=>$message,
             'current_user'=>$currentUser,
        ]);
    }

    /****Store Conversation****/
    public function hs_storeconversation(Request $request)
        {
            // Validation rules
            $validated = $request->validate([
                'message' => 'required|string', 
                'ticket_id' => 'required|exists:tickets,id', 
                'receiver_id' => 'required|exists:users,id',
                'sender_id' => 'required|exists:users,id',
            ]);

            // Store the message in the database
            $message = new Message();
            $message->message = $validated['message'];
            $message->ticket_id = $validated['ticket_id'];
            $message->receiver_id = $validated['receiver_id'];
            $message->sender_id = $validated['sender_id'];
            $message->type = 'ticket';
            $message->status = 'sent';

            // Save the message
            $message->save();

            return redirect()->route('superadmin.conversation', ['id' => $validated['id']])
                            ->with('status', 'Message sent successfully!');
        }

        
    }

