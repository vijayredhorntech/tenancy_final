<?php

namespace App\Services;

use App\Providers\RatehawkProvider;
use App\Providers\StubaProvider;
use App\Services\PriceAggregatorService;


class TransformationService
{
    protected $stubaProvider;
//    protected $ratehawkProvider;
    public function __construct(
        StubaProvider         $stubaProvider,
//        RatehawkProvider $ratehawkProvider,
    )
    {
        $this->stubaProvider = $stubaProvider;
//        $this->ratehawkProvider = $ratehawkProvider;

    }
    //stuba Transformation
    public function transformHotels($hotelResults)
    {
        foreach ($hotelResults as $singleHotel) {
            $transformedArray[] = $this->transformHotel($singleHotel);
        }

        return $transformedArray;

    }

    public function transformHotel($singleHotel)
    {
//        dd($this->stubaProvider->fetchMoreHotelDetails($singleHotel['Hotel']["@id"]));

        if (array_key_exists('@id', $singleHotel['Result'])) {
            $singleHotel['Result'] = [$singleHotel['Result']];

        }
        return array(

            "HotelId" => $singleHotel['Hotel']["@id"],
            "HotelName" => $singleHotel['Hotel']['@name'],  // Fill in the hotel name if available
//            "StarRating" => "5", // Fill in the star rating if available$stubaMoreHotelsDetails = $this->stubaProvider->fetchMoreHotelDetails($option);
            "StarRating" =>  $this->stubaProvider->fetchMoreHotelDetails($singleHotel['Hotel']["@id"])['Stars'],
            "Options" => array(
                "Option" => array_map([$this, 'transformOption'], $singleHotel['Result'])

            ),
            "Vendor"=>'Stuba',
        );
    }

    public function transformOption($singleOption)
    {
        if (!isset($singleOption['Room'][0])) {
            $singleOption['Room'] = [$singleOption['Room']];
//            dd('room doesnt have any index',$singleOption);
        }

        if (!isset($singleOption['Room'][0]['MealType'])) {
            $singleOption['Room'][0]['MealType']['@text'] = 'Room Only';
        }

        $optionId = $singleOption["@id"];
        $boardType = $singleOption['Room'][0]['MealType']['@text'];
        $totalPrice = $singleOption['Room'][0]['Price']['@amt'];

        return array(
            "OptionId" => $optionId,
            "OnRequest" => "0",
            "BoardType" => $boardType,
            "TotalPrice" => $totalPrice, // Assuming the total price is the same for all rooms
            "Rooms" => array(
                "Room" => array_map([$this, 'transformRoom'], $singleOption["Room"])
            )
        );
    }

    public function transformRoom($room)
    {

        return array(
            "RoomId" => $room['RoomType'],
            "RoomName" => $room["RoomType"]["@text"],
            "NumAdults" => "NA",
            "NumChildren" => "NA",
            "RoomPrice" => $room["Price"]["@amt"],
            "DailyPrices" => array(
                "DailyPrice" => $room["Price"]["@amt"]
            )
        );
    }

    public function transformDailyPrices()
    {

    }

