<?php
// app/Services/StubaService.php

namespace App\Services;

use Carbon\Carbon;
use DOMDocument;
use FluentDOM\Serializer\Json\RabbitFish;
use GuzzleHttp\Client;

class StubaService
{
    protected $username;
    protected $password;
    protected $endpoint;
    protected $authority;
    public function __construct()
    {

        $this->username = config('services.stuba.username');
        $this->password = config('services.stuba.password');
        $this->endpoint = config('services.stuba.endpoint');
        $this->loginOrganization = 'cloudtravel';
        $this->currency = 'GBP';

        $this->requiredVersion = '1.28';

        $this->authority = '<Authority>
        <Org>' . $this->loginOrganization . '</Org>
        <User>' . $this->username . '</User>
        <Password>' . $this->password . '</Password>
        <Currency>' . $this->currency . '</Currency>
        <Version>' . $this->requiredVersion . '</Version></Authority>';

    }

    public function buildSearchRequest($searchParams)
    {
        $regionId = 52612;  //Region ID -> London
        $arrivalDate = $searchParams['checkInDate'];
        $totalNights = Carbon::create($searchParams['checkInDate'])->diffInDays($searchParams['checkOutDate']);
        $nationality = 'GB';
        $dynamicRoomsXML = '';
        foreach ($searchParams['roomDetails'] as $room) {
            $dynamicRoomsXML .= '<Room><Guests>';
            for ($i = 0; $i < $room['numberofAdults']; $i++) {
                $dynamicRoomsXML .= '<Adult />';
            }
            for ($j = 0; $j < $room['numberOfChildren']; $j++) {
                $dynamicRoomsXML .= '
        <Child age="' . $room['childAges'][$j] . '" />';
            }
            $dynamicRoomsXML .= '</Guests></Room>';
        }

        $xiRequestContent = '<AvailabilitySearch xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
  ' . $this->authority . '
  <RegionId>' . $regionId . ' </RegionId>
  <HotelStayDetails>
    <ArrivalDate>' . $arrivalDate . '</ArrivalDate>
    <Nights>' . $totalNights . '</Nights>
    <Nationality>' . $nationality . '</Nationality>
    ' . $dynamicRoomsXML . '
  </HotelStayDetails>
  <HotelSearchCriteria>
    <AvailabilityStatus>allocation</AvailabilityStatus>
    <DetailLevel>basic</DetailLevel>
  </HotelSearchCriteria>
</AvailabilitySearch>
';
//        dd($xiRequestContent);
        return $xiRequestContent;
    }

