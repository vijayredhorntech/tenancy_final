<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\FilterController;
use ProtoneMedia\Splade\Facades\Splade;
use App\Services\PriceAggregatorService;
use Illuminate\Http\Request;
use App\Models\City;

class SearchController extends Controller
{

    protected $priceAggregatorService;

    public function __construct(PriceAggregatorService $priceAggregatorService,FilterController $filterController)
    {
        $this->priceAggregatorService = $priceAggregatorService;
        $this->filterController = $filterController;

    }

    public function index(Request $request)
    {
        // dd($request->all());
        $input=$request->all(); 
        $output = [
            "checkInDate" => $input["checkInDate"],
            "checkOutDate" => $input["checkOutDate"],
            "country" => $input["country"],
            "city" => $input["city"],
            "rooms" => $input["rooms"],
            "roomDetails" => json_encode(
                array_map(function ($index) use ($input) {
                    return [
                        "roomID" => $index + 1,
                        "numberofAdults" => $input["numberofAdults"][$index],
                        "numberOfChildren" => $input["numberOfChildren"][$index],
                        "childAges" => isset($input["child_ages"][$index])
                        ? $input["child_ages"][$index]
                        : [0],
                    ];
                }, array_keys($input["numberofAdults"]))
            ),
        ];
    
        // return redirect()->route('hotel.search.results', $request->all());
        return redirect()->route('hotel.holidayList', $output);
        
    }

// new one


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

public function details(Request $request )
{
   
    $hotelDetails = [];
 
    $vCode = $request->input('vCode');
//    dd($vCode);
    if($vCode ==='ST'){
//        dd('st');
        session()->put('selectedVendor','Stuba');
        $hotelDetails = session()->get('stubaHotels');
    }
    if($vCode ==='RH'){
//        dd('rh');
        session()->put('selectedVendor','RateHawk');
        $hotelDetails = session()->get('rateHawkHotels');
//        dd($hotelDetails);
    }
    if(!$request->input('vCode')) {
    //    dd('tr');
        session()->put('selectedVendor','Travellanda');
        $hotelDetails = session()->get('availableHotels');
    }
//     dd($hotelDetails);
    if(!$hotelDetails) {
  
        return 'No Hotels Found, Please Search Again';
    }
     $hotelsList = $hotelDetails['Response']['Body']['Hotels']['Hotel'];

//      dd($hotelsList);
    $collectDatas = collect($hotelsList)->lazy();

// $fetchedDatum  = $collectDatas->contains(function (array $collectData, int $key) {
//     return $collectData['HotelId'] == '1003174';
// });
$fetchedDatum = $collectDatas->where('HotelId', $request->input('hotelIdd'));
//dd($fetchedDatum);
$fetchedData = $fetchedDatum->all();
//dd($fetchedData);
$fetchedData=array_values($fetchedData);
// dd('sssrr;',array_values($fetchedData));


    // hotelIdd
    $searchParams = session('searchParams');
//    dd($fetchedData)

    if(!($fetchedData[0])){
//
        return view('hotel.lastpage');
    }
    $selectedHotelID=$fetchedData[0];
    // $hotelDetails['hotelDetails'] = $request->input('amp;hotelDetails');
    $hotelDetails['hotelDetails'] = $fetchedData[0];


   if(array_key_exists('Rooms',$hotelDetails['hotelDetails']['Options']['Option'])){
       $hotelDetails['hotelDetails']['Options']['Option']=[$hotelDetails['hotelDetails']['Options']['Option']];
   }
    $optionsArray = $hotelDetails['hotelDetails']['Options']['Option'];

    $optionsArrayPagination = $this->customPagination($optionsArray);

    if ($request->ajax()) {
     $view =  view('partials.option-list',[
        'hotelDetailsData' => $hotelDetails,
        'optionsArrayPagination' => $optionsArrayPagination,
        'selectedHotelID'=>$selectedHotelID,
        'searchParams' => session()->get('searchParams1'),
    ])->render();
    // $view = trim($view);
    // dd($view)/;
        return response()->json(['html' => $view]);
    }

   
        

    // dd($hotelDetails);
    return view('agencies.pages.hotel.hotelDetail',[
        'hotelDetailsData' => $hotelDetails,
        'optionsArrayPagination' => $optionsArrayPagination,
        'selectedHotelID'=>$selectedHotelID,
        'searchParams' => session()->get('searchParams1'),
    ]);
}




public function results(Request $request)
    {

    //    dd($request->all());
        session()->put('searchParams', $request->all());
        $encodedObject = $request->query('roomDetails');
        $requestParams = $request->all();

        $decodedObject = json_decode(urldecode($encodedObject), true);
        $requestParams['roomDetails'] = $decodedObject;
        // dd($requestParams);

        session()->put('searchParams', $requestParams);
        $hotels = $this->priceAggregatorService->fetchHotels($requestParams);
        // dd($hotels);

        if($hotels['Response']['Body']['HotelsReturned'] > 0) {
         

        $totalHotels = count($hotels['Response']['Body']['Hotels']['Hotel']);

        $perPage = 10;
        $page = max(1, $request->get('page', 1));

        $startIndex = ($page - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $totalHotels);

        $hotelsOnPage = array_slice($hotels['Response']['Body']['Hotels']['Hotel'], $startIndex, $endIndex - $startIndex);

        foreach ($hotelsOnPage as $index => $fetchedHotel) {
            $varHotelID = $fetchedHotel['HotelId'];
            $hotelDetails = $this->priceAggregatorService->fetchHotelDetails($varHotelID);
            $hotelData = $hotelDetails['Response']['Body']['Hotels']['Hotel'];

            // Append more details to the current hotel in the existing structure
            $hotelsOnPage[$index]['MoreDetails'] = $hotelData;
        }
        $hotels = [];
        $hotels['Response']['Body']['Hotels']['Hotel'] = $hotelsOnPage;
        $hotels['Response']['Body']['HotelsReturned'] = $totalHotels;



        session(['availableHotels'=> $hotelsOnPage]);

    // dd($hotels);
        return view('search.results',[
            'hotels' => $hotels,
            'searchParams' => $request->all(),
        ]);
    }
    else {

        return  'No Hotels Found';


    }

    }