    public function transformHotelMoreDetails($moreDetails){
        $jsonResult = $moreDetails;
//        dd('ss',$jsonResult);
//        dd('ss',$moreDetails);
        $amenities = isset($jsonResult['Amenity']) && is_array($jsonResult['Amenity']) ? $jsonResult['Amenity'] : [];

        if(!isset($moreDetails['Photo'][0])){
            $jsonResult['Photo'] = [$moreDetails['Photo']];
//dd($moreDetails);
        }
//        if(!isset($moreDetails['Photo'])){
//dd($moreDetails);
////            $moreDetails['Photo'] = [$moreDetails['Photo']];
//        }

if(!isset($amenities[0])){
    $transformedAmenities = [[ "FacilityType" => 'Room Details', // Assuming you want to map 'Code' to 'FacilityType'
            "FacilityName" =>'NA' ],[ "FacilityType" => 'NA', // Assuming you want to map 'Code' to 'FacilityType'
        "FacilityName" =>'NA' ]];

//    dd($transformedAmenities);

}
else{
    $transformedAmenities = array_map(function ($amenity) {
        return [
            "FacilityType" => $amenity['Code'], // Assuming you want to map 'Code' to 'FacilityType'
            "FacilityName" => $amenity['Text'], // Mapping 'Text' to 'FacilityName'
        ];
    }, $amenities);

}

        $transformedDetails = [
            "HotelId" => $jsonResult['Id'],
            "CityId" => $jsonResult['Region']['CityId'],
            "HotelName" =>$jsonResult['Name'],
//        "StarRating" => round($stubaDetails['Rating']['Score'] / 10), // Assuming Score is out of 100
            "StarRating"=>$jsonResult['Stars'],
            "Latitude" => $jsonResult['GeneralInfo']['Latitude'],
            "Longitude" => $jsonResult['GeneralInfo']['Longitude'],
            "Address" => $jsonResult['Address']['Address1'],
            "City" => $jsonResult['Address']['City'],
            "Country" => $jsonResult['Address']['Country'],
            "Location" => $jsonResult['Region']['Name'],
            "PhoneNumber" => $jsonResult['Address']['Tel'],
            "Description" => implode("\n", array_map(function($desc) {
                return $desc['Text'];
            }, $jsonResult['Description'])),
            "Facilities" => [
                "Facility" => $transformedAmenities ,
            ],
            "Images" => [
                "Image" => array_map(function($photo) {
                    return 'https://api.stuba.com'. str_replace("/RXLStagingImages/", "/RXLImages/", $photo['Url']);
                    ;; // Assuming the base URL needs to be appended
                }, $jsonResult['Photo'])
            ]
        ];
//        dd($transformedDetails);
        return $transformedDetails;

    }
//transformStuba policy
public function transformStubaPolicy( $stubaPolicy ){

    $hotelBooking =$stubaPolicy['BookingCreateResult']['Booking']['HotelBooking'];
//    dd($hotelBooking);
    $policies = [];
//dd($stubaPolicy);
if(!isset($hotelBooking[0])){
    $hotelBooking - [$hotelBooking];
}
    foreach ($hotelBooking[0]['Room']['CanxFees']['Fee'] as $policy) {
        $policies[] = [
            "From" => $policy['@from'] ?? date('Y-m-d\TH:i:s'),
            "Type" => "Amount", // Assuming this is always "Amount", modify as needed
            "Value" => $policy['Amount']['@amt'],
        ];
    }

    $policy = [
        "Response" => [
            "Head" => [],
            "Body" => [
                "OptionId" => $hotelBooking[0]['Id']['$'],
                "Currency" => $hotelBooking[0]['TotalSellingPrice']['@xmlns']['@amt'] ?? 'NA',
                "TotalPrice" => $hotelBooking[0]['TotalSellingPrice']['@xmlns']['@amt'] ?? 'NA',
                "CancellationDeadline" => $hotelBooking[0]['Room']['CanxFees']['Fee'][0]['@from'] ?? 'NA',
                "Policies" => [
                    "Policy" => $policies,
                ],
                "Restrictions" => [
                    "Restriction" => "0",
                ],
                "Alerts" => [
                    "Alert" => "0",
                ],
            ],
        ],
    ];
  return $policy;
}


    //rateHawk Transformation
//    ratehawk

