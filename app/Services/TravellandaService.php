<?php

// app/Services/TravellandaDataDownloadService.php

namespace App\Services;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class TravellandaService
{
    protected $username;
    protected $password;
    protected $endpoint;
    protected $credentials;

    public function __construct()
    {
        $this->username = config('services.travellanda.username');
        $this->password = config('services.travellanda.password');
        $this->endpoint = config('services.travellanda.endpoint');
        $this->credentials = '<Username>' . $this->username . '</Username>
    <Password>' . $this->password . '</Password>';
    }
//////////////searchfunctionality//////////
function generateRoomXML($room)
{
    $xml = '<Room>
                <NumAdults>' . $room['numberofAdults'] . '</NumAdults>';

    if (!empty($room['numberOfChildren'])) {
        $xml .= '<Children>';
        foreach ($room['childAges'] as $age) {
            $xml .= '<ChildAge>' . $age . '</ChildAge>';
        }
        $xml .= '</Children>';
    }

    $xml .= '</Room>';

    return $xml;
}
public function buildSearchRequest($searchParams) {
    // dd($searchParams);
    // if (!isset($searchParams['city']) || !isset($searchParams['checkIn']) || !isset($searchParams['checkOut']) ) {
    // return 'error';
    // }


$roomXML = '';
foreach ($searchParams['roomDetails'] as $room) {
    // dd($room);
    $roomXML .= $this->generateRoomXML($room);
}
// dd($roomXML);
$xmlRequest = '<Request>
<Head>
    ' . $this->credentials . '
    <RequestType>HotelSearch</RequestType>
</Head>
<Body>
    <CityIds>
        <CityId>' . $searchParams['city'] . '</CityId>
    </CityIds>
    <CheckInDate>' . $searchParams['checkIn'] . '</CheckInDate>
    <CheckOutDate>' . $searchParams['checkOut'] . '</CheckOutDate>
    <Rooms>' . $roomXML . '</Rooms>
    <Nationality>GB</Nationality>
    <Currency>GBP</Currency>
    <AvailableOnly>1</AvailableOnly>
</Body>
</Request>';
// dd($xmlRequest);

return $xmlRequest;

}
///////////////searchfunctionalityend//////////////////
    public function buildSearchRequestsss($searchParams)
    {
        // Ensure required parameters are set
        if (!isset($searchParams['city']) || !isset($searchParams['checkIn']) || !isset($searchParams['checkOut']) || !isset($searchParams['adults'])) {
            // Handle missing parameters, throw an exception, or return an error response
            // For example, throw new \InvalidArgumentException('Missing required parameters');
        }

        // Convert childrenAges string to an array
        $childrenAges = isset($searchParams['childrenAges']) ? explode(",", $searchParams['childrenAges']) : [];

        // Build dynamic XML for rooms
        $roomXML = '';
        for ($i = 0; $i < $searchParams['rooms']; $i++) {
            $roomXML .= '<Room>
                <NumAdults>' . $searchParams['adults'] . '</NumAdults>';

            // If there are children, add ChildAge elements
            if ($i < count($childrenAges)) {
                $roomXML .= '<Children>';
                $roomXML .= '<ChildAge>' . $childrenAges[$i] . '</ChildAge>';
                $roomXML .= '</Children>';
            }

            $roomXML .= '</Room>';
        }

        // Build the complete XML request
        $xmlRequest = '<Request>
            <Head>
                ' . $this->credentials . '
                <RequestType>HotelSearch</RequestType>
            </Head>
            <Body>
                <CityIds>
                    <CityId>' . $searchParams['city'] . '</CityId>
                </CityIds>
                <CheckInDate>' . $searchParams['checkIn'] . '</CheckInDate>
                <CheckOutDate>' . $searchParams['checkOut'] . '</CheckOutDate>
                <Rooms>' . $roomXML . '</Rooms>
                <Nationality>GB</Nationality>
                <Currency>GBP</Currency>
                <AvailableOnly>1</AvailableOnly>
            </Body>
        </Request>';

        return $xmlRequest;
    }
//     public function buildSearchRequest($searchParams)
//     {
//         return '<Request>
//   <Head>
//     ' . $this->credentials . '
//     <RequestType>HotelSearch</RequestType>
//   </Head>
//   <Body>
//     <CityIds>
//       <CityId>' . $searchParams['city'] . '</CityId>
//     </CityIds>
//     <CheckInDate>' . $searchParams['checkIn'] . '</CheckInDate>
//     <CheckOutDate>' . $searchParams['checkOut'] . '</CheckOutDate>
//     <Rooms>
//       <Room>
// <NumAdults>2</NumAdults>
// </Room>
// <Room>
// <NumAdults>1</NumAdults>
// <Children>
// <ChildAge>4</ChildAge>
// <ChildAge>6</ChildAge>
// </Children>
// </Room>
//     </Rooms>
//     <Nationality>GB</Nationality>
//     <Currency>GBP</Currency>
//     <AvailableOnly>1</AvailableOnly>
//   </Body>
// </Request>
// ';
//     }