    public function hotelResults(Request $request){

        //   dd($request->all());
        // session()->flush();
        // $hotels = session('availableHotelsWithImage');
        // return view('agencies.pages.hotel.holidayList',[
        //     'hotels' => $hotels,
        //     'searchParams' => $request->all(),
        // ]);

       
        $reqAll = $request->all();

        session()->put('searchParams1', $reqAll);
        $encodedObject = $request->query('roomDetails');
        $requestParams = $request->all();

        $decodedObject = json_decode(urldecode($encodedObject), true);
        $requestParams['roomDetails'] = $decodedObject;
        $requestParams['adults'] = null;
        $requestParams['children'] = null;

        foreach($requestParams['roomDetails'] as $roomdetails) {
            $requestParams['adults'] += (int)$roomdetails['numberofAdults'];
            $requestParams['children'] += (int)$roomdetails['numberOfChildren'];
        }

        // dd($requestParams);
        session()->put('searchParams', $requestParams);
        // Get city & country name
    

        // Fetch hotels once
        $hotelsData = $this->priceAggregatorService->fetchHotels($requestParams);
         $hotels = $hotelsData['Response']['Body']['Hotels']['Hotel'] ?? [];

        //  this is set for hotel detials page 
        if (isset($hotelsData['Response']['Body']['HotelsReturned']) && $hotelsData['Response']['Body']['HotelsReturned'] > 0) {
            if (count($hotelsData) > 0) {
                session()->put('availableHotels', $hotelsData);
            }
        } 


        // Attach hotel details
        foreach ($hotels as &$hotel) {
            $vendor = $hotel['Vendor'] ?? '';
            $hotelId = $hotel['HotelId'] ?? '';

            $details = match ($vendor) {
                'Stuba' => stubaHotelDetails($hotelId, $this->priceAggregatorService),
                'RateHawk' => ratehawkHotelDetails($hotelId, $this->priceAggregatorService),
                default => hotelDetails($hotelId, $this->priceAggregatorService),
            };
           $hotel['Details'] = $details['Images'];
        }
        session()->put('availableHotelsWithImage', $hotels);
       
        return view('agencies.pages.hotel.holidayList',[
            'hotels' => $hotels,
            'searchParams' => $request->all(),
        ]);

    }


