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
    public function findFormById($id);
    public function assignCountrytoForms($id, $data);
    public function assignUpdateBooking($id,$data);
    public function viewCoutnryFormById($id);
    public function disConnectCoutnryFormById($id); 
    public function deleteBooking($id); 
    public function sendEmail(array $data, $agency);
    public function sendToAdmin($id);
    public function getSuperadminAllApplication();
    public function getDataByClientId($id);
    public function getPendingDocumentByCID($clientId);
    public function storeClientDocuemtn($data);
    public function getBookingBySingleId($id);
    public function getSuperadminshotedapplication($request);
    public function getPendingBookingByid($id);
    public function payment($data);
    public function checkBalance($id,$totalAmount);
    public function updateClientBooking($id,$data);
    public function createClientBooking($id,$data);
    public function updateVisaAssignment(array $data, int $id);
    public function visadocumentstore($data);


   

    
}
