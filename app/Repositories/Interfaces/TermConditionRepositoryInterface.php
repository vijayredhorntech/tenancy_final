<?php

namespace App\Repositories\Interfaces;

interface TermConditionRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function termsConditions($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function termTypeCreate(array $data);
    public function allTeamTypes();
    public function termTypeGetById($id);
}
