<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\BookingHotel;
use App\Services\PriceAggregatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Prepaid_Voucher;
use Illuminate\Support\Carbon;
use PDF;

use App\Traits\Booking\HotelBookingStoreTrait;
use App\Services\AgencyService;




use App\Http\Requests\passengerContactInfo;
use App\Http\Requests\bookingStage2;

class BookingController extends Controller
{
    use HotelBookingStoreTrait;

   protected $priceAggregatorService;
   protected AgencyService $agencyService;

 
   public function __construct(PriceAggregatorService $priceAggregatorService, AgencyService $agencyService)
   {
       $this->priceAggregatorService = $priceAggregatorService;
       $this->setAgencyService($agencyService);  
   }

/****Not Use yet ******/
    public function index(Request $request)
    {
        // dd($request);
        return view('hotel.booking', [
            'option' => $request['option'],
            'searchParams' => $request->all(),
        ]);
    }


/****Not Use yet ******/
    public function process(Request $request)
    {
//        dd($request);
        $booking = $this->priceAggregatorService->bookHotel($request->all());
        return view('hotel.booking', [
            'option' => $request['option'],
            'searchParams' => $request->all(),
            'booking' => $booking,
        ]);
    }


    /**** Used  ******/
    public function bookingStage1(Request $request )
    {
        $selectedVendor = session('selectedVendor');
        $BookingDetails = json_decode(urldecode($request->bookingDetails), true);

        $hotelDetails = $this->fetchSelectedVendorHotels($selectedVendor);

        if(!isset($hotelDetails['Response']['Body']['Hotels']['Hotel'])){
            return 'opps something went wrong . Please search again';
        }

        $hotelsList = $hotelDetails['Response']['Body']['Hotels']['Hotel'];
        $collectDatas = collect($hotelsList)->lazy();
        $fetchedDatum = $collectDatas->where('HotelId', $BookingDetails['selectedHotelID']);
        $fetchedData = $fetchedDatum->all();

        $bookingDetails = array_values($fetchedData);
        if($bookingDetails==null){
            return view('agencies.pages.hotel.lastPage');
        }

//        dd( $bookingDetails);
        if(array_key_exists('OptionId',$bookingDetails[0]['Options']['Option'])){
            $bookingDetails[0]['Options']['Option']=[$bookingDetails[0]['Options']['Option']];
        }
 ;
        $optionsList = $bookingDetails[0]['Options']['Option'];


        $collectDatas = collect($optionsList)->lazy();
        $fetchedDatum = $collectDatas->where('OptionId', $BookingDetails['selectedOption']);

        $fetchedData = $fetchedDatum->all();



        if($bookingDetails==null){
            return view('agencies.pages.hotel.lastPage');
        }
        $selectedOption = array_values($fetchedData);
//        dd($selectedOption );

        $selectedOption = $selectedOption[0];
      
        session(['bookingDetails' => $bookingDetails[0]]);


        session()->push('bookingDetails.selectedOption', $selectedOption);
//         dd($selectedOption['OptionId']);

        $fetchPolicies = $this->fetchSelectedVendorHotelPolicy($selectedVendor,$selectedOption['OptionId']);


//         dd($fetchPolicies);
        $bookingDetails = session('bookingDetails', []);
        $bookingDetails['fetchPolicies'] = $fetchPolicies;
        session(['bookingDetails' => $bookingDetails]);
        $bookingDetails = session('bookingDetails');


        if($bookingDetails['fetchPolicies']['Response']['Body'] && !isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts'])){
//            return 'Booking options not available';
            return view('agencies.pages.hotel.lastPage');
        }

        $imporatnatNote=null;
        if ($bookingDetails['fetchPolicies']['Response']['Body'] && $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']) {
            $policesArray = $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'];
            if (!is_array($policesArray)) {
                $policesArray = explode(". ", $policesArray); // Convert to array
            }
            $imporatnatNote =  $policesArray;
//            dd($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']);
        }


        session(['imporatnatNote' => $imporatnatNote]);

        $roomDetail = $bookingDetails['selectedOption'][0]['Rooms']['Room'];


        if (array_key_exists("RoomId", $roomDetail)) {
            $roomDetail = [$roomDetail]; // Convert to array

        }

//dd($roomDetail[0]);
        $dailyPriceOfRoom = null;
        if (isset($roomDetail[0]['DailyPrices'])) {
            $dailyPriceOfRoom = $roomDetail[0]['DailyPrices']['DailyPrice'];
//            dd($dailyPriceOfRoom);
            if (!is_array($dailyPriceOfRoom)) {
                $dailyPriceOfRoom = [$dailyPriceOfRoom];
            }
            session(['dailyPriceOfRoom' => $dailyPriceOfRoom]);
        }
        session(['dailyPriceOfRoom' => $dailyPriceOfRoom]);
        //          dd(session()->all());


        session(['selectedOptionRoom' => $roomDetail]);
//dd($bookingDetails);

        return view('agencies.pages.hotel.bookingStage1', [
            'bookingDetails' => $bookingDetails,
            // 'searchParams' => $request->all(),
        ]);
    }



