<?php

namespace App\Repositories;

use App\Models\Visa;
use App\Models\Country;
use App\Models\VisaServices;

use App\Repositories\Interfaces\VisaRepositoryInterface;

class VisaRepository implements VisaRepositoryInterface
{
    

    public function getAllCountry(){

       return Country::paginate(10);
    }


    public function getAllVisas()
    {
        return VisaServices::paginate(10);
    }
    public function getVisaById($id)
    {
        return Visa::find($id);
    }

    public function createVisa(array $data)
    {
        return Visa::create($data);
    }

    public function updateVisa($id, array $data)
    {
        $visa = Visa::findOrFail($id);
        $visa->update($data);
        return $visa;
    }

    public function deleteVisa($id)
    {
        return Visa::destroy($id);
    }
}