    public function moreFilterHotel(Request $request){
        //   dd($request->all());

        $ratings=session()->get('filterRatings');
        // dd($ratings);
        $moreFilter=$request->input('boardTypes');
        session(['moreFilter' => $request->input('boardTypes')]);

        $avalableAllHotels=session('availableHotels');

        $filteredHotels = [];
        $filterHotelsList = [];

        //   dd($avalableAllHotels);
          if (isset($avalableAllHotels) && is_array($avalableAllHotels)) {
            foreach ($avalableAllHotels as $hotel) {
                $recordAdded = false;
             foreach( $hotel['Options']['Option'] as $r){
            //    dd($record);
                    // Set the flag to false

                // foreach($record['Options']['Option'] as $r){

                //  if (in_array($r['BoardType'], $moreFilter)) {
                    if (!$recordAdded) {
                      foreach ($moreFilter as $filter) {
                        if (strpos($r['BoardType'], $filter) !== false) {
                            $filterHotelsList[] = $hotel;
                            $recordAdded = true; // Set the flag to true once the record is added
                                break; // Break out of the innermost loop
                        }
                    }
                }


              }
            }
           }
           else{
            dd("Options key is not set or is not an array");
           }
        //  dd($filterHotelsList);
        if(isset($filterHotelsList) && !empty($filterHotelsList)){
            $HotelsFound = true;
           foreach($filterHotelsList as $record){
            if (in_array($record['StarRating'], $ratings)) {          //if any value matches of $ratings then push
                $filteredHotels[] = $record;
            }
           }
          }else{
            $HotelsFound =false;
            // dd('this is',$filterHotelsList);
           }
        //   dd($HotelsFound);
         $searchParams=session('searchParams');
       if(isset($ratings) && $ratings){
        return view('hotel.filterHotel',['filteredHotels'=>$filteredHotels,'searchParams' =>  $searchParams,'HotelsFound' => $HotelsFound]);

       }else{
        return view('hotel.filterHotel',['filteredHotels'=>$filterHotelsList,'searchParams' =>  $searchParams,'HotelsFound' => $HotelsFound]);

       }

    }

    public function HotelRatings(Request $request){

        session(['filterRatings' => $request->input('ratings')]);
        // dd(session()->get('filterRatings'));
        $ratings=$request->input('ratings');
        $allHotels=session('availableHotels');
        $searchParams=session('searchParams');
        $filteredHotels = $this->filterController->ratingFilter($allHotels,$ratings);
        // dd($filteredHotels);

        return view('hotel.filterHotel',['filteredHotels'=>$filteredHotels, 'searchParams' =>  $searchParams]);
    }

    public function sortBy(Request $request){
        $avalableAllHotels=session('availableHotels');
        // dd($avalableAllHotels);
       $sortBy=$request->input('ratings');

        // if (isset($avalableAllHotels) && is_array($avalableAllHotels)){
        //        $recordAdded = false;
        //          foreach ($avalableAllHotels as $hotel){

        //             if (!$recordAdded) {
        //              foreach ($hotel['Options']['Option'] as $record){
        //                  if (is_array($record) && isset($record['TotalPrice'])){

        //                     $arrayRoomPrice[] = $hotel;
        //                     $recordAdded = true;
        //                   }
        //                 }
        //             }
        //                 // dd($arrayRoomPrice);
        //             }
        // }
        // dd($arrayRoomPrice);
        // if ($sortBy[0] == "Price High to Low") {
        //     usort($arrayRoomPrice, function ($a, $b) {
        //         return $b['TotalPrice'] - $a['TotalPrice'];
        //     });
        // }
        //   dd($arrayRoomPrice);

        $arrayRoomPrice = [];
        if (is_array($sortBy) && count($sortBy) > 0) {
            if (isset($avalableAllHotels) && is_array($avalableAllHotels)) {


                foreach ($avalableAllHotels as $hotel) {
                    foreach ($hotel['Options']['Option'] as $record) {
                        if (is_array($record) && isset($record['TotalPrice'])) {
                            $arrayRoomPrice[] = $record;
                        }
                    }
                }
                // dd($arrayRoomPrice);
                if ($sortBy[0] == "Price High to Low") {
                    // dd('klnbjn');
                    // Sort $arrayRoomPrice based on "TotalPrice" in descending order
                    usort($arrayRoomPrice, function ($a, $b) {
                        return $b['TotalPrice'] <=> $a['TotalPrice'];
                    });
                }
            }
        }

        // dd($arrayRoomPrice);


    //   dd($request->all());
    }

