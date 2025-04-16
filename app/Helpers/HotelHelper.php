<?php
use App\Services\PriceAggregatorService;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


function hotelDetails($hotelId,PriceAggregatorService $priceAggregatorService) {


    $moreDetails = $priceAggregatorService->fetchHotelDetails($hotelId);
//dd($moreDetails);
    if((isset($moreDetails['Response']['Body']['Hotels']['Hotel']))>0){

    return $moreDetails['Response']['Body']['Hotels']['Hotel'];
    }
    else{
        return [];
    }
}
function stubaHotelDetails($hotelId,PriceAggregatorService $priceAggregatorService) {


    $moreDetails = $priceAggregatorService->fetchStubaHotelDetails($hotelId);
//dd($moreDetails);
//    return $moreDetails['Response']['Body']['Hotels']['Hotel'];
    return $moreDetails;
}
function ratehawkHotelDetails($hotelId,PriceAggregatorService $priceAggregatorService) {


    $moreDetails = $priceAggregatorService->fetchRateHawkHotelDetails($hotelId);
//dd($moreDetails);
//    return $moreDetails['Response']['Body']['Hotels']['Hotel'];
    return $moreDetails;
}



function fetchAvailableHotel(){
    if(session()->get('availableHotels')){
        $availableHotel = session()->get('availableHotels');
    }
    else {
        $availableHotel = [];
    }
    return 'test';
}

function makeArrayWithIndex($arrayParameters) {
    // declaraing empty array
    $emptyArray = [];
    // storing the paramater in empty array
    $emptyArray = $arrayParameters;
    // $hotelArray = $paginatedHotels;
    // make empty the original array
    $arrayParameters = [];
    // inserting back to paramater;
    $arrayParameters[0] = $emptyArray;
    // now returning back the formed array with index;
    // dd($arrayParameters);
    return $arrayParameters;
}


function customPagination($arrayData) {
    $perPage = 5;
    $page = request()->get('page', 1);

    $offset = ($page - 1) * $perPage;

    $currentPageItems = array_slice($arrayData, $offset, $perPage);
    $paginator = new LengthAwarePaginator(
        $currentPageItems,
        count($arrayData),
        $perPage,
        $page,
        [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',

        ]
    );
    // $paginator->appends(['searchParams' =>$request->all()]);
    $paginator->withQueryString();
    return $paginator;
}


function bulkHotelDetails($hotelIdArray,PriceAggregatorService $priceAggregatorService) {
    //     dd($hotelIdArray);
    $hotelIdArray = array_filter($hotelIdArray, function($value) {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    });
        $moreDetails = $priceAggregatorService->bulkHotelDetailsRequest($hotelIdArray);
        return $moreDetails['Response']['Body']['Hotels']['Hotel'];
    }

    function setRetailPrice($getPrice){
        $getRetailValue = \App\Models\Setting::where('setting_name','=','retail_price')->first();
        // $getRetailValue->setting_value;
        $retailValue =  $getRetailValue->setting_value;
        // dd($getRetailValue, $getRetailValue->setting_value);
        // dd($getRetailValue);
        return ((($getPrice/100)*$retailValue ) +$getPrice);
    }


    function dateFormat($date){
//     $formattedDate= \Carbon\Carbon::parse($date)->format('d-m-Y');
//        $formattedDate= \Carbon\Carbon::createFromFormat('D, d M, Y', $date)->format('d-m-Y');
//     return  $formattedDate;

        return \Carbon\Carbon::parse($date)->format('D, d M, Y');
    }

function extractImportantFacilities($facilities) {
    $importantFacilities = [
        'Free food', 'Swimming pool', 'Free WiFi', 'Garden', 'Parking', 'Wedding services',
        '24-hour front desk', 'Breakfast available', 'Laundry facilities', 'Elevator',
        'Fitness facilities', 'Hair salon', 'Pets not allowed', 'Pets allowed',
        'Total number of rooms', 'Number of bars/lounges', 'Wheelchair', 'Number of coffee shops',
        'Banquet hall', 'Food and water bowls', 'Television', 'Luggage storage',
        'Guests must provide proof of COVID-19 vaccination'
    ];

    $uniqueFacilities = [];
    $wheelchairAdded = false;

    foreach ($facilities as $facility) {
        $facilityName = $facility['FacilityName'];

        if ($wheelchairAdded && stripos($facilityName, 'Wheelchair') !== false) {
            continue; // Skip adding more wheelchair-related facilities
        }

        foreach ($importantFacilities as $importantFacility) {
            if (stripos($facilityName, $importantFacility) !== false && !in_array($importantFacility, $uniqueFacilities)) {
                $uniqueFacilities[] = $facilityName;

                // Check if the added facility is related to wheelchair
                if (stripos($facilityName, 'Wheelchair') !== false) {
                    $wheelchairAdded = true;
                }
                break;
            }
        }
    }

//    dd($uniqueFacilities);
    return array_values($uniqueFacilities);
}



//$facilities = json_decode($hotelMoreDetails['Facilities']['Facility'], true);
//$importantFacilities = extractImportantFacilities($facilities);


function formatFacility($facilityName) {

    static $printedFacilities = [];
    if (is_array($facilityName)) {
        $facilityName = implode(', ', $facilityName);
    }

    if (in_array($facilityName, $printedFacilities)) {
        return '';
    }

    if (strpos(strtolower($facilityName), 'wifi') !== false) {
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-wifi  text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'wheelchair') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-wheelchair  text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (stripos(strtolower($facilityName), 'bars') !== false || stripos($facilityName, 'lounges') !== false) {
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-champagne-glasses text-[#DC2626] mr-2"></i>' . $facilityName;
    }

    if (strpos(strtolower($facilityName), 'breakfast') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-utensils  text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'swimming pool') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-person-swimming  text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'parking') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-square-parking text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'coffee') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-mug-saucer  text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'laundry') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-shirt text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'elevator') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-elevator text-[#DC2626] mr-2"></i>' . $facilityName;
    }if (strpos(strtolower($facilityName), 'banquet hall') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-film text-[#DC2626] mr-2"></i>' .    $facilityName;

    }if (strpos(strtolower($facilityName), 'garden') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-brands fa-pagelines text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'wedding services') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-ring text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), '24') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-clock text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'luggage') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-cart-flatbed-suitcase text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'pets not allowed') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-xmark text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'rooms') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-bed text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'television') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-tv text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'salon') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-scissors text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'fitness ') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-dumbbell text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'bowls') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-bowl-food text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'food') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-bowl-food text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'pets ') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-dog text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    if (strpos(strtolower($facilityName), 'covid-19 ') !== false){
        $printedFacilities[] = $facilityName;
        return '<i class="fa-solid fa-syringe text-[#DC2626] mr-2"></i>' .    $facilityName;
    }
    return $facilityName;
}



//public function transformRoom($room)
//{
//
//    return array(
//        "RoomId" => $room['RoomType'],
//        "RoomName" => $room["RoomType"]["@text"],
//        "NumAdults" => "NA",
//        "NumChildren" => "NA",
//        "RoomPrice" => $room["Price"]["@amt"],
//        "DailyPrices" => array(
//            "DailyPrice" => $room["Price"]["@amt"]
//        )
//    );
//}