    /*** Used  */
    public function bookingStage1backup(Request $request )
    {
        $selectedVendor = session('selectedVendor');
//        dd($request->bookingDetails);

        $BookingDetails = json_decode(urldecode($request->bookingDetails), true);
//dd(session()->all());

        if($selectedVendor == 'Stuba'){
            $hotelDetails = session()->get('stubaHotels');
        }
        if($selectedVendor  =='Travellanda') {
            $hotelDetails = session()->get('availableHotels');
        }


//        $hotelDetails = session()->get('availableHotels');

        if(!isset($hotelDetails['Response']['Body']['Hotels']['Hotel'])){
            return 'opps something went wrong . Please search again';
        }

        $hotelsList = $hotelDetails['Response']['Body']['Hotels']['Hotel'];
        $collectDatas = collect($hotelsList)->lazy();
        $fetchedDatum = $collectDatas->where('HotelId', $BookingDetails['selectedHotelID']);
        $fetchedData = $fetchedDatum->all();
        $bookingDetails = array_values($fetchedData);


        if($bookingDetails==null){
            return view('agencies.pages.hotel.lastPage');
        }
//        dd( $bookingDetails);
        if(array_key_exists('OptionId',$bookingDetails[0]['Options']['Option'])){
            $bookingDetails[0]['Options']['Option']=[$bookingDetails[0]['Options']['Option']];
        }
        $optionsList = $bookingDetails[0]['Options']['Option'];
        $collectDatas = collect($optionsList)->lazy();
        $fetchedDatum = $collectDatas->where('OptionId', $BookingDetails['selectedOption']);

        $fetchedData = $fetchedDatum->all();


        if($bookingDetails==null){
            return view('agencies.pages.hotel.lastPage');
        }
        $selectedOption = array_values($fetchedData);


//        dd($selectedOption );
        $selectedOption = $selectedOption[0];
// dd($selectedOption);
        // $bookingDetails = $request->input('bookingDetails');

        // 'selectedOption' => $roomTypeList]])
        session(['bookingDetails' => $bookingDetails[0]]);
        session()->push('bookingDetails.selectedOption', $selectedOption);
        // dd($bookingDetails['selectedOption']['OptionId']);
        if($selectedVendor == 'Travellanda'){
            $fetchPolicies = $this->priceAggregatorService->fetchPolicies($selectedOption['OptionId']);
        }
        if($selectedVendor == 'Stuba') {
            $fetchPolicies= null;
        }
//        dd($fetchPolicies);
        // dd($fetchPolicies);
        $bookingDetails = session('bookingDetails', []);
        $bookingDetails['fetchPolicies'] = $fetchPolicies ? $fetchPolicies:null;
        session(['bookingDetails' => $bookingDetails]);
        $bookingDetails = session('bookingDetails');
        dd($bookingDetails);

        if($bookingDetails['fetchPolicies']['Response']['Body'] && !isset($bookingDetails['fetchPolicies']['Response']['Body']['Alerts'])){
//            return 'Booking options not available';
            return view('agencies.pages.hotel.lastPage');
        }

        $imporatnatNote=null;
        if ($bookingDetails['fetchPolicies']['Response']['Body'] && $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']) {
            $policesArray = $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'];
            if (!is_array($policesArray)) {
                $policesArray = explode(". ", $policesArray); // Convert to array
            }
            $imporatnatNote =  $policesArray;
//            dd($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']);
        }

        session(['imporatnatNote' => $imporatnatNote]);

        $roomDetail = $bookingDetails['selectedOption'][0]['Rooms']['Room'];

        if (array_key_exists("RoomId", $roomDetail)) {
            $roomDetail = [$roomDetail]; // Convert to array

        }
//dd($roomDetail[0]);
        $dailyPriceOfRoom = null;
        if (isset($roomDetail[0]['DailyPrices'])) {
            $dailyPriceOfRoom = $roomDetail[0]['DailyPrices']['DailyPrice'];
//            dd($dailyPriceOfRoom);
            if (!is_array($dailyPriceOfRoom)) {
                $dailyPriceOfRoom = [$dailyPriceOfRoom];
            }
            session(['dailyPriceOfRoom' => $dailyPriceOfRoom]);
        }
        session(['dailyPriceOfRoom' => $dailyPriceOfRoom]);
        //          dd(session()->all());
//          dd($dailyPriceOfRoom);

        session(['selectedOptionRoom' => $roomDetail]);


        return view('agencies.pages.hotel.bookingStage1', [
            'bookingDetails' => $bookingDetails,
            // 'searchParams' => $request->all(),
        ]);
    }
    public function bookingStage2(Request $request)
    {
        $adultDetails = [];
        $childDetails = [];

        foreach ($request->except('_token') as $room) {
            foreach ($room as $key => $value) {
                if (strpos($key, 'titleAdults') === 0) {
                    $index = substr($key, -2);
                    $adultDetails[] = [
                        'title' => $value,
                        'firstName' => $room["adultFirstName{$index}"],
                        'lastName' => $room["adultLastName{$index}"],
                    ];
                } elseif (strpos($key, 'titleChilds') === 0) {
                    $index = substr($key, -2);
                    $childDetails[] = [
                        'title' => $value,
                        'firstName' => $room["childFirstName{$index}"],
                        'lastName' => $room["childLastName{$index}"],
                    ];
                }
            }
        }

//        dd($adultDetails, $childDetails);


//        dd( $request->all());
//        session(['reference' => $request->input('reference')]);
//
//
//        $titleAdults = $request->input('titleAdults');
//        $firstNameAdults = $request->input('firstNameAdults');
//        $lastNameAdults = $request->input('lastNameAdults');
//
//        // Initialize an array to store adult details
//        $adultDetails = [];
//        $childDetails = [];
//
//        // Process the data for each adult
//        for ($i = 1; $i <= count($titleAdults); $i++) {
//            $title = $titleAdults[$i];
//            $firstName = $firstNameAdults[$i];
//            $lastName = $lastNameAdults[$i];
//
//            // Create an array with adult details
//            $adultDetails[] = [
//                'title' => $title,
//                'firstName' => $firstName,
//                'lastName' => $lastName,
//            ];
//          }
//
//         if($request->input('titleChilds')){
//          $titleChilds = $request->input('titleChilds');
//         $firstNameChilds = $request->input('firstNameChilds');
//         $lastNameChilds = $request->input('lastNameChilds');
//
//
//
//     for ($i = 1; $i <= count($titleChilds); $i++) {
//         $title = $titleChilds[$i];
//         $firstName = $firstNameChilds[$i];
//         $lastName = $lastNameChilds[$i];
//
//      $childDetails[] = [
//        'title' => $title,
//        'firstName' => $firstName,
//        'lastName' => $lastName,
//      ];
//   }
//}
        //   dd($adultDetails,$childDetails);


        $bookingDetails = session('bookingDetails');
        $searchParams = session('searchParams');
        $pessengerDetails = ['adultDetails' => $adultDetails, 'childDetails' => $childDetails];
        session(['pessengerDetails' => $pessengerDetails]);
// dd($pessengerDetails);

        // dd( $passengerAndFilterDetails);
        // dd( $bookingDetails);
        // dd($searchParams);


        return view('hotel.cardPayment', [
            'adultDetails' => $adultDetails,
            'childDetails' => $childDetails,
            'bookingDetails' => $bookingDetails,
            'searchParams' => $searchParams
        ]);

    }

