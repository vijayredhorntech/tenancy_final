<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Interfaces\TeamManagementRepositoryInterface;

class TeamController extends Controller
{
   
    protected $teamRepository;

    public function __construct(TeamManagementRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function hs_teamManagment()
    {
        $teams = $this->teamRepository->getAllTeams();
        // dd($teams);
        $users=User::get();
        return view('superadmin.pages.teams.index',compact('teams','users'));
    }




    /*****hs Team create *****/
    public function hs_teamStore(Request $request)
    {
        $validatedData = $request->validate([
            'teamname'   => 'required|string|max:255|unique:team_managements,team_name',
            'description' => 'nullable|string|max:500',
            'member'     => 'required|integer|exists:users,id', // Ensure member exists in users table
        ]);

        $teams = $this->teamRepository->createTeam($request->all());
        return redirect()->route('teammanagment')->with('success', 'Created successfully.');
    }


    /*****Store Member**** */
    public function hs_teamMember($id){

        $team=$this->teamRepository->getTeamById($id);
        // dd($team);  
        $users=User::get();
        return view('superadmin.pages.teams.addteammeber',compact('team','users'));
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function hs_teamMemberStore(Request $request)
    {
        $validatedData = $request->validate([
            'teamid'   => 'required',
            'selected_members'=> 'required', // Ensure member exists in users table
        ]);

        $team=$this->teamRepository->adTeamMember($request->all());
        if ($team) {
            return redirect()->route('teammanagment')->with('success', 'Created successfully.');
        } else {
            return redirect()->back()->with('error', 'Not Created.');
        }
    }

    /**
     * View Team view .
     */
    public function hs_teamMemberView($id)
    {
        $team=$this->teamRepository->getTeamById($id);
        return view('superadmin.pages.teams.viewteammeber',compact('team'));
    }

    /**
     * Delete Team Mebbmer 
     ***/

     public function hs_teamMemberDelete($id, $teamid)
     
     {
   
         $teamMember = $this->teamRepository->DeleteMember($id, $teamid);
   
         // Ensure $teamMember is a valid model before deleting
         if ($teamMember) {
             $teamMember->delete(); 
             return redirect()->route('teammanagment')->with('success', 'Deleted successfully.');
         }
     
         return redirect()->route('teammanagment')->with('error', 'Team member not found or deletion failed.');
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