    public function buildPolicyRequest($option)
    {
        return '<Request>
            <Head>
            ' . $this->credentials . '
            <RequestType>HotelPolicies</RequestType>
            </Head>
            <Body>
            <OptionId>' . $option . '</OptionId>
          </Body>
            </Request>';
    }

    public function bulkHotelDetailsRequest($hotels)
    {

    $hotelsXML = '';

    foreach ($hotels as $hotelID) {
        $hotelsXML .= '<HotelId>' . $hotelID . '</HotelId>'. PHP_EOL;
    }


        $xmlRequest = '<Request>
            <Head>
            ' . $this->credentials . '
            <RequestType>GetHotelDetails</RequestType>
            </Head>
            <Body>
            <HotelIds>
                ' . $hotelsXML . '
            </HotelIds>
        </Body>
            </Request>';
//             dd($xmlRequest);
            return $xmlRequest;
    }

    public function buildHotelDetailsRequest($hotels)
    {
      // dd($hotels);
        $hotelsXML = '';
        // foreach ($hotels as $hotel) {

        //   $hotelsXML .= '<HotelId>' . $hotel['HotelId'] . '</HotelId>';
        // }
        $hotelsXML .= '<HotelId>' . $hotels . '</HotelId>';

        return '<Request>
            <Head>
            ' . $this->credentials . '
            <RequestType>GetHotelDetails</RequestType>
            </Head>
            <Body>
            <HotelIds>
            ' . $hotelsXML . '
            </HotelIds>
          </Body>
            </Request>';
    }
    public function buildBookingRequest($option)
{
//   dd($option);
    $optionID = $option['optionID']['OptionId'];
    $adultDetails = $option['adultDetails'];
    $childrenDetails = $option['childrenDetails'];

    // Room details
    $rooms = '';
    if (isset($option['optionID']['Rooms']['Room'])) {
        foreach ($option['optionID']['Rooms']['Room'] as $room) {
            $roomId = isset($room['RoomId']) ? $room['RoomId'] : '';

            // Adult details
            $adultDetailXML = '';
            if (isset($room['NumAdults'])) {
                for ($i = 0; $i < $room['NumAdults']; $i++) {
                    $adultDetail = $adultDetails[$i] ?? [];
                    $adultDetailXML .= '<AdultName>
                        <Title>' . $adultDetail['title'] . '</Title>
                        <FirstName>' . $adultDetail['firstName'] . '</FirstName>
                        <LastName>' . $adultDetail['lastName'] . '</LastName>
                    </AdultName>';
                }
            }

            // Child details
            $childDetailXML = '';
            if (isset($room['NumChildren']) && $room['NumChildren'] > 0) {
                for ($i = 0; $i < $room['NumChildren']; $i++) {
                    $childDetail = $childrenDetails[$i] ?? [];
                    $childDetailXML .= '<ChildName>
                        <FirstName>' . $childDetail['firstName'] . '</FirstName>
                        <LastName>' . $childDetail['lastName'] . '</LastName>
                    </ChildName>';
                }
            }

            $rooms .= '<Room>
                <RoomId>' . $roomId . '</RoomId>
                <PaxNames>' . $adultDetailXML . $childDetailXML . '</PaxNames>
            </Room>';
        }
    }

    // Build the complete XML request
    $xmlRequest = '<Request>
        <Head>
            ' . $this->credentials . '
            <RequestType>HotelBooking</RequestType>
        </Head>
        <Body>
            <OptionId>' . $optionID . '</OptionId>
            <YourReference>' . $option['reference'] . '</YourReference>
            <Rooms>' . $rooms . '</Rooms>
        </Body>
    </Request>';

    // dd($xmlRequest);
    return $xmlRequest;
}


//     public function buildBookingRequest($option)
//     {
//         $optionID = $option['optionID']['OptionId'];
//         $adultDetails = $option['adultDetails'];
//         $childrenDetails = $option['childrenDetails'];

//         // Room details
//         $rooms = '';
//         if (isset($option['optionID']['Rooms']['Room'])) {
//             foreach ($option['optionID']['Rooms']['Room'] as $room) {
//                 $roomId = isset($room['RoomId']) ? $room['RoomId'] : '';

//                 // // Adult details
//                 // $adultDetailXML = '';
//                 // if (isset($room['NumAdults'])) {
//                 //     for ($i = 0; $i < $room['NumAdults']; $i++) {
//                 //         $adultDetail = $adultDetails[$i] ?? [];
//                 //         $adultDetailXML .= '<AdultName>
//                 //             <Title>' . $adultDetail['title'] . '</Title>
//                 //             <FirstName>' . $adultDetail['firstName'] . '</FirstName>
//                 //             <LastName>' . $adultDetail['lastName'] . '</LastName>
//                 //         </AdultName>';
//                 //     }
//                 // }

//                 // // Child details
//                 // $childDetailXML = '';
//                 // if (isset($room['NumChildren'])) {
//                 //     for ($i = 0; $i < $room['NumChildren']; $i++) {
//                 //         $childDetail = $childrenDetails[$i] ?? [];
//                 //         $childDetailXML .= '<ChildName>
//                 //             <FirstName>' . $childDetail['firstName'] . '</FirstName>
//                 //             <LastName>' . $childDetail['lastName'] . '</LastName>
//                 //         </ChildName>';
//                 //     }
//                 // }

//                 // $rooms .= '<Room>
//                 //     <RoomId>' . $roomId . '</RoomId>
//                 //     <PaxNames>' . $adultDetailXML . $childDetailXML . '</PaxNames>
//                 // </Room>';
//                 // Child details
// $childDetailXML = '';
// if (isset($room['NumChildren'])) {
//     for ($i = 0; $i < $room['NumChildren']; $i++) {
//         $childDetail = $childrenDetails[$i] ?? [];
//         $childDetailXML .= '<ChildName>
//             <FirstName>' . $childDetail['firstName'] . '</FirstName>
//             <LastName>' . $childDetail['lastName'] . '</LastName>
//         </ChildName>';
//     }
// }

// // Ensure 'AdultName' is present even when there are no children
// $adultDetailXML = '';
// if (!empty($room['NumAdults'])) {
//     for ($i = 0; $i < $room['NumAdults']; $i++) {
//         $adultDetail = $adultDetails[$i] ?? [];
//         $adultDetailXML .= '<AdultName>
//             <Title>' . $adultDetail['title'] . '</Title>
//             <FirstName>' . $adultDetail['firstName'] . '</FirstName>
//             <LastName>' . $adultDetail['lastName'] . '</LastName>
//         </AdultName>';
//     }
// }

// $rooms .= '<Room>
//     <RoomId>' . $roomId . '</RoomId>
//     <PaxNames>' . $adultDetailXML . $childDetailXML . '</PaxNames>
// </Room>';

//             }
//         }

//         // Build the complete XML request
//         $xmlRequest = '<Request>
//         <Head>
//                   ' . $this->credentials . '
//                    <RequestType>HotelBooking</RequestType>
//               </Head>
//             <Body>
//                 <OptionId>' . $optionID . '</OptionId>
//                 <YourReference>' . $option['reference'] . '</YourReference>
//                 <Rooms>' . $rooms . '</Rooms>
//             </Body>
//         </Request>';
//     // dd($xmlRequest);
//         return $xmlRequest;
//     }