    public function bookingStage3(bookingStage2 $request)
    {
        dd($request->all());
        session(['leadPassengerDetails' => $request->all()]);
        // dd(session()->get('leadPassengerDetails'));

        $bookingDetails = session('bookingDetails');
        $searchParams = session('searchParams');
        return view('hotel.bookingStage3', [
            'bookingDetails' => $bookingDetails,
            'searchParams' => $searchParams
        ]);
    }

    public function bookingStage4(Request $request)
    {
        $data = $request->all();
     
        $roomsData = [];

        foreach ($data as $key => $room) {
            // Check if the current item represents a room
            if (strpos($key, 'room') === 0 && is_array($room)) {
                $roomNumber = substr($key, 4); // Extract the room number from the key
                $roomData = ['room' => $roomNumber+1]; // Include room number in room data

                // Iterate over the room data
                foreach ($room as $fieldKey => $value) {
                    // Add the current key-value pair to the room data
                    $roomData[$fieldKey] = $value;

                    // If there are three key-value pairs in $roomData, add it to $roomsData
                    if (count($roomData) == 4) {
                        $roomsData[] = $roomData; // Add the room data to the array
                        $roomData = ['room' => $roomNumber+1]; // Reset room data for the next set of three
                    }
                }

                // If there are remaining key-value pairs, add them to $roomsData
                if (count($roomData) > 1) { // Ensure there are additional key-value pairs
                    $roomsData[] = $roomData;
                }
            }
        }
//  dd($roomsData);
        // Now, $roomsData contains an array of room data, each with room number, check-in, check-out, and room type

        $country = $request->input('country');
        $city = $request->input('city');
        $lookupAddress = $request->input('lookupAddress');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $postalCode = $request->input('postalCode');
        $countryContactCode = $request->input('countryContactCode');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $pessengerDetails = [
            'passengerNameDetails'=>$roomsData,
            'country' => $country,
            'city' => $city,
            'lookupAddress' => $lookupAddress,
            'address1' => $address1,
            'address2' => $address2,
            'postalCode' => $postalCode,
            'countryContactCode' => $countryContactCode,
            'phone' => $phone,
            'email' => $email
        ];


//  dd($pessengerDetails);

        session(['pessengerDetails' => $pessengerDetails]);
        $bookingDetails = session('bookingDetails');
       
 
        $searchParams = session('searchParams');
//         dd( $bookingDetails );

        $checkInDate = \Carbon\Carbon::parse($searchParams['checkInDate']);
        $checkOutDate = \Carbon\Carbon::parse($searchParams['checkOutDate']);

        // Calculate the duration of stay in days
        $durationInDays = $checkInDate->diffInDays($checkOutDate);


        // new one
        $roomPrice = $bookingDetails['selectedOption'][0]['TotalPrice'];
        $roomCount = $searchParams['rooms'];
        // dd($pessengerDetails);

        // Calculate the total price

      
      
        $totalPrice = $roomPrice * $durationInDays;
       
        // new one end
        session(['totalPrice'=>$totalPrice]);
//        dd($pessengerDetails);
        if(session('selectedVendor') ==='Stuba'){
//            dd('asfasf');
            $quoteId = $bookingDetails['selectedOption'][0]['OptionId'];

            //this is nto actual booking , this is prepare before booking , check the commit type
            $fetchPolicies = $this->priceAggregatorService->bookStubaHotel($pessengerDetails['passengerNameDetails'],$quoteId,'prepare');


            $bookingDetails['fetchPolicies'] = $fetchPolicies;
            $imporatnatNote=null;
            if ($bookingDetails['fetchPolicies']['Response']['Body'] && $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']) {
                $policesArray = $bookingDetails['fetchPolicies']['Response']['Body']['Alerts']['Alert'];
                if (!is_array($policesArray)) {
                    $policesArray = explode(". ", $policesArray); // Convert to array
                }
                $imporatnatNote =  $policesArray;
//            dd($bookingDetails['fetchPolicies']['Response']['Body']['Alerts']);
            }


            session(['imporatnatNote' => $imporatnatNote]);

//            dd($fetchPolicies);
        }

        /******Store Booking function Trait ******/
        $booking = $this->storeHotelBooking($pessengerDetails,$bookingDetails);

           return redirect()->route('agency_dashboard')->with('success', 'Booking created successfully');
        // return view('hotel.cardPayment', [
        //     'bookingDetails' => $bookingDetails,
        //     'searchParams' => $searchParams,
        //     'totalPrice' => $totalPrice
        // ]);

    }

