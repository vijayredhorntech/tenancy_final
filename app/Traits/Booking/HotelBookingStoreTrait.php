<?php

namespace App\Traits\Booking;

use App\Models\HotelBooking;
use App\Models\HotelBookingDetail;
use Illuminate\Support\Facades\DB;
use App\Services\AgencyService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Deduction;
use App\Models\Balance;


trait HotelBookingStoreTrait
{
    
    protected AgencyService $agencyService;

    // Method to inject the AgencyService
    public function setAgencyService(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
    }


    public function storeHotelBooking($pessengerDetails, $bookingDetails)
            {
                // Decode if passenger details are JSON
                $pessengerdatanew = is_string($pessengerDetails)
                    ? json_decode($pessengerDetails, true)
                    : $pessengerDetails;
            
                $agency = $this->agencyService->getAgencyData();
                $currentuser = $this->agencyService->getCurrentLoginUser();
                $searchParams = session('searchParams');
            
                $checkInDate = Carbon::parse($searchParams['checkInDate']);
                $checkOutDate = Carbon::parse($searchParams['checkOutDate']);
                $vendorName = session('selectedVendor');
                $dailyPrice = session('dailyPriceOfRoom');
                $morehotelDetails = session('selectedHotelMoreDetails');
            
                $roomPrice = $bookingDetails['selectedOption'][0]['TotalPrice'];
                $hotelName = $bookingDetails['HotelName'];
                $totalPerson = count($pessengerdatanew);
                $service_id = 1;
            
                $now = now();
                $dymtCode = $now->format('dmyHi');
                $bookingId = 'hot-' . $dymtCode;
                $invoiceNumber = 'hot-' . $dymtCode . '-' . strtoupper(Str::random(4));
            
                // Wrap everything inside DB transaction
                $booking = DB::transaction(function () use (
                    $agency,
                    $currentuser,
                    $checkInDate,
                    $checkOutDate,
                    $roomPrice,
                    $dailyPrice,
                    $vendorName,
                    $hotelName,
                    $pessengerdatanew,
                    $totalPerson,
                    $bookingId,
                    $invoiceNumber,
                    $morehotelDetails,
                    $bookingDetails,
                    $service_id
                ) {
                    // Create booking record
                    $booking = HotelBooking::create([
                        'agency_id'      => $agency->id,
                        'user_id'        => $currentuser->id,
                        'agency_email'   => $agency->email,
                        'domain'         => '',
                        'database'       => $agency->database_name,
                        'checkin_date'   => $checkInDate,
                        'checkout_date'  => $checkOutDate,
                        'price'          => (float) $dailyPrice,
                        'total_person'   => $totalPerson,
                        'booking_id'     => $bookingId,
                        'invoice_number' => $invoiceNumber,
                        'total_price'    => (float) $roomPrice,
                    ]);
            
                    // Store booking details
                    HotelBookingDetail::create([
                        'hotel_booking_id'   => $booking->id,
                        'vendor_name'        => $vendorName,
                        'hotel_name'         => $hotelName,
                        'selected_operator'  => $vendorName,
                        'hotel_json_data'    => json_encode($bookingDetails),
                        'passenger_details'  => json_encode($pessengerdatanew),
                        'morehotel_details'  => json_encode($morehotelDetails),
                        'booking_reference'  => $bookingId,
                    ]);
            
                    // Check balance
                    $balance = Balance::where('agency_id', $agency->id)->first();
                    if (!$balance) {
                        throw new \Exception('Balance record not found.');
                    }
            
                    if ($roomPrice > $balance->balance) {
                        throw new \Exception('Insufficient balance.');
                    }
            
                    // Deduct balance and log
                    Deduction::create([
                        'agency_id'         => $agency->id,
                        'service'           => $service_id,
                        'invoice_number'    => $invoiceNumber,
                        'flight_booking_id' => $booking->id,
                        'amount'            => (float) $roomPrice,
                        'date'              => now(),
                    ]);
            
                    $balance->balance -= (float) $roomPrice;
                    $balance->save();
            
                    return $booking;
                });
            
                // Clear related session data
                session()->forget([
                    'searchParams1',
                    'searchParams',
                    'selectedVendor',
                    'dailyPriceOfRoom',
                    'bookingDetails',
                    'selectedOptionRoom',
                    'pessengerDetails',
                    'availableHotels',
                    'filterRatings',
                    'selectedHotelMoreDetails',
                    'selectedHotelDetails',
                    'totalPrice',
                    'availableHotelsWithImage'
                ]);
            
                return $booking;
            }
    
    
    
}
