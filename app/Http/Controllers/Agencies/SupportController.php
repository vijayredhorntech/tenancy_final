<?php

namespace App\Http\Controllers\Agencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Agency;
use App\Models\Support;
use App\Models\Message;
use Auth;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class SupportController extends Controller
{

    /****Agency support view page ****/
    public function him_agenciesupport(){
        $id = Auth::user()->id;
        // dd($id); 
        $userData = \session('user_data');
        DatabaseHelper::setDatabaseConnection($userData['database']);
        $user = User::on('user_database')->where('id', $id)->first();
       
        /// Check here what is the id of this in the agency table in superadmin portel
        $agency_data=Agency::where('email',$user->email)->first();
        $conversation=Support::where('agency_id',$agency_data->id)->get(); 
            
        return view('agencies.pages.supports.index',[
            'user'=>$user,
            'agency'=>$agency_data,
            'tickets'=>$conversation
        ]);
    }

    /*** Submit ticket** */

    
    public function him_storeticket(Request $request)
    {
      
        $request->validate([
            'agency_id' => 'required|exists:agencies,id',
            'type' => 'required',
            'priority' => 'required|string|in:low,medium,high',
            'discrubtion' => 'required|string|max:500',
            'document' => 'required|file|mimes:png,jpg,jpeg|max:10240', 
        ]);

        $support = new Support();
    
        // Generate a unique ticket_id
        $support->ticket_id = 'TICKET-' . strtoupper(Str::random(6)) . '-' . time(); 
    
        // Store the uploaded image with a unique name
        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $image = $request->file('document');
            $imageName = 'ticket_' . $support->ticket_id . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/support_images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
        

            $support->images = $imageName;
        } else {
            $support->images = ""; // No image uploaded
        }
    
        // Save other ticket information
        $support->agency_id = $request->agency_id;
        $support->type = $request->type;
        $support->priority = $request->priority;
        $support->description = $request->discrubtion;
        $support->status = "open";
        $support->view_status = "unseen";
    
        // Save the ticket to the database
        $support->save();
        return redirect()->route('agency_support')->with('success', 'Support ticket created successfully!');
    }
    


}
