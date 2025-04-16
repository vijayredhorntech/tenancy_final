<?php
// app/Providers/TravellandaProvider.php

namespace App\Providers;

use App\Services\TravellandaService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TravellandaProvider
{
    private $travellandaService;

    public function __construct()
    {
        $this->travellandaService = new TravellandaService();
    }

    public function fetchPrices($searchParams)
    {
        // dd($searchParams);
        $searchParams['checkIn'] = $searchParams['checkInDate'];
        // $searchParams['checkIn'] = Carbon::parse( \DateTime::createFromFormat("D M d Y H:i:s eO", $searchParams['checkInDate']))->format('Y-m-d');
        $searchParams['checkOut'] = $searchParams['checkOutDate'];
        // $searchParams['checkOut'] = Carbon::parse( \DateTime::createFromFormat("D M d Y H:i:s eO", $searchParams['checkOutDate']))->format('Y-m-d');
        $xmlRequest = $this->travellandaService->buildSearchRequest($searchParams);

    //    dd($xmlRequest);
        return $this->travellandaService->sendRequest($xmlRequest);

    }
    public function fetchPolicies($options)
    {
        $xmlRequest = $this->travellandaService->buildPolicyRequest($options);
        return $this->travellandaService->sendRequest($xmlRequest);
    }

    public function bookHotel($options)
    {
        $xmlRequest = $this->travellandaService->buildBookingRequest($options);
        return $this->travellandaService->sendRequest($xmlRequest);
    }



    public function fetchHotelDetails($options)
    {
        $xmlRequest = $this->travellandaService->buildHotelDetailsRequest($options);
        return $this->travellandaService->sendRequest($xmlRequest);
    }

    public function fetchBulkHotelDetails($options)
    {
        $xmlRequest = $this->travellandaService->bulkHotelDetailsRequest($options);
        return $this->travellandaService->sendRequest($xmlRequest);
    }






}
