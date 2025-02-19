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
           $message=Message::where('ticket_code',$details->ticket_id)->get(); 
         
        return view('superadmin.pages.conversation.index',[
            'detials'=>$details,
             'messages'=>$message,
             'current_user'=>$currentUser,
        ]);
    }

    /****Store Conversation****/
    public function hs_storeconversation(Request $request)
        {
  
            $validated = $request->validate([
                'message' => 'required|string', 
                'ticket_number' => 'required', 
                'recevier_id' => 'required',
                'sender_id' => 'required',
            ]);

        
            // Store the message in the database
            $message = new Message();
            $message->message = $validated['message'];
            $message->ticket_code = $validated['ticket_number'];
            $message->receiver_id = $validated['recevier_id'];
            $message->sender_id = $validated['sender_id'];
            $message->type = 'ticket';
            $message->status = 'sent';

            // Save the message
            $message->save();

            if($request->agency=="agency"){
                  
                return redirect()->route('agency.conversation', ['id' => $request->id])
                ->with('status', 'Message sent successfully!');
            }
            return redirect()->route('superadmin.conversation', ['id' => $request->id])
                            ->with('status', 'Message sent successfully!');
        }

        
    }