  public function filterByPriceRange(Request $request){
    // dd($request->all());
  }


  
  

public function resetFilter(Request $request)
{
//      dd($request->all());
    session()->forget('allFilters');
    session()->forget('returnFilteredHotels');
    // $this->reApplyFilter();
    return to_route('hotel.applyFilter');
    // return $this->reApplyFilter();


}

public function removeFilter(Request $request)
{

    $filterKeyToRemove = $request->all();
    $filters = session('allFilters', []);

    foreach ($filters as $fitlerKey => $filter) {
//    dd($fitlerKey,) ;
        if ($fitlerKey == $filterKeyToRemove['selectedFiltered']) {
            // dd($fitlerKey);
            unset($filters[$fitlerKey]);
            session()->forget('returnFilteredHotels');
            // dd(['ff'=>$filters]);
        }

    }
    session(['allFilters' => $filters]);
//  dd($filters);
//  dd(session()->all());
    //   $this->reApplyFilter();
    return to_route('hotel.applyFilter');
    // return back();
}


public function searchHotel(Request $request){

    // if($request->input('hotels')){
        // dd($request->all());

        // $hotels['Response']['Body']['Hotels']['Hotel']= json_decode(urldecode($request->input('hotels')), true);
        // dd("h",$hotels);

        $hotels= json_decode(urldecode($request->input('hotels')), true);
        // dd($hotels);
        $perPage = 12;
        $page = request()->get('page', 1);

        $offset = ($page - 1) * $perPage;

        $currentPageItems = array_slice($hotels, $offset, $perPage);
        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            count($hotels),
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
                'searchParams' => $request->all(),
            ]
        );
        // $paginator->appends(['searchParams' =>$request->all()]);
        $paginator->withQueryString();
        // if ($request->ajax()) {
        //     return view('partials.hotel_list', ['hotels' => $paginator])->render();
        // }

        if ($request->ajax()) {
            // dd('ajax called');
            // $view = view('partials.test')->render();
        $view =  view('partials.hotel-list',[
            'hotels' => $paginator,
            'searchParams' => $request->all(),
        ])->render();
        $view = trim($view);
        // dd($view);
            return response()->json(['html' => $view]);
        }


        // $totalHotels = count($hotels['Response']['Body']['Hotels']['Hotel']);
        // // dd($totalHotels);
        //  $hotels['Response']['Body']['HotelsReturned'] = $totalHotels;
        // dd("Hello ",$hotels);
        return view('hotel.holidayList',[
            'hotels' => $paginator,
            'searchParams' => session('searchParams'),
        ]);
    // }
}


/***Get Hotel Name **** */
public function getHotelSuggestions(Request $request)
{
    $searchTerm = $request->input('property_name'); // you are sending 'property_name' in AJAX, not 'searchTerm'

    $hotels = session('availableHotelsWithImage');
    $hotelNames = [];

    if (!empty($hotels)) {
        foreach ($hotels as $hotel) {
            if (isset($hotel['HotelName'])) {
                // Check if HotelName starts with $searchTerm
                if (stripos($hotel['HotelName'], $searchTerm) === 0) { 
                    $hotelNames[] = [
                        'HotelId' => $hotel['HotelId'] ?? null,
                        'HotelName' => $hotel['HotelName']
                    ];
                }
            }
        }
    }

    return response()->json($hotelNames);
}


/*******Get Hotel Detilals *****/
public function getHotelDetails(Request $request)
{
    // Get the hotel ID from the request
    $hotelId = $request->input('hotel_id');

    // Fetch hotel details from session or database
    $hotels = session('availableHotelsWithImage');
    $hotel = null;

    // Loop through to find the specific hotel by ID
    foreach ($hotels as $h) {
        if ($h['HotelId'] == $hotelId) {
            $hotel = $h;
            break;
        }
    }
// dd($hotel);
    // If hotel found, return success with hotel data, else return error
    if ($hotel) {
        // dd($hotel);
        $hotelDetails = [
            'status' => 'success',
            'hotel' => [
                'HotelId' => $hotel['HotelId'],
                'HotelName' => $hotel['HotelName'],
                'HotelImage' => $hotel['Details']['Image'] ?? '/path/to/default/image.jpg',  // Default image if not available
                'StarRating' => $hotel['StarRating'],
                'Vendor' => 'rh',
                'City' => '10',
                'Country' => '10',
                'TotalPrice' => $hotel['Options']['Option'][0]['TotalPrice'] ?? 'N/A',
                'Images' => $hotel['Details']['Image'] ?? [],  // Assuming Images is an array
                'TotalNights' => '10',
            ]
        ];
// dd($hotelDetails);
        // Return hotel details in JSON format with success status and hotel data
        return response()->json($hotelDetails);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Hotel not found'
        ]);
    }
}


