<?php
/*
SNN65 - restricted senior age (65 and older)
DP30 - 30 percent discount off of the base fare.
ADT: adult
CHD: child
INF: infant without a seat
INS: infant with a seat
UNN: unaccompanied child
*/
//dd($routesArr);
$message = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Body>
    <air:LowFareSearchReq MaxResults="2" TraceId="'.$trace_id.'" AuthorizedBy="'.$user.'" SolutionResult="true" TargetBranch="'.$target_branch.'" xmlns:air="http://www.travelport.com/schema/air_v42_0" xmlns:com="http://www.travelport.com/schema/common_v42_0">
      <com:BillingPointOfSaleInfo OriginApplication="UAPI" />';
foreach($routesArr['route'] as $route){
    $message .=     '<air:SearchAirLeg>
        <air:SearchOrigin>
          <com:Airport Code="'. $route['origin'].'" />
        </air:SearchOrigin>
        <air:SearchDestination>
          <com:Airport Code="'.$route['destination'].'" />
        </air:SearchDestination>
        <air:SearchDepTime PreferredTime="'.$route['deptime'] .'">';
    if($routesArr['flexi'] == '1'){
        $message .= '<com:SearchExtraDays DaysBefore="3" DaysAfter="3" />';
    }
    $message .= '</air:SearchDepTime>
        <air:AirLegModifiers>
              <air:PreferredCabins>
              <CabinClass xmlns="http://www.travelport.com/schema/common_v42_0" Type="'.$routesArr['cabinClass'].'"></CabinClass>
              </air:PreferredCabins>
              </air:AirLegModifiers>
      </air:SearchAirLeg>';
}

$directFlight = '';
if($routesArr['directFlight'] == true){
    $directFlight = '<air:AirSearchModifiers DirectFlightsOnly="true"/>';
}

// Add preferred airline code if provided
$preferredAirline = '';
if (!empty($routesArr['preferredAirline'])) {
    $preferredAirline = '
    <air:Airline Code="' . $routesArr['preferredAirline'] . '" />';
}

$message .= '
<air:AirSearchModifiers>
    ' . $preferredAirline . '
    <air:PreferredProviders>
        <com:Provider xmlns="http://www.travelport.com/schema/common_v42_0" Code="1G" />
    </air:PreferredProviders>
</air:AirSearchModifiers>';

$message .= '
      <com:SearchPassenger BookingTravelerRef="ADT1" Code="ADT" xmlns:com="http://www.travelport.com/schema/common_v42_0" />
      <com:SearchPassenger BookingTravelerRef="CNN0" Code="CNN" xmlns:com="http://www.travelport.com/schema/common_v42_0" />
      <com:SearchPassenger BookingTravelerRef="INF0" Code="INF" xmlns:com="http://www.travelport.com/schema/common_v42_0" />
      <air:AirPricingModifiers FaresIndicator="'.$routesArr['fareType'].'" CurrencyType="'.$routesArr['currency'].'">
      '.$directFlight.'

        <air:AccountCodes>
          <AccountCode xmlns="http://www.travelport.com/schema/common_v42_0" Code="-" />
        </air:AccountCodes>
      </air:AirPricingModifiers>


    </air:LowFareSearchReq>
  </soapenv:Body>
</soapenv:Envelope>';

?>
