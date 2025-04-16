<?php

namespace App\Services;

use GuzzleHttp\Client;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

class RatehawkService
{

    protected $key_id;
    protected $api_key;
    protected $endpoint;
    protected $authority;

    public function __construct()
    {
        $this->key_id = config('services.rate_hawk.key_id');
        $this->api_key = config('services.rate_hawk.api_key');
        $this->endpoint = config('services.rate_hawk.endpoint');
        $this->loginOrganization = 'cloudtravel';
        $this->currency = 'GBP';
    }

    public function buildSearchRequest($searchParams)
    {
        $region_id = 684;  //965849721    684
        $checkin = $searchParams['checkInDate'];
        $checkout = $searchParams['checkOutDate'];
        $totalNights = Carbon::create($checkin)->diffInDays($checkout);
        $language = "en";
        $currency = 'EUR';
        $residency = 'gb';
        $guests = [
            [
                "adults" => 2,
                "children" => []
            ]
        ];


        $body = [
            "checkin" => $checkin,
            "checkout" => $checkout,
            "residency" => $residency,
            "language" => $language,
            "guests" => $guests,
            "region_id" => $region_id,
            "currency" => $currency
        ];

        // dd($this->key_id);
        // dd('Basic ' . base64_encode($this->key_id . ':' . $this->api_key));
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.worldota.net/api/b2b/v3/search/serp/region/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($this->key_id . ':' . $this->api_key),
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        if ($response === false) {
            $error = curl_error($curl);
            dd("Curl error: " . $error);
        }
        curl_close($curl);
        return $response;


//        echo storage_path('cacert.pem');

//        $client = new Client([
//            'verify' => 'path/to/cacert.pem', // Path to the cacert.pem file
//        ]);
//
//        $headers = [
//            'Content-Type' => 'application/json',
//            'Authorization' => 'Basic ' . base64_encode($this->key_id . ':' . $this->api_key),
//        ];
//
//        $body = [
//            "checkin" => $checkin,
//            "checkout" => $checkout,
//            "residency" => $residency,
//            "language" => $language,
//            "guests" => $guests,
//            "region_id" => $region_id,
//            "currency" => $currency
//        ];
//        dd($body);

//        $request = new Request('POST', 'https://api.worldota.net/api/b2b/v3/search/serp/region/', $headers,json_encode($body));
//        $res = $client->sendAsync($request)->wait();
////        echo $res->getBody();
//        return  $res;

    }

    public function fetchSingleRatehawkHotels($singleHotelID)
    {
        $hotelId = $singleHotelID;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.worldota.net/api/b2b/v3/hotel/info/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "id" => $hotelId,
                "language" => "en"
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($this->key_id . ':' . $this->api_key),
            ),

        ));

        $response = curl_exec($curl);
        curl_close($curl);
       return $response;

    }


}
