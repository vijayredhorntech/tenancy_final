<?php

namespace App\Services;
use App\Services\PriceAggregatorService;
class FilterService
{
    private $returnFilteredHotels;

    public function __construct(PriceAggregatorService $priceAggregatorService)
    {

        $this->returnFilteredHotels = [];
        $this->priceAggregatorService = $priceAggregatorService;
    }

    public function ratingFilter($hotelData, $ratings)
    {
        $refinedHoteldata = $hotelData;

        $minValues = array_map(function ($innerArray) {
            return min(array_map('intval', $innerArray));
        }, $ratings);
        $minVal = min($minValues);

        $filteredHotels = array_filter($refinedHoteldata, function ($hotel) use ($minVal) {
            $starRating = intval($hotel["StarRating"]);
            return $starRating == $minVal;
        });
        return $filteredHotels;
    }

    public function boardTypeFilter($hotelDataLists, $boardType)
    {
        // dd($hotelDataLists);
        $filteredHotels = array_filter($hotelDataLists, function ($hotel) use ($boardType) {
            $boardTypes = $boardType[0];
            return $this->hasBoardType($hotel, $boardTypes);
        });
        // dd($filteredHotels);
        return $filteredHotels;
    }

    public function propertyNameFilter($property_name)
    {
        $availableAllHotels = session('availableHotels');
         dd("jkdfd",$availableAllHotels);
        $filteredHotels = array_filter($hotelDataLists, function ($hotel) use ($property_name) {
            return stripos($hotel['HotelName'], $property_name[0]) !== false;
        });

        return $filteredHotels;
    }

    public function sortByFilter($hotelDataLists, $sortBy)
    {

        if ($sortBy && $sortBy[0][0] === "Price Low to High") {
            usort($hotelDataLists, function ($a, $b) {
                $priceA = isset($a['Options']['Option'][0]['TotalPrice']) ? (float)$a['Options']['Option'][0]['TotalPrice'] : 0;
                $priceB = isset($b['Options']['Option'][0]['TotalPrice']) ? (float)$b['Options']['Option'][0]['TotalPrice'] : 0;

                return $priceA <=> $priceB;
            });
        } elseif ($sortBy && $sortBy[0][0] === "Price High to Low") {
            usort($hotelDataLists, function ($a, $b) {
                $priceA = isset($a['Options']['Option'][0]['TotalPrice']) ? (float)$a['Options']['Option'][0]['TotalPrice'] : 0;
                $priceB = isset($b['Options']['Option'][0]['TotalPrice']) ? (float)$b['Options']['Option'][0]['TotalPrice'] : 0;

                return $priceB <=> $priceA;
            });
        }
        return $hotelDataLists;
    }
    public function budgetRangeFilter($hotelDataLists, $budgetRange)
    {
        $budgetRange[0] = floatval($budgetRange[0]);

        $filteredHotels = array_filter($hotelDataLists, function ($hotel) use ($budgetRange) {
            if (isset($hotel['Options']['Option'])) {
                $options = $hotel['Options']['Option'];

                // Check if 'Option' is an indexed array
                if (is_array($options) && array_keys($options) === range(0, count($options) - 1)) {
                    $filteredOptions = array_filter($options, function ($option) use ($budgetRange) {
                        $totalPrice = floatval($option['TotalPrice']);
                        return $totalPrice <= $budgetRange[0];
                    });
                } else {
                    // If 'Option' is not an indexed array (i.e., it's an associative array or a single option)
                    $totalPrice = floatval($options['TotalPrice']);
                    $filteredOptions = $totalPrice <= $budgetRange[0] ? [$options] : [];
                }
            } else {
                // Handle the case when 'Option' key doesn't exist in 'Options'
                $filteredOptions = [];
            }

            return !empty($filteredOptions);
        });

        // dd($filteredHotels);

        return $filteredHotels;
    }

    public function budgetRangeFilter1($hotelDataLists, $budgetRange)
    {
        // dd($hotelDataLists,$budgetRange);
        $budgetRange[0] = floatval($budgetRange[0]);

        $filteredHotels = array_filter($hotelDataLists, function ($hotel) use ($budgetRange) {
if(isset($hotel['Options']['Option'][0])) {


            $filteredOptions = array_filter($hotel['Options']['Option'], function ($option) use ($budgetRange) {

                $totalPrice = floatval($option['TotalPrice']);
                return $totalPrice <= $budgetRange[0];
            });
        }
        else {
            $filteredOptions = floatval($hotel['Options']['Option']['TotalPrice']) <= $budgetRange[0] ;
        return $filteredOptions;
        }

            return !empty($filteredOptions);
        });

// dd($filteredHotels);
        return $filteredHotels;
    }

    //////////////////////more functions ///////////////////////////

    // function hasBoardType($hotel, $boardTypes)
    // {
    //     // dd("hotel and boradTypes",$hotel, $boardTypes);
    //     foreach ($hotel['Options']['Option'] as $option) {
    //         // var_dump($option);
    //         // dd("hotel and boradTypes",$option['BoardType'], $boardTypes[0]);
    //         if ($option['BoardType'] == $boardTypes[0]) {

    //             return true;
    //         }
    //     }
    //     return false;
    // }

    function hasBoardType15($hotel, $boardTypes)
    {

        foreach ($hotel['Options']['Option'] as $option) {

            // dd($option['BoardType'], $boardTypes);
            // var_dump($option);
            if ($option['BoardType'] == $boardTypes) {

                return true;
            }
        }

        return false;
    }

    function hasBoardType($hotel, $boardTypes)
    {
    //   dd($hotel);
        // Ensure that the expected keys exist in the hotel array
        if (!isset($hotel['Options'], $hotel['Options']['Option'])) {
            return false;
        }

        $boardTypesInHotel = array_column($hotel['Options']['Option'], 'BoardType');
    // dd($boardTypesInHotel);
        // Use array_intersect to find common elements between $boardTypesInHotel and $boardTypes
        return !empty(array_intersect($boardTypes, $boardTypesInHotel));
    }
    function nearestHotels() {

    }
    function distanceFilter ($hotels, $distanceCoords) {
        $coordinates = explode(",",$distanceCoords[0][0]);
        $lat1 = $coordinates[1];
        $lon1 = $coordinates[0];
        $filterHotels = array_filter($hotels,function($hotel) use ($lat1, $lon1) {
//            dd($hotel['HotelId']);
            $getHotelMoreDetails = $this->priceAggregatorService->fetchHotelDetails($hotel['HotelId']);
            $getHotelCoordinates= $getHotelMoreDetails['Response']['Body']['Hotels']['Hotel'];
            $getHotelLat = $getHotelCoordinates['Latitude'];
            $getHotelLong = $getHotelCoordinates['Longitude'];
            $distance = distanceBetweenTwoCoords($lat1,$lon1,$getHotelLat,$getHotelLong);
//            dd([['selected_poi_lat'=>$lat1],['selected_poi_lon'=>$lon1],['selected_hotel_lat'=>$getHotelLat],['selected_hotel_lon'=>$getHotelLong]]);
//dd($distance);
//            dd($distance);
            return $distance < 2;
});
//dd($filterHotels);
        return $filterHotels;
    }



}
