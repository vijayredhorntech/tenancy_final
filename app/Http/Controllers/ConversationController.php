<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\Message;
use Illuminate\Http\Request;
use Auth; 
use App\Repositories\Interfaces\ClintRepositoryInterface;
use App\Traits\ChatTrait;
use App\Models\Agency;
use Illuminate\Support\Str;

class ConversationController extends Controller
{

    use ChatTrait;

    protected $clintRepository;

    public function __construct( ClintRepositoryInterface $clintRepository) {
          $this->clintRepository = $clintRepository;
    }

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


        public function hs_editConversation($id){

            $details=Support::with('agency')->where('id',$id)->first(); 
           
            return view('superadmin.pages.conversation.editticket',[
                'ticketinformation'=>$details,
            ]);
    
          
        }


        public function hs_editStore(Request $request){
            $request->validate([
                'ticketid' => 'required|integer|exists:supports,id', 
                'status' => 'required|string|in:closed,in-progress,resolved',
                'view_status' => 'required|string|in:seen',
            ],[
                'status.in' => 'The status is already open.',  
                'view_status.in' => 'The view status is already unseen.',  
            ]);

            $details=Support::where('id',$request->ticketid)->first(); 
            $details->status=$request->status; 
            $details->view_status=$request->view_status;
            $details->save(); 
            return redirect()->route('superadmin.ticket')->with('status', 'Message sent successfully!');
           

        }

          /****Chat process **** */
    public function hs_chatSAApplication($id, $token = null){
 
         $agency = Agency::where('agencytoken',$token)->first();

        // $agency = Agency::where('id',$client->agency_id)->first();
        // dd($id);
        $client = $this->clintRepository->getClientById($id,$agency->database_name);
        
        return view('superadmin.pages.conversation.chat',compact('client','agency'));
       }


    //    public function delete(Request $request)
    //     {
    //         Message::find($request->id)->delete();
    //         return response()->json(['success' => true]);
    //     }
        public function delete(Request $request)
    {
        $chat = Message::find($request->id);

        if (!$chat) {
            return response()->json(['success' => false, 'message' => 'Message not found'], 404);
        }

        $chat->is_delete = true;
        $chat->deleted_at_manual = now();
        $chat->deleted_user_id = auth()->id(); // optional
        $chat->save();

        return response()->json(['success' => true]);
    }




      public function update(Request $request)
        {
            $chat = Message::find($request->id);

            if (!$chat) {
                return response()->json(['success' => false, 'message' => 'Message not found'], 404);
            }

            $chat->message = $request->message;
            $chat->is_edit = true; 
            $chat->edited_at = now(); 
            $chat->updated_user_id = auth()->id(); // optional log
            $chat->save();

            return response()->json(['success' => true]);
        }



    public function hs_sendMessageSAApplication(Request $request){
      
        $request->validate([
            'message' => 'required_without:attachment|string|max:1000',
            'type' => 'required|string|max:255',
            'clientid'=>'required|integer',
            'recevier_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
        ]);

   

        // Handle file upload
        $filename = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->store('messages', 'public'); // stored in storage/app/public/messages
        }
      

        $agency = Agency::where('id',$request->sender_id)->first();

        $ticket_code = 'TICKET-' . strtoupper(Str::random(6)) . '-' . time();
        $type = 'superadmin';
        $clientid = $request->clientid;
        $agencyid = $agency->id;
        $loginuserid=Auth::user()->id;  

        // Now call the function properly
        $support = $this->getStoreClient($request, $ticket_code, $type, $filename, $agencyid, $clientid,$loginuserid);
       
        

        return response()->json([
            'success' => true,
            'message' => $support
        ]);

}
    

        
    }