    // public function cardPayment(Request $request){
    //     dd($request->all());
    //     // $bookingDetails = session('bookingDetails');
    //     // $searchParams=session('searchParams');
    //     // dd($bookingDetails);
    //     // dd($request->all());
    //     $fetchedData = session()->all();

    //     $bookingPayload = [
    //         // // old one
    //         // 'optionID' => $fetchedData['bookingDetails']['selectedOption']['OptionId'] ,
    //         // 'roomID' => $fetchedData['bookingDetails']['selectedRoom']['RoomId'],
    //         // // old one end

    //         // new one
    //         'optionID' => $fetchedData['bookingDetails']['selectedOption'] ,
    //         // new one end
    //         'adultDetails' => $fetchedData['pessengerDetails']['adultDetails'],
    //         'childrenDetails' => $fetchedData['pessengerDetails']['childDetails'],
    //         'reference' => $fetchedData['reference'],

    //     ];

    //     // dd($bookingPayload);
    //     $fetchPolicies = $this->priceAggregatorService->fetchPolicies($fetchedData['bookingDetails']['selectedOption']['OptionId']);

    //    $booking = $this->priceAggregatorService->bookHotel($bookingPayload);
    //     dd($booking);
    //     return $booking;

    //     return view('hotel.successMessage');
    // }

