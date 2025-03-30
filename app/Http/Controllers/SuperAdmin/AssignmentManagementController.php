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
use App\Repositories\Interfaces\TeamManagementRepositoryInterface;



class AssignmentManagementController extends Controller
{
    
    protected $teamRepository;

    public function __construct(TeamManagementRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }


    public function hs_index(){
      
         $user = auth()->user(); 
        $teams = $this->teamRepository->getAllTeams();
        // dd($teams);
        // dd($teams);
        $users=User::get();
        // $assignments =Assignment::with('user')->get();
      
            // Superadmin can see all records
            $assignments = Assignment::with('user')->get();
            $studentteams = Assignment::with('team', 'teammember')
            ->where('assign_to', 'team')
            ->whereNotIn('status', ['completed', 'canceled']) // Excludes both statuses
            ->get();
        
            $filteredTeams = $studentteams->filter(function ($assignment) {
                return $assignment->teammember->contains('user_id', auth()->id());
            });

            $userassignement = Assignment::with('team', 'teammember')
            ->where('assign_to', 'user')
            ->where('assign_id',auth()->id())
            ->whereNotIn('status', ['completed', 'canceled']) // Excludes both statuses
            ->get();
        
            $completeassignment=Assignment::with('team', 'teammember')
                 ->where('closeuserid',auth()->id()) // Excludes both statuses
                 ->get();
            //  dd($completeassignment);
         
         
          return view('superadmin.pages.assignment.assignment',compact('assignments','teams','users','filteredTeams','userassignement','completeassignment'));

    }




    public function hs_assignment_store(Request $request)
    {
      

        $validatedData = $request->validate([
            'title'       => 'required',
            'duedate'     => 'required|date|after_or_equal:today',
            'description' => 'nullable|string|max:1000',
            'sendfor'     => 'required|in:team,user',
            'team'        => 'required_if:sendfor,team', // Required if "sendfor" is "team"
            'user'        => 'required_if:sendfor,user', // Required if "sendfor" is "user"
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
        $assignment->images = json_encode($imagePaths); // Store images as JS
        $assignment->assign_to = $request->sendfor;
        if($request->sendfor=="team"){
            $assignment->assign_id = $request->team;
        }else{
            $assignment->assign_id = $request->user;
        }
      
        $assignment->save();

        // dd("heelo"); 
        return back()->with('success', 'Assignment created successfully!');
    }


   public function hs_assignment_edit($id){

    $assignment =Assignment::with('user')->where('id',$id)->first();

    return view('superadmin.pages.assignment.editassignment',compact('assignment'));
    
   }

   
   public function hs_assignment_editstore(Request $request)
   {
       // Find the assignment by ID
       $validatedData = $request->validate([
                'id'       => 'required|exists:assignments,id',
                'status'   => 'required|in:completed,canceled',
                'remark'   => 'nullable|string|max:500',
            ]);
            // dd("heelo"); 
       $assignment = Assignment::find($request->id);
   
       if (!$assignment) {
           return redirect()->route('assignment')->with('error', 'Assignment not found');
       }
   
       // Update assignment fields
       $assignment->close_time = Carbon::now()->toTimeString();
       $assignment->status = $request->status;
       $assignment->reason = $request->remark;
       $assignment->closeuserid = auth()->id(); // Set closing user ID
   
       $assignment->save(); // Save the updated assignment
   
       return redirect()->route('assignment')->with('message', 'Update successful');
   }


   public function hs_staffAssignmentView($id){
    
    $assignment =Assignment::with('user')->where('id',$id)->first();

    return view('superadmin.pages.assignment.singleassignment',compact('assignment'));
    // return view('assignments.show', compact('assignment'));
    // 
   }
   
    
}
