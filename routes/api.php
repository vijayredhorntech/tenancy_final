<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\FilterService;
use Illuminate\Support\Facades\File;
use App\Models\Country;
use App\Models\City;


use App\Services\PriceAggregatorService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/test',function (){
//     return 'Welcome to Cloud Travels API heelo this is testing';
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*******Get Country Name for Serach *****/

Route::get('/countriesByName/{name}', function($name){
    return Country::where('countryName', 'LIKE', '%'.$name.'%')->get()->map(function ($country){
        return [
            'code' => $country->countryCode,
            'name' => $country->countryName,
        ];
    });
});


/*******  Get Location name *******/

Route::get('/locations', function(Request $request) {
    $query = $request->query('query');
    $countryCode = $request->query('country');
    $countryId=Country::where('countryCode', $countryCode)->first();
 
    $country=$countryId->id;
     return City::where('CityName', 'LIKE', '%' . $query . '%')
        ->where('countryId', $country)
        ->get()
        ->map(function ($location) {
            return [
                'id' => $location->CityId,
                'name' => $location->CityName,
            ];
        });
});


//api/countries
Route::get('/countries', function (){
    return \App\Models\Country::all()->map(function ($country){
        return [
            'code' => $country->countryCode,
            'name' => $country->countryName,
        ];
    });
});
//api/cities
Route::get('/cities/{country:countryCode}', function (\App\Models\Country $country){
    dd("heelko");
    return $country->cities()->select('CityId','CityName')->get();
});


Route::get('/cities/{country:countryCode}', function (\App\Models\Country $country){
    return $country->cities()->select('CityId','CityName')->get();
});


Route::get('/fetchCities',function(){
    $cities = \App\Models\City::where('countryId','=','104')->paginate(10);

    $transformedResults = $cities->map(function ($city) {
        return [
            'id' => $city->CityId,
            'name' => $city->CityName,
            'country' => $city->country->countryName,
            'countryCode' => $city->country->countryCode,
        ];
    });
    return $transformedResults;
});


Route::get('/getsinglecity/{cityCode}', function ($cityCode) {
    $city =  \App\Models\City::where('CityId',$cityCode)->first();
    return [
        'cityName'=>$city->CityName,
        'countryName'=>$city->country->countryName,
    ];

});
Route::get('/searchLocation/{searchLocation}',function($searchLocation){


    $results = \App\Models\City::where('CityName', 'like', '%' . $searchLocation . '%')
        ->paginate(10); // You can adjust the number of items per page as needed

    // Transform the paginated results
    $transformedResults = $results->map(function ($city) {
        return [
            'id' => $city->CityId,
            'name' => $city->CityName,
            'country' => $city->country->countryName,
            'countryCode' => $city->country->countryCode,
        ];
    });

 

    return $transformedResults;
});



Route::get('/getCountryName/{countryId}',function($countryId){
    // dd($countryId);
    // $cities = \App\Models\City::where('countryId','=','104')->get();
    $countryDetails = \App\Models\Country::findOrFail($countryId);
    return $countryDetails;
});




Route::get('/search/hotel/{query}',function ($query, FilterService $filterService)
{
//   return 'sss';
    // $filterService = new FilterService();
    $filteredResult =  $filterService->propertyNameFilter($query);
    // $filteredResult = (new FilterService())->propertyNameFilter($query);

    return response()->json($filteredResult);

}
);
// Route::get('/search/hotel', function ($query) {
//     $filterService = app(FilterService::class);
//     $filteredResult = $filterService->propertyNameFilter($query);
//     return response()->json($filteredResult);
// });




Route::get('/fetchhotelmoredetails/{hotelId}',function ($hotelId,  PriceAggregatorService $priceAggregatorService ){
    $hotelDetails = hotelDetails($hotelId,$priceAggregatorService);
    // $hotelDetails =  $priceAggregatorService->fetchHotelDetails($hotelId);
    return $hotelDetails;
});

Route::get('/fetchstubahotelmoredetails/{hotelId}',function ($hotelId,  PriceAggregatorService $priceAggregatorService ){
    $hotelDetails = stubaHotelDetails($hotelId,$priceAggregatorService);
    // $hotelDetails =  $priceAggregatorService->fetchHotelDetails($hotelId);
    return $hotelDetails;
});
Route::get('/fetchratehawkhotelmoredetails/{hotelId}',function ($hotelId,  PriceAggregatorService $priceAggregatorService ){
    $hotelDetails = ratehawkHotelDetails($hotelId,$priceAggregatorService);
    // $hotelDetails =  $priceAggregatorService->fetchHotelDetails($hotelId);
    return $hotelDetails;
});

Route::get('/fetchBulkhotelmoredetails/{hotelIdArray}',function ($hotelIdArray,  PriceAggregatorService $priceAggregatorService ){
    //    dd($hotelIdArray);
    $array = explode(',', $hotelIdArray);
    //    $array = json_decode($hotelIdArray);
    //    dd($array);

    $bulkHotelDetails = bulkHotelDetails($array,$priceAggregatorService);
    //    dd($bulkHotelDetails);
    // $hotelDetails =  $priceAggregatorService->fetchHotelDetails($hotelId);
    return $bulkHotelDetails;
});


Route::post('/sortHotels', 'App\Http\Controllers\HotelController@sortBy');


Route::get('fetchStubaMoreHotelDetails/{hotelId}',function($hotelId ,PriceAggregatorService $priceAggregatorService){
    $fetchedMoreHotelDetails = $priceAggregatorService->fetchStubaHotelDetails($hotelId);
    return $fetchedMoreHotelDetails;
});
