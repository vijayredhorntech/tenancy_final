<?php

namespace App\Repositories\Interfaces;

interface TeamManagementRepositoryInterface
{
    public function getAllTeams();
    public function getTeamById($id);
    public function createTeam(array $data);
    public function updateTeam($id, array $data);
    public function deleteTeam($id);
    public function adTeamMember($data);
    public function DeleteMember($id, $teamid); 
}
