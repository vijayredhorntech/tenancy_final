<?php

namespace App\Repositories;

use App\Models\TeamManagement;
use App\Models\TeamUser;
use App\Repositories\Interfaces\TeamManagementRepositoryInterface;

class TeamManagementRepository implements TeamManagementRepositoryInterface
{
    public function getAllTeams()
    {
       
        return TeamManagement::with('manager','members.membername')->get();

    }

    public function getTeamById($id)
    {
        return TeamManagement::with('manager','members.membername')->where('id',$id)->first();
    }

    public function createTeam(array $data)
    {
      
         $team=new TeamManagement(); 
        $team->team_name=$data['teamname'];
        $team->description=$data['description'];
        $team->manager_id=$data['member'];
        $team->save(); 
        return $team; 
    }

    public function adTeamMember($data){
      
        // Convert selected_members to an array
    $selectedMembersArray = explode(',', $data['selected_members']);

    // Insert each member into the team
    foreach ($selectedMembersArray as $memberId) {
        $memberId = trim($memberId); // Ensure no spaces

        // Check if already exists to prevent duplicates (Optional)
        if (!TeamUser::where('user_id', $memberId)->where('team_management_id', $data['teamid'])->exists()) {
            $teamMember = new TeamUser();
            $teamMember->user_id = $memberId;
            $teamMember->team_management_id = $data['teamid'];
            $teamMember->save();
        }
    }

    return true; 
    }

    public function DeleteMember($id, $teamid){
        $team=TeamUser::where('user_id',$id)-> where('team_management_id',$teamid)->first();
         return $team; 
    }

    public function updateTeam($id, array $data)
    {
        $team = TeamManagement::findOrFail($id);
        $team->update($data);
        return $team;
    }

    public function deleteTeam($id)
    {
        return TeamManagement::destroy($id);
    }
}
