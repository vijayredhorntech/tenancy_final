<?php

// app/Providers/RatehawkProvider.php

namespace App\Providers;

use App\Services\RatehawkService;
use App\Services\StubaService;
use App\Services\TravellandaService;
use Illuminate\Support\Facades\Http;
use App\Services\TransformationService;


class RatehawkProvider
{
    protected $apiKey;
    protected $transformationService;

    public function __construct( TransformationService $transformationService )
    {
        $this->apiKey = config('services.ratehawk.api_key');
        $this->ratehawkService = new RatehawkService();
        $this->transformationService = $transformationService;
    }

    public function availableHotels($searchParams) {
        $result = $this->ratehawkService->buildSearchRequest($searchParams);
     
        $decodeResult = json_decode($result,true);
        $hotels=$decodeResult['data']['hotels'];
     
//        dd($hotels[0]['rates'][0]);
        if($hotels==null){
            dd('hoels not found');
        }
        $formatedHotel=$this->transformationService->transFormRateHawkHotel($hotels);
     
    //    dd("hh",$formatedHotel);
        return $formatedHotel;
//        dd('ssseseasfcxce',$formatedHotel,$this->moreDetailsOfRatehawkHotel($formatedHotel['Hotel'][0]['HotelId']));

    }

    public function moreDetailsOfRatehawkHotel($singleHotelID){


//        dd("hheee", $singleHotelID);
        $result = $this->ratehawkService->fetchSingleRatehawkHotels($singleHotelID);
        $decodeResult=json_decode($result,true);
//        dd("result of moreDetails is ", $decodeResult);
        $formatedHotel=$this->transformationService->transFormRateHawkHotelMoreDetails($decodeResult);
        return $formatedHotel;
    }


    public function fetchPrices($searchParams)
    {
//        Customize the API endpoint and request parameters as needed
        $endpoint = 'https://ratehawk-api.com/hotels/search';

        $response = Http::get($endpoint, [
            'api_key' => $this->apiKey,
            'search_params' => $searchParams,
        ]);

        // Check for a successful response
        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle errors or return an empty result
            return [];
        }

    }


}