    public function cardPayment(Request $request){
//        dd('test');
        // dd($request->all());
        // $bookingDetails = session('bookingDetails');
        // $searchParams=session('searchParams');
        // dd($bookingDetails);
        // dd($request->all());
//        return view('hotel.lastPage');
//        dd(session('pessengerDetails'));

        $fetchedData = session()->all();
        session(['bookingDetails.totalBookingPrice' => $fetchedData['totalPrice']]);
        $fetchedData = session()->all();

        $title=$fetchedData['pessengerDetails']['passengerNameDetails']['0']['titleAdult01'];
        $fname=$fetchedData['pessengerDetails']['passengerNameDetails']['0']['adultFirstName01'];
        $lname=$fetchedData['pessengerDetails']['passengerNameDetails']['0']['adultLastName01'];

        $booking=new BookingHotel();
        $booking->leadPassenger_name = $title . ' ' . $fname . ' ' . $lname;
        $booking->booking_id = random_int(1000000, 9999999);
        $booking->agents_name="suraj Kohar";
        $booking->price=$fetchedData['totalPrice'];
        $booking->booking_date= Carbon::now();
        $booking->check_in=$fetchedData['searchParams']['checkInDate'];
        $booking->check_out=$fetchedData['searchParams']['checkOutDate'];
        $booking->status='Confirmed';
        $booking->save();

        $mailPayload = [
            'pessengerDetails' => $fetchedData['pessengerDetails'],
//            'passengerContactInfo' => $fetchedData['passengerContactInfo'],
               'searchParams'=>$fetchedData['searchParams'],
            'bookingDetails' => $fetchedData['bookingDetails']
        ];

//        return view('Mail.preparedVoucher',[ 'voucherDetails' => $mailPayload]);
//       dd("fff",$mailPayload);

        $invoice_date = date('jS_F_Y');

        $pdf = PDF::loadView('Mail.preparedVoucher', ['voucherDetails' => $mailPayload]);

        $attachmentFilename = 'Invoice_' . config('app.name') . '_Date_' . $invoice_date . '.pdf';


        // Get the PDF content as a string
        $pdfData = $pdf->output();
          Mail::to('surajkohar826@gmail.com')->send(new Prepaid_Voucher($mailPayload,$pdfData, $attachmentFilename));
//        Mail::to($mailPayload['passengerContactInfo']['email'])->send(new Prepaid_Voucher($mailPayload));
        return view('agencies.pages.hotel.lastPage');

        // dd($bookingPayload);
        $fetchPolicies = $this->priceAggregatorService->fetchPolicies($fetchedData['bookingDetails']['selectedOption'][0]['OptionId']);

        $booking = $this->priceAggregatorService->bookHotel($bookingPayload);
//        dd($booking);
        return view('agencies.pages.hotel.lastPage');

        if (isset($booking['Response']['Body']['Error']['ErrorText'])) {
            return $booking['Response']['Body']['Error']['ErrorText'];
        } else {
            $bookingDetails = $booking['Response']['Body']['HotelBooking'];
//    \App\Models\HotelBook::create(
//     [
//         'booking_reference'=>$bookingDetails['BookingReference'],
//         'booking_status'=>$bookingDetails['BookingStatus'],
//         'your_reference'=>$bookingDetails['YourReference'],
//         'currency'=>$bookingDetails['Currency'],
//         'total_price'=>$bookingDetails['TotalPrice'],
//         'hotel_id'=>$bookingDetails['HotelId'],
//         'hotel_name'=>$bookingDetails['HotelName'],
//     ]
//     );

        }


// Mail::to($mailPayload[])->send(new Prepaid_Voucher($mailPayload));
        // return $booking;

        return view('hotel.successMessage');
    }
    public function fetchSelectedVendorHotels($selectedVendor){

        if($selectedVendor == 'Stuba'){
            return session()->get('stubaHotels');
        }
        if($selectedVendor === 'RateHawk'){
           return  session('rateHawkHotels');
        }
        if($selectedVendor  =='Travellanda') {
            return  session()->get('availableHotels');
        }

    } public function fetchSelectedVendorHotelPolicy($selectedVendor,$selectedOptions){

    $response = array(
        "Response" => array(
            "Head" => array(),
            "Body" => array(
                "OptionId" => "0",
                "Currency" => "0",
                "TotalPrice" => "0",
                "CancellationDeadline" => "0",
                "Policies" => array(
                    "Policy" => array(
                        array(
                            "From" => "0",
                            "Type" => "0",
                            "Value" => "0"
                        ),
                        array(
                            "From" => "0",
                            "Type" => "0",
                            "Value" => "0"
                        )
                    )
                ),
                "Restrictions" => array(
                    "Restriction" => "0"
                ),
                "Alerts" => array(
                    "Alert" => "0"
                )
            )
        )
    );
        if($selectedVendor == 'Stuba'){

            return $response;
        }
        if($selectedVendor == 'RateHawk'){
//            dd(session('bookingDetails'));
            $fetchedPolicies =session('bookingDetails')['selectedOption'][0]['fetchPolicies'];

            return $fetchedPolicies;

        }
        if($selectedVendor  =='Travellanda') {
            return  $this->priceAggregatorService->fetchPolicies($selectedOptions);
        }
    }
}
