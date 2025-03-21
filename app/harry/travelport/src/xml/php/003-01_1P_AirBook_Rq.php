<?php
//$segments = '';
//foreach($air_price_data[1][0]['journey'] as $segment){
//    $segments .= '<air:AirSegment ArrivalTime="'.$segment['ArrivalTime'].'" AvailabilitySource="'.$segment['AvailabilitySource'].'" Carrier="'.$segment['Carrier'].'" ChangeOfPlane="'.$segment['ChangeOfPlane'].'" DepartureTime="'.$segment['DepartureTime'].'" Destination="'.$segment['Destination'].'" Distance="'.$segment['Distance'].'" Equipment="'.$segment['Equipment'].'" FlightNumber="'.$segment['FlightNumber'].'" FlightTime="'.$segment['FlightTime'].'" Group="'.$segment['Group'].'" Key="'.$segment['key'].'" OptionalServicesIndicator="'.$segment['OptionalServicesIndicator'].'" Origin="'.$segment['Origin'].'" ParticipantLevel="'.$segment['ParticipantLevel'].'" ProviderCode="1G"/>';
////    $message .= '<air:AirSegment ArrivalTime="'.$segment['ArrivalTime'].'" AvailabilitySource="'.$segment['AvailabilitySource'].'" Carrier="'.$segment['Carrier'].'" ChangeOfPlane="'.$segment['ChangeOfPlane'].'" DepartureTime="'.$segment['DepartureTime'].'" Destination="'.$segment['Destination'].'" Distance="'.$segment['Distance'].'" ETicketability="'.$segment['eTicketability'].'" Equipment="'.$segment['Equipment'].'" FlightNumber="'.$segment['FlightNumber'].'" FlightTime="'.$segment['flightTime'].'" Group="'.$segment['Group'].'" Key="'.$segment['key'].'" OptionalServicesIndicator="'.$segment['OptionalServicesIndicator'].'" Origin="'.$segment['Origin'].'" ParticipantLevel="'.$segment['ParticipantLevel'].'" ProviderCode="1G"/>';
//}
//dd($air_price_data);
//dd($air_price_data[1][0]['journey']);
$message = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
 <univ:AirCreateReservationReq xmlns="http://www.travelport.com/schema/universal_v42_0" xmlns:univ="http://www.travelport.com/schema/universal_v42_0" xmlns:com="http://www.travelport.com/schema/common_v42_0" xmlns:air="http://www.travelport.com/schema/air_v42_0" TraceId="eba4083a-9162-4720-b4b3-52f52836a45c" AuthorizedBy="Travelport" TargetBranch="P3710270" ProviderCode="1G" RetainReservation="Both">