    public function transFormRateHawkHotel($allHotel){
        $hotels=$allHotel;
     
        $newFormat = [];

        foreach (  $hotels as $hotel) {
            $newHotel = [
                'HotelId' => $hotel['id'],
                'HotelName' => isset($hotel['hotel_name']) ? $hotel['hotel_name'] :'NA',
                'StarRating' => isset($hotel['star_rating']) ? $hotel['star_rating'] : 'NA',
                'Options' => [
                    'Option' => [], // Initialize an empty 'Option' array
                ],
                "Vendor"=>'RateHawk',
            ];

            foreach ($hotel['rates'] as $rate) {
                $boardType = isset($rate['meal']) ? ($rate['meal'] !== 'nomeal' ? $rate['meal'] : 'Room Only') : 'NA';
                $cancellationPenalties = isset($rate['payment_options']['payment_types'][0]['cancellation_penalties']) ? $rate['payment_options']['payment_types'][0]['cancellation_penalties'] : [];
                $policies = [];

                foreach ($cancellationPenalties['policies'] as $policy) {
                    $policies[] = [
                        "From" => $policy['start_at'] ?? date('Y-m-d\TH:i:s'),
                        "Type" => "Amount", // Assuming this is always "Amount", modify as needed
                        "Value" => $policy['amount_charge'],
                    ];
                }

                $newOption = [
                    'OptionId' => $rate['match_hash'],
                    'OnRequest' => '0', // Assuming this is always 0, modify as needed
                    'BoardType' =>  $boardType,
                    'TotalPrice' => isset($rate['payment_options']['payment_types'][0]['amount']) ? $rate['payment_options']['payment_types'][0]['amount'] : 'NA',
                    'Rooms' => [
                        'Room' => [
                            [
                                'RoomId' => isset($rate['room_id']) ? $rate['room_id'] : 'NA',
                                'RoomName' => isset($rate['room_name']) ? $rate['room_name'] : 'NA',
                                'NumAdults' => isset($rate['num_adults']) ? $rate['num_adults'] : 'NA',
                                'NumChildren' => isset($rate['num_children']) ? $rate['num_children'] : 'NA',
                                'RoomPrice' => isset($rate['room_price']) ? $rate['room_price'] : 'NA',
                                'DailyPrices' => [
                                    'DailyPrice' => isset($rate['daily_prices']) ? $rate['daily_prices'] : [],
                                ],
                            ],
                        ],
                    ],
                    'rg_ext' => isset($rate['rg_ext']) ? $rate['rg_ext'] : [],
                    'cancellation_penalties' => $cancellationPenalties,

                    'fetchPolicies' => [
                        "Response" => [
                            "Head" => [],
                            "Body" => [
                                "OptionId" => $rate['match_hash'],
                                // Assuming this is always GBP, modify as needed
                                "Currency" => isset($rate['payment_options']['payment_types'][0]['currency_code']) ? $rate['payment_options']['payment_types'][0]['currency_code'] : 'NA',
                                "TotalPrice" => isset($rate['payment_options']['payment_types'][0]['amount']) ? $rate['payment_options']['payment_types'][0]['amount'] : 'NA',
                                "CancellationDeadline" =>  $cancellationPenalties['free_cancellation_before'] ?? 'NA',
                                "Policies" => [
                                    "Policy" => $policies,
                                ],
                                "Restrictions" => [
                                    "Restriction" => "0",
                                ],
                                "Alerts" => [
                                    "Alert" => "0"
                                ],
                            ],
                        ],
                    ],
                    'amenities_data' => isset($rate['amenities_data']) ? $rate['amenities_data'] : [],
                    'serp_filters' => isset($rate['serp_filters']) ? $rate['serp_filters'] : [],
                ];

//                $newHotel['Options'][] = ['Option' => $newOption];
                $newHotel['Options']['Option'][] = $newOption;
            }

            $newFormat['Hotel'][] = $newHotel;
        }

//        dd($newFormat);
        return $newFormat;


    }

    public function transFormRateHawkHotelMoreDetails($data){
//        dd($data);
        $hotelData = $this->extractHotelMoreData($data);
        return $hotelData;
//        dd($hotelData);

    }

    public function extractHotelMoreData($data) {

        $amenities = [];
if(!isset($data['data'])){
    // dd($data);
    return 'HotelDetails Not Found';
}

//        if (isset($data['data']['amenity_groups'])) {
        foreach ($data['data']['amenity_groups'] as $group) {
            foreach ($group['amenities'] as $amenity) {
                $amenities[] = $amenity;
            }
        }

        $facilities = [
            [
                "FacilityType" => "Hotel Information",
                "FacilityName" => "Check-in Time: " . $data['data']['check_in_time']
            ],
            [
                "FacilityType" => "Hotel Information",
                "FacilityName" => "Check-out Time: " . $data['data']['check_out_time']
            ],
            ...array_map(function($amenity) {
                return [
                    "FacilityType" => "Amenity",
                    "FacilityName" => $amenity
                ];
            }, $amenities)
        ];

        $hotelData = [
            "HotelId" => $data['data']['id'],
            "CityId" => null,
            "HotelName" => $data['data']['name'],
            "StarRating" => $data['data']['star_rating'],
            "Latitude" => $data['data']['latitude'],
            "Longitude" => $data['data']['longitude'],
            "Address" => $data['data']['address'],
            "Location" => [],
            "Description" => [],
            "PhoneNumber" => $data['data']['phone'],
            "Facilities" => [
                "Facility" => $facilities
            ],
            "Images" => [
                "Image" => array_map(function ($imageUrl) {
                    return str_replace('{size}', 'x500', $imageUrl);
                }, $data['data']['images'])
            ],
            "policy_struct" => $data['data']['policy_struct'],
            "metapolicy_extra_info" => $data['data']['metapolicy_extra_info'],
            "metapolicy_struct" => $data['data']['metapolicy_struct'],
            "payment_methods" => $data['data']['payment_methods'],
            "serp_filters" => $data['data']['serp_filters'],
            "room_groups" => $data['data']['room_groups'],
        ];
//        foreach ($hotelData['Images']['Image'] as $image) {
//            echo '<img src="' . str_replace('{size}', 'x220', $image) . '" alt="Hotel Image">';
//        }
//dd($hotelData);
        return $hotelData;
    }
}


