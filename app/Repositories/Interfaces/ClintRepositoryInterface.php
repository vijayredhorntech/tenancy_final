<?php

namespace App\Repositories\Interfaces;

interface ClintRepositoryInterface
{
    public function getAllClint($data);
    public function getStoreclint(array $data);
    public function getClientById($id);
    public function updateStoreclint($id,$data);
  
}
