<?php

namespace App\Repositories\Interfaces;

interface VisaRepositoryInterface
{
    public function getAllVisas();
    public function getVisaById($id);
    public function createVisa(array $data);
    public function updateVisa($id, array $data);
    public function deleteVisa($id);
    public function getAllCountry(); 
}
