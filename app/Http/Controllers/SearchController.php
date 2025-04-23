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



public function details15jan(Request $request )
{
    //   dd($request->all());
    // $hotelDetails = ;
    // $recomendedhotelDetails = $request->input('hotelDetails');
    //  dd($recomendedhotelDetails['HotelId']);
    $searchParams = session('searchParams');
    // dd( $searchParams);
    $selectedHotelID=$request->input('hotelDetails');
    $hotelDetails['hotelDetails'] = $request->input('amp;hotelDetails');


    // if(!empty($recomendedhotelDetails['HotelId'])){
    //     $selectedHotelID=$recomendedhotelDetails['HotelId'];
    //     $hotelDetails['hotelDetails'] = $request->input('hotelDetails');
    // }
    // else{
    //     $selectedHotelID=$request->input('hotelDetails');
    //     $hotelDetails['hotelDetails'] = $request->input('amp;hotelDetails');
    // }

    // $hotelsDetails = $this->priceAggregatorService->fetchHotels($searchParams);

    // $hotelsDetailsFiltered = $hotelsDetails['Response']['Body']['Hotels']['Hotel'];
//         $hotelsDetailsFiltered = $hotelDetails;

//         foreach($hotelsDetailsFiltered as $hotelsDetailsFilter ) {
//             // dd($hotelsDetailsFilter,$hotelDetails['HotelId']);
// if (is_array($hotelsDetailsFilter['HotelId']) && is_array($hotelDetails['HotelId'])) {

//     $newArrayPush['hotelDetails'] = $hotelsDetailsFilter;

// }
// else {

//     $moreHotelList[] = $hotelsDetailsFilter;
// }
//  }
// // start here recommend section
// foreach($moreHotelList as $index => $fetchedHotel) {
//     $varHotelID = $fetchedHotel['HotelId'];
//     $hotelDetails = $this->priceAggregatorService->fetchHotelDetails($varHotelID);
//     $hotelData= $hotelDetails['Response']['Body']['Hotels']['Hotel'];

//     $moreHotelList[$index]['MoreDetails'] = $hotelData;
// }

// end here recommend section

// $hotelDetails = $this->priceAggregatorService->fetchHotelDetails($hotelID);
// $hotelData = $hotelDetails['Response']['Body']['Hotels']['Hotel'];
// $newArrayPush['hotelDetails']['MoreDetails'] = $hotelData;

// dd($newArrayPush);
    return view('hotel.hotelDetail',[
        'hotelDetailsData' => $hotelDetails,
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
 
      
        return view('agencies.pages.hotel.holidayList',[
            'hotels' => $hotels,
            'searchParams' => $request->all(),
        ]);

    }

    // public function 26hotelResults(Request $request){
    //         session()->flush();
    //         $reqAll = $request->all();

    //                session()->put('searchParams1', $reqAll);
    //                $encodedObject = $request->query('roomDetails');
    //                $requestParams = $request->all();

    //                $decodedObject = json_decode(urldecode($encodedObject), true);
    //                $requestParams['roomDetails'] = $decodedObject;
    //                $requestParams['adults'] = null;
    //                $requestParams['children'] = null;

    //                foreach($requestParams['roomDetails'] as $roomdetails) {
    //                    $requestParams['adults'] += (int)$roomdetails['numberofAdults'];
    //                    $requestParams['children'] += (int)$roomdetails['numberOfChildren'];
    //                }

    //                session()->put('searchParams', $requestParams);
    //                $hotels = $this->priceAggregatorService->fetchHotels($requestParams);
    //                session()->put('availableHotels',$hotels);

    //                if(!$hotels['Response']['Body']['Hotels']){
    //                 return 'Hotels not found';
    //                }
    // $outerHotelList =$hotels['Response']['Body']['Hotels']['Hotel'];

    // $perPage = 12;
    // $page = request()->get('page', 1);

    // $offset = ($page - 1) * $perPage;

    // $currentPageItems = array_slice($outerHotelList, $offset, $perPage);
    // $paginator = new LengthAwarePaginator(
    //     $currentPageItems,
    //     count($outerHotelList),
    //     $perPage,
    //     $page,
    //     [
    //         'path' => Paginator::resolveCurrentPath(),
    //         'pageName' => 'page',
    //         'searchParams' => $request->all(),
    //     ]
    // );

    // $paginator->withQueryString();



    // if ($request->ajax()) {

    // $view =  view('partials.hotel-list',[
    //     'hotels' => $paginator,
    //     'searchParams' => $request->all(),
    // ])->render();
    // $view = trim($view);

    //     return response()->json(['html' => $view]);
    // }

    //                return view('hotel.holidayList',[
    //                    'hotels' => $paginator,
    //                    'searchParams' => $request->all(),
    //                ]);

    //     }



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

///////////////////////////////////////////////////filter functions///////////////////////////////////////
public function applyFilter(Request $request)
{
    // dd(session()->all());
    $queryParams = $request->all();
//    dd($queryParams);
    // Retrieve the existing filters from the session
    $allFilters = session('allFilters', []);
    // Loop through the received filters and add them to the array if they are not already present
    foreach ($queryParams as $key => $value) {
        if (!in_array($value, $allFilters[$key] ?? [])) {
            $allFilters[$key][0] = $value;
        }
    }
    // Store the updated array in the session
    session(['allFilters' => $allFilters]);
    $sessionget = session()->get('allFilters');
    $searchParams = session('searchParams1');
    // dd($sessionget);
    $hotels = [];
    $filterLists = session()->get('allFilters');

    $availableHotels = session()->get('availableHotels');
    // dd(session()->all());
    if (!empty($filterLists)) {
        // dd($availableHotels);
        $availableHotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];

        $filteredHotels = $this->filterController->filterApply($availableHotels, $filterLists);
//      dd($filteredHotels);

$hotels = $filteredHotels;
        // $hotels['Response']['Body']['Hotels']['Hotel'] = $filteredHotels;
        // $hotels['Response']['Body']['HotelsReturned'] = count($filteredHotels);
    } else {
        $hotels = $availableHotels['Response']['Body']['Hotels']['Hotel'];
    }


    // dd(session()->get('searchParams1'));

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

    // dd($paginator);
                //    session(['availableHotels'=> $hotels]);
                //    session()->put('availableHotels',$hotels);

                //    return view('hotel.holidayList',[
                //        'hotels' => $paginator,
                //        'searchParams' => $request->all(),
                //    ]);




    // dd($hotels);
    return view('hotel.holidayList', [
        'hotels' => $paginator,
        'searchParams' => session()->get('searchParams1'),
    ]);
    // return back();
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





}