<BillingPointOfSaleInfo xmlns="http://www.travelport.com/schema/common_v42_0" OriginApplication="UAPI"/>
<BookingTraveler xmlns="http://www.travelport.com/schema/common_v42_0" Key="b1Fla0ZCTXZXZ0ZzdDdFaw==" TravelerType="ADT" Age="40" DOB="1983-05-12" Gender="M" Nationality="US">
<BookingTravelerName Prefix="Mr" First="Vineet" Last="Chauhan"/>
<DeliveryInfo>
<ShippingAddress Key="b1Fla0ZCTXZXZ0ZzdDdFaw==">
<Street>Via Augusta 59 5</Street>
<City>Madrid</City>
<State>IA</State>
<PostalCode>50156</PostalCode>
<Country>US</Country>
</ShippingAddress>
</DeliveryInfo>
<PhoneNumber Location="DEN" CountryCode="1" AreaCode="303" Number="123456789"/>
<Email EmailID="johnsmith@travelportuniversalapidemo.com"/>
<SSR Type="DOCS" FreeText="P/GB/S12345678/GB/20JUL76/M/01JAN16/SMITH/JOHN" Carrier="LH"/>
<Address>
<AddressName>DemoSiteAddress</AddressName>
<Street>Via Augusta 59 5</Street>
<City>Madrid</City>
<State>IA</State>
<PostalCode>50156</PostalCode>
<Country>US</Country>
</Address>
</BookingTraveler>
<FormOfPayment xmlns="http://www.travelport.com/schema/common_v42_0" Type="Check" Key="1">
<Check RoutingNumber="456" AccountNumber="7890" CheckNumber="1234567"/>
</FormOfPayment>
<air:AirPricingSolution Key="xS6hNFuCuDKAzjaDtkBAAA==" TotalPrice="GBP1224.98" BasePrice="GBP600.00" ApproximateTotalPrice="GBP1224.98" ApproximateBasePrice="GBP600.00" Taxes="GBP624.98" Fees="GBP0.00" ApproximateTaxes="GBP624.98" QuoteDate="2024-09-12">
                    <air:AirSegment Key="xS6hNFuCuDKAvjaDtkBAAA==" Group="0" Carrier="AI" FlightNumber="128" ProviderCode="1G" Origin="LHR" Destination="BOM" DepartureTime="2024-10-21T12:30:00.000+01:00" ArrivalTime="2024-10-22T01:45:00.000+05:30" FlightTime="525" TravelTime="525" Distance="4469" ClassOfService="G" Equipment="77W" ChangeOfPlane="false" OptionalServicesIndicator="false" AvailabilitySource="S" ParticipantLevel="Secure Sell" PolledAvailabilityOption="O and D cache or polled status used with different local status" AvailabilityDisplayType="Fare Specific Fare Quote Unbooked">