    public function sssbuildBookRequest($guests,$quoteId,$commitType){
        dd($guests,$quoteId,$commitType);


        $guestsXML = '';
        foreach ($guests as $guest) {
            $guestValues = array_values($guest);
            $thirdValue = $guestValues[2];
            $guestsXML .= '
        <Room>
            <Guests>
                <Adult title="' . strtoupper($guestValues[1]) . '" first="' . $guestValues[2] . '" last="' . $guestValues[3] . '"></Adult>
            </Guests>
        </Room>';
        }

        $hotelStayDetails = '<HotelStayDetails>' . $guestsXML . '</HotelStayDetails>';

        $xiRequestContent = '<BookingCreate xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
        ' . $this->authority . '
        <QuoteId>' . $quoteId . '</QuoteId>
        ' . $hotelStayDetails . '
        <HotelSearchCriteria>
            <AvailabilityStatus>allocation</AvailabilityStatus>
            <DetailLevel>basic</DetailLevel>
        </HotelSearchCriteria>
        <CommitLevel>' . $commitType . '</CommitLevel>
    </BookingCreate>';

        return $xiRequestContent;

    }
    public function buildBookRequest($guests, $quoteId, $commitType)
    {
        $groupedGuests = [];
        foreach ($guests as $guest) {
            $roomNumber = $guest['room'];
            unset($guest['room']); // Remove room from the array
            $groupedGuests[$roomNumber][] = $guest;
        }

        $guestsXML = '';
        foreach ($groupedGuests as $roomNumber => $roomGuests) {
            $guestsInRoomXML = '';
            foreach ($roomGuests as $guest) {
                $guestValues = array_values($guest);
                $guestsInRoomXML .= '
                        <Adult title="' . strtoupper($guestValues[0]) . '" first="' . $guestValues[1] . '" last="' . $guestValues[2] . '"></Adult>';

            }

            $roomXML = '
        <Room>
            <Guests>' . $guestsInRoomXML . '</Guests>
        </Room>';

            $guestsXML .= $roomXML;
        }

        $hotelStayDetails = '<HotelStayDetails>' . $guestsXML . '</HotelStayDetails>';


        $xiRequestContent = '<BookingCreate xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
        ' . $this->authority . '
        <QuoteId>' . $quoteId . '</QuoteId>
        ' . $hotelStayDetails . '
        <HotelSearchCriteria>
            <AvailabilityStatus>allocation</AvailabilityStatus>
            <DetailLevel>basic</DetailLevel>
        </HotelSearchCriteria>
        <CommitLevel>' . $commitType . '</CommitLevel>
    </BookingCreate>';

        return $xiRequestContent;
    }
public function buildSingleSearchRequest($searchParams,$hotelId){
    $arrivalDate = $searchParams['checkInDate'];
    $totalNights = Carbon::create($searchParams['checkInDate'])->diffInDays($searchParams['checkOutDate']);
    $nationality = 'GB';
    $dynamicRoomsXML = '';
    foreach ($searchParams['roomDetails'] as $room) {
        $dynamicRoomsXML .= '<Room><Guests>';
        for ($i = 0; $i < $room['numberofAdults']; $i++) {
            $dynamicRoomsXML .= '<Adult />';
        }
        for ($j = 0; $j < $room['numberOfChildren']; $j++) {
            $dynamicRoomsXML .= '
        <Child age="' . $room['childAges'][$j] . '" />';
        }
        $dynamicRoomsXML .= '</Guests></Room>';
    }
    $xiRequestContent = '<AvailabilitySearch xmlns="http://www.reservwire.com/namespace/WebServices/Xml">
  ' . $this->authority . '
 <HotelId>'.$hotelId.'</HotelId>

  <HotelStayDetails>
    <ArrivalDate>' . $arrivalDate . '</ArrivalDate>
    <Nights>' . $totalNights . '</Nights>
    <Nationality>' . $nationality . '</Nationality>
    ' . $dynamicRoomsXML . '
  </HotelStayDetails>
  <HotelSearchCriteria>
    <AvailabilityStatus>allocation</AvailabilityStatus>
    <DetailLevel>basic</DetailLevel>
  </HotelSearchCriteria>
</AvailabilitySearch>
';
    return $xiRequestContent;
}

    public function searchHotels($params)
    {
        $client = new Client();

        $response = $client->get($this->baseUrl . '/search', ['query' => $params, 'headers' => ['Authorization' => 'Bearer ' . $this->apiKey,],]);

        return json_decode($response->getBody()->getContents(), true);
    }

    // Add more methods as needed for different API endpoints

    public function sendRequest($xmlRequest)
    {
        $ch = curl_init($this->endpoint);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($ch);
        curl_close($ch);
        return $this->XMlToJSON($return);
    }




//    function sendRequest($xmlRequest) {
//        $lRequest = curl_init($this->endpoint);
//        curl_setopt($lRequest, CURLOPT_TIMEOUT, 0);
//        curl_setopt($lRequest, CURLOPT_POST, 1);
//        curl_setopt($lRequest, CURLOPT_POSTFIELDS, $xmlRequest);
//        curl_setopt($lRequest, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($lRequest, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
//        curl_setopt($lRequest, CURLOPT_TCP_KEEPALIVE, false);
//
//        $lResponse = curl_exec($lRequest);
//        curl_close($lRequest);
//        $this->XMlToJSON($lResponse);
////        return $lResponse;
//    }

    public function XMlToJSON($return)
    {
        $dom = new DOMDocument();
        $dom->loadXML($return);
        $json = new RabbitFish($dom);
        return json_decode($json, true);
    }



//    function sendRequest($xiRequestContent)
//    {
//        $lRequest = curl_init($this->endpoint);
//        curl_setopt($lRequest, CURLOPT_TIMEOUT, 0);
//        curl_setopt($lRequest, CURLOPT_POST, 1);
//        curl_setopt($lRequest, CURLOPT_POSTFIELDS, $xiRequestContent);
//        curl_setopt($lRequest, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($lRequest, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
//        curl_setopt($lRequest, CURLOPT_TCP_KEEPALIVE, false);
//
//        $lResponse = curl_exec($lRequest);
//        curl_close($lRequest);
//        return $lResponse;
//    }

}
