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
    public function assignVisaToCountry(array $data);
    public function getVisabySearch($orgin,$destination); 
    public function allVisacoutnry(); 
    public function getVisabySearchcoutnry($id); 
    public function saveBooking(array $data); 
    public function getBookingByid($id,$type); 
    public function allForms();
    public function storeForms(array $data);
    public function bookingDataById($id);
}
