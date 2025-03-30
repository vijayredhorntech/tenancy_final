<?php

namespace App\Repositories;

use App\Models\Staff;

class StaffRepository implements StaffRepositoryInterface
{
    public function all()
    {
        return Staff::all();
    }

    public function find($id)
    {
        return Staff::findOrFail($id);
    }

    public function create(array $data)
    {
        return Staff::create($data);
    }

    public function update($id, array $data)
    {
        $staff = Staff::findOrFail($id);
        $staff->update($data);
        return $staff;
    }

    public function delete($id)
    {
        return Staff::destroy($id);
    }
}
