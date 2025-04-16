<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PriceAggregatorService;
use PDF;

class HotelController extends Controller
{

    protected $priceAggregator;

    public function __construct(PriceAggregatorService $priceAggregator)
    {
        $this->priceAggregator = $priceAggregator;
    }


public function roomDetaiPdf( $hotelId ){

//   dd($hotelId);
  $sessionData=session()->all();
  // dd($sessionData);
  $selectedHotelMoreDetails=$sessionData['selectedHotelMoreDetails'];
  $selectedHotelDetails=$sessionData['selectedHotelDetails'];
  $searchParams=$sessionData['searchParams'];
  $bookingDetails=$sessionData['bookingDetails'];


    $pdf = PDF::loadView('hotel.roomDetailPdf', ['selectedHotelDetails' => $selectedHotelDetails,'selectedHotelMoreDetails'=>$selectedHotelMoreDetails,'searchParams'=>$searchParams]);

    return $pdf->download('HotelOffer_' . $selectedHotelDetails['HotelId'] . '_' . uniqid() . '.pdf');

    // return view('hotel.roomDetailPdf');
}

    public function sharePdf($hotelId)
    {
        // Generate PDF code here...
  dd("hello");
        // Save the PDF to a temporary file
        $tempPdfPath = storage_path('app/public/temp.pdf');

        $sessionData=session()->all();
        // dd($sessionData);
        $selectedHotelMoreDetails=$sessionData['selectedHotelMoreDetails'];
        $selectedHotelDetails=$sessionData['selectedHotelDetails'];
        $searchParams=$sessionData['searchParams'];
        $bookingDetails=$sessionData['bookingDetails'];


        $pdf = PDF::loadView('hotel.roomDetailPdf', ['selectedHotelDetails' => $selectedHotelDetails,'selectedHotelMoreDetails'=>$selectedHotelMoreDetails,'searchParams'=>$searchParams]);

        $pdf->save($tempPdfPath);

        // Return the URL of the temporary PDF file
        $pdfUrl = url('storage/temp.pdf');
        return response()->json(['pdfUrl' => $pdfUrl]);
    }



    public function sortBy(Request $req)
    {
        $payload=$req->all();
        $hotelDataLists = json_decode($payload['hotelLists'], true);
        $sortBy=$payload['sortBy'];
//        dd($hotelDataLists);

        if ($sortBy === "lowPrice") {
            usort($hotelDataLists, function ($a, $b) {

                if(key_exists('TotalPrice',$a['Options']['Option'])){
                    $a['Options']['Option']=[$a['Options']['Option']];
                }
                if(key_exists('TotalPrice',$b['Options']['Option'])){
                    $b['Options']['Option']=[$b['Options']['Option']];
                }

                if($a['Options']['Option'] && $b['Options']['Option'] && $a['Options']['Option'][0]['TotalPrice'] && $b['Options']['Option'][0]['TotalPrice']) {
                    $priceA = isset($a['Options']['Option'][0]['TotalPrice']) ? (float)$a['Options']['Option'][0]['TotalPrice'] : 0;
                    $priceB = isset($b['Options']['Option'][0]['TotalPrice']) ? (float)$b['Options']['Option'][0]['TotalPrice'] : 0;

                    return $priceA <=> $priceB;
                }
            });
        } elseif ($sortBy === "highPrice") {
            usort($hotelDataLists, function ($a, $b) {

//                if($a['Options']['Option'] && $b['Options']['Option'] ) {
                if (key_exists('TotalPrice', $a['Options']['Option'])) {
                    $a['Options']['Option'] = [$a['Options']['Option']];
                }
                if (key_exists('TotalPrice', $b['Options']['Option'])) {
                    $b['Options']['Option'] = [$b['Options']['Option']];
                }

                if($a['Options']['Option'] && $b['Options']['Option'] && $a['Options']['Option'][0]['TotalPrice'] && $b['Options']['Option'][0]['TotalPrice']) {
                    $priceA = isset($a['Options']['Option'][0]['TotalPrice']) ? (float)$a['Options']['Option'][0]['TotalPrice'] : 0;
                    $priceB = isset($b['Options']['Option'][0]['TotalPrice']) ? (float)$b['Options']['Option'][0]['TotalPrice'] : 0;

                    return $priceB <=> $priceA;
                }
//                }

            });
        }
//        dd('jklm',$hotelDataLists);
        return $hotelDataLists;
    }




}