/****Fliter *** */

public function applyFilter(Request $request)
{
    $queryParams = $request->all();

    $ratings = isset($queryParams['ratings']) ? $queryParams['ratings'] : [];
    $priceRange = isset($queryParams['priceRange']) ? $queryParams['priceRange'] : null;

    $hotels = session('availableHotelsWithImage');
    $matchingHotels = [];

    if (!empty($ratings)) {
        // Filter first by ratings
        foreach ($hotels as $h) {
            if (in_array($h['StarRating'], $ratings)) {
                $matchingHotels[] = $h;
            }
        }

        // Now if price range is set, apply price filter on matched ratings
        if ($priceRange) {
            $priceRangeArray = explode('-', $priceRange);
            $minPrice = isset($priceRangeArray[0]) ? (float)$priceRangeArray[0] : 0;
            $maxPrice = isset($priceRangeArray[1]) ? (float)$priceRangeArray[1] : INF;

            $matchingHotels = array_filter($matchingHotels, function ($hotel) use ($minPrice, $maxPrice) {
                $totalPrice = isset($hotel['Options']['Option'][0]['TotalPrice']) ? (float)$hotel['Options']['Option'][0]['TotalPrice'] : 0;
                return $totalPrice >= $minPrice && $totalPrice <= $maxPrice;
            });
        }
    } elseif ($priceRange) {
        // If only price filter is set, no ratings filter
        $priceRangeArray = explode('-', $priceRange);
        $minPrice = isset($priceRangeArray[0]) ? (float)$priceRangeArray[0] : 0;
        $maxPrice = isset($priceRangeArray[1]) ? (float)$priceRangeArray[1] : INF;

        foreach ($hotels as $h) {
            $totalPrice = isset($h['Options']['Option'][0]['TotalPrice']) ? (float)$h['Options']['Option'][0]['TotalPrice'] : 0;
            if ($totalPrice >= $minPrice && $totalPrice <= $maxPrice) {
                $matchingHotels[] = $h;
            }
        }
    }

    // Prepare hotel data
    $finalHotels = [];
    foreach ($matchingHotels as $h) {
        $finalHotels[] = [
            'HotelId' => $h['HotelId'],
            'HotelName' => $h['HotelName'],
            'HotelImage' => $h['Details']['Image'] ?? '/path/to/default/image.jpg',
            'StarRating' => $h['StarRating'],
            'Vendor' => 'rh',
            'City' => '10',
            'Country' => '10',
            'TotalPrice' => $h['Options']['Option'][0]['TotalPrice'] ?? 'N/A',
            'Images' => $h['Details']['Image'] ?? [],
            'TotalNights' => '10',
        ];
    }

    if (count($finalHotels) > 0) {
        $hotelDetails = [
            'status' => 'success',
            'hotels' => $finalHotels,
        ];
    } else {
        $hotelDetails = [
            'status' => 'error',
            'message' => 'No hotels found matching the selected filters.',
        ];
    }

    return response()->json($hotelDetails);
}

/****Reset Filter **** */

public function hsresetFliter(Request $request)
{
    // Get all hotels from session
    $hotels = session('availableHotelsWithImage');
    $finalHotels = [];

    // Loop through all hotels to prepare the response
    foreach ($hotels as $h) {
        $finalHotels[] = [
            'HotelId' => $h['HotelId'],
            'HotelName' => $h['HotelName'],
            'HotelImage' => $h['Details']['Image'] ?? '/path/to/default/image.jpg',
            'StarRating' => $h['StarRating'],
            'Vendor' => 'rh',
            'City' => '10',
            'Country' => '10',
            'TotalPrice' => $h['Options']['Option'][0]['TotalPrice'] ?? 'N/A',
            'Images' => $h['Details']['Image'] ?? [],
            'TotalNights' => '10',
        ];
    }

    return response()->json([
        'status' => 'success',
        'hotels' => $finalHotels,
    ]);
}



}
