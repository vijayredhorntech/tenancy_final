<?php

namespace App\Repositories\Interfaces;

interface SPStaffRepositoryInterface
{
    public function all($request);
    public function store($request);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