<air:CodeshareInfo OperatingCarrier="AI">Air India</air:CodeshareInfo>
<air:FlightDetails Key="xS6hNFuCuDKAwjaDtkBAAA==" Origin="LHR" Destination="BOM" DepartureTime="2024-10-21T12:30:00.000+01:00" ArrivalTime="2024-10-22T01:45:00.000+05:30" FlightTime="525" TravelTime="525" Distance="4469"/>
</air:AirSegment>
<air:AirSegment Key="xS6hNFuCuDKAxjaDtkBAAA==" Group="1" Carrier="AI" FlightNumber="129" ProviderCode="1G" Origin="BOM" Destination="LHR" DepartureTime="2024-10-30T06:35:00.000+05:30" ArrivalTime="2024-10-30T11:05:00.000+00:00" FlightTime="600" TravelTime="600" Distance="4469" ClassOfService="U" Equipment="77W" ChangeOfPlane="false" OptionalServicesIndicator="false" AvailabilitySource="S" ParticipantLevel="Secure Sell" PolledAvailabilityOption="O and D cache or polled status used with different local status" AvailabilityDisplayType="Fare Specific Fare Quote Unbooked">
<air:CodeshareInfo OperatingCarrier="AI">Air India</air:CodeshareInfo>
<air:FlightDetails Key="xS6hNFuCuDKAyjaDtkBAAA==" Origin="BOM" Destination="LHR" DepartureTime="2024-10-30T06:35:00.000+05:30" ArrivalTime="2024-10-30T11:05:00.000+00:00" FlightTime="600" TravelTime="600" Distance="4469"/>
</air:AirSegment>
            <air:AirPricingInfo Key="xS6hNFuCuDKA4jaDtkBAAA==" TotalPrice="GBP612.49" BasePrice="GBP300.00" ApproximateTotalPrice="GBP612.49" ApproximateBasePrice="GBP300.00" ApproximateTaxes="GBP312.49" Taxes="GBP312.49" LatestTicketingTime="2024-10-21T23:59:00.000+01:00" PricingMethod="Guaranteed" Refundable="true" IncludesVAT="false" ETicketability="Yes" PlatingCarrier="AI" ProviderCode="1G">
                                <air:FareInfo Key="xS6hNFuCuDKAAkaDtkBAAA==" FareBasis="GK2YXSLH" PassengerTypeCode="ADT" Origin="LHR" Destination="BOM" EffectiveDate="2024-09-12T05:58:00.000+01:00" DepartureDate="2024-10-21" Amount="GBP190.00" NegotiatedFare="false" NotValidBefore="2024-10-21" NotValidAfter="2024-10-21" TaxAmount="GBP214.89">
                                  <air:FareRuleKey FareInfoRef="xS6hNFuCuDKAAkaDtkBAAA==" ProviderCode="1G">6UUVoSldxwjHBBf2tHJqkMbKj3F8T9EyxsqPcXxP0TLGyo9xfE/RMsuWFfXVd1OAly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA4U/UuC8/Pq3xWa1uaqI55k3aSkvhp2ybZYk29vFAAoAqeJcbLq3iqrAyGqh8JIaqH9I8Xff+g7hzcL6002PTZWcqkIBiBlLs+r/bRGkSYBeVvL0gTWvGVKnsahilB5/WNprSJ5QUeMSfv7IV8J6vLR9MsYGjb3UroB1xjSbRrjKTicpvYbmY4WEl93qi3+DNX8dCM9gdzQXir5wkVQHOuKXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dc3mNX1GvOry3EdbqPPDZRsBAkLPMThzJyx73eTmhAqRJFzFvQvADQEdwNyTGVaoYtCI+lx0s0p8=</air:FareRuleKey>
                                  </air:FareInfo>
                                  <air:FareInfo Key="xS6hNFuCuDKAjkaDtkBAAA==" FareBasis="UK2YXSLH" PassengerTypeCode="ADT" Origin="BOM" Destination="LHR" EffectiveDate="2024-09-12T05:58:00.000+01:00" DepartureDate="2024-10-30" Amount="GBP110.00" NegotiatedFare="false" NotValidBefore="2024-10-30" NotValidAfter="2024-10-30" TaxAmount="GBP97.60">
                                  <air:FareRuleKey FareInfoRef="xS6hNFuCuDKAjkaDtkBAAA==" ProviderCode="1G">6UUVoSldxwjHBBf2tHJqkMbKj3F8T9EyxsqPcXxP0TLGyo9xfE/RMsuWFfXVd1OAly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA4U/UuC8/Pq3xWa1uaqI55k3aSkvhp2yberXTBl9Nbz4dqFBpcTxsHXAyGqh8JIaqEQXfyqmQ3wmzcL6002PTZVZgTpeBfybAur/bRGkSYBeVvL0gTWvGVKnsahilB5/WNprSJ5QUeMSfv7IV8J6vLR9MsYGjb3Urjyy/Q52QOiITicpvYbmY4VnbowN/PJLQVK0KoKxHjgMir5wkVQHOuKXLmrFneovA5cuasWd6i8Dly5qxZ3qLwOXLmrFneovA5cuasWd6i8Dc3mNX1GvOry3EdbqPPDZRsBAkLPMThzJyx73eTmhAqRJFzFvQvADQEdwNyTGVaoYtCI+lx0s0p8=</air:FareRuleKey>
                                  </air:FareInfo>
                                <air:BookingInfo BookingCode="G" CabinClass="Economy" FareInfoRef="xS6hNFuCuDKAAkaDtkBAAA==" SegmentRef="xS6hNFuCuDKAvjaDtkBAAA==" HostTokenRef="xS6hNFuCuDKA0jaDtkBAAA=="/>
                                <air:PassengerType Code="ADT" BookingTravelerRef="b1Fla0ZCTXZXZ0ZzdDdFaw==" /><air:AirPricingModifiers FaresIndicator="PublicFaresOnly" CurrencyType="GBP"> ◀
            <air:BrandModifiers ModifierType="FareFamilyDisplay" />
            </air:AirPricingModifiers></air:AirPricingInfo>
                </air:AirPricingSolution>
<ActionStatus xmlns="http://www.travelport.com/schema/common_v42_0" Type="ACTIVE" TicketDate="T*" ProviderCode="1G"/>
<Payment xmlns="http://www.travelport.com/schema/common_v42_0" Key="2" Type="Itinerary" FormOfPaymentRef="1" Amount="GBP1224.98"/>
</univ:AirCreateReservationReq>
        </soap:Body>
    </soap:Envelope>';
//dd($message);
