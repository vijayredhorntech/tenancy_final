<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginDetail;
use Illuminate\Support\Carbon;
use Auth; 
use App\Models\User;
use App\Models\ApplyUserLeave;
use App\Models\Assignment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class AssignmentManagementController extends Controller
{
    
    public function hs_index(){
      
        $assignments =Assignment::with('user')->get();
          return view('superadmin.pages.assignment.assignment',compact('assignments'));

    }




    public function hs_assignment_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duedate' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $imagePaths = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $destinationPath = public_path('images/assignment/assignmentpic/');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $fileName = 'assignment_' . auth()->id() . '_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $fileName);

                $imagePaths[] =  $fileName; // Store relative path
            }
        }

        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->assigned_by = Auth::id();
        $assignment->due_date = $request->duedate; // Fixed field name
        $assignment->assign_date = Carbon::now()->toDateString(); // Set assign date to today
        $assignment->assign_time = Carbon::now()->toTimeString(); // Set assign time to current time
        $assignment->close_time = $request->close_time ?? null; // Allow nullable close time
        $assignment->reason = $request->reason;
        $assignment->status = 'pending'; // Default status set to "pending"
        $assignment->images = json_encode($imagePaths); // Store images as JSON
        $assignment->save();

        return back()->with('success', 'Assignment created successfully!');
    }


   public function hs_assignment_edit($id){

    $assignment =Assignment::with('user')->where('id',$id)->first();

    return view('superadmin.pages.assignment.editassignment',compact('assignment'));
    
   }

   
   public function hs_assignment_editstore(Request $request)
   {
       $assignment = Assignment::find($request->id);
   
       if ($assignment) {
           $assignment->close_time = Carbon::now()->toTimeString();
           $assignment->status = $request->status;
           $assignment->reason = $request->remark;
           $assignment->save();
   
           return redirect()->route('assignment')->with('message', 'Update successful');
       }
   
       return redirect()->route('assignment')->with('error', 'Assignment not found');
   }
   
    
}
