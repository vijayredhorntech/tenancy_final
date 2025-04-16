<?php
// app/Providers/StubaProvider.php

namespace App\Providers;

use App\Services\StubaService;

use App\Services\TravellandaService;
use Illuminate\Support\Facades\Http;

class StubaProvider
{
    private $stubaService;
    public function __construct()
    {
        $this->stubaService = new StubaService();
        $this->travellandaService = new TravellandaService();
    }
    public function fetchPrices($searchParams)
    {
        $fetchPrices = $this->stubaService->searchHotels($searchParams);
        return $fetchPrices;
//        return Http::get('https://stuba-api.com/prices')->json();
    }
    public function availableHotels($searchParams) {
        $xmlRequest = $this->stubaService->buildSearchRequest($searchParams);

        return $this->stubaService->sendRequest($xmlRequest);

    }
   public function bookHotelRequest($guests,$quoteId,$commitType){
       $xmlRequest = $this->stubaService->buildBookRequest($guests,$quoteId,$commitType);
//dd($xmlRequest);
       return $this->stubaService->sendRequest($xmlRequest);

   }


    public function fetchMoreHotelDetails($hotelId){
        $xmlFilePath = storage_path('app/HotelDetailXML/' . $hotelId . '.xml');
        if (!file_exists($xmlFilePath)) {
            die('XML file not found.');
        }
        $xmlString = file_get_contents($xmlFilePath);
        $xml = simplexml_load_string($xmlString);
        $jsonResult = json_encode($xml, JSON_PRETTY_PRINT);
        return json_decode($jsonResult, true);
//        return $jsonResult;
    }
    public function fetchSingleHotel($searchParams){
        $xmlRequest = $this->stubaService->buildSingleSearchRequest($searchParams);

        return $this->stubaService->sendRequest($xmlRequest);
    }

}