    // ole one
//     public function buildBookingRequest($option)
//     {
//         // dd($option);
//         $optionID = $option['optionID'] ;
//         $adultDetails = $option['adultDetails'] ;
//         $childrenDetails = $option['childrenDetails'] ;

//         $roomID = '<RoomId>'. $option['roomID'] . '</RoomId>';


//         // adultDetails
//         $adultDetailXML = '';
//         foreach($adultDetails as  $adultDetail) {
//           $adultDetailXML .= '<AdultName>
//           <Title>'.$adultDetail['title'].'</Title>
//           <FirstName>'.$adultDetail['firstName']. '</FirstName>
//           <LastName>'.$adultDetail['lastName']. '</LastName>
//           </AdultName>';
//         }

//         $childDetailXML = '';
//         foreach($childrenDetails as  $childrenDetail) {
//           $childDetailXML .= '<ChildName>
//           <FirstName>'.$childrenDetail['firstName']. '</FirstName>
//           <LastName>'.$childrenDetail['lastName']. '</LastName>
//           </ChildName>';
//         }


// $rooms = '<Room>
// <RoomId>' . $option['roomID'] . '</RoomId>
//   <PaxNames> '
//   .$adultDetailXML.
// $childDetailXML.
// '</PaxNames>
// </Room>' ;
// // dd($rooms);

//         $buildRequest =  '<Request>
//             <Head>
//             ' . $this->credentials . '
//             <RequestType>HotelBooking</RequestType>
//             </Head>
//             <Body>
//             <OptionId>' . $optionID. '</OptionId>
//             <YourReference>XMLTEST</YourReference>

//             <Rooms>
//             '.$rooms. '
//             </Rooms>
//           </Body>
//             </Request>';
//             // dd($buildRequest);
//             return $buildRequest;
//     }


    public function XMlToJSON($return)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($return);
        $json = new \FluentDOM\Serializer\Json\RabbitFish($dom);
        return json_decode($json, true);
    }

    public function sendRequest($xmlRequest)
    {
        $ch = curl_init($this->endpoint);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=" . $xmlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($ch);
        curl_close($ch);
        return $this->XMlToJSON($return);
    }



}
