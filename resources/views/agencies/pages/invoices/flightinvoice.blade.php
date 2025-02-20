@php
    use Carbon\Carbon;
@endphp




    <script src="https://cdn.tailwindcss.com"></script>
    <div class="bg-white shadow-md rounded-lg px-20 w-[772px] mx-auto" id="invoiceContainer">
        <div class="flex items-center  flex-col justify-between">
            <div class="flex items-center border-b-[2px] border-gray-700 w-full">
                <img src="https://cloud-travel.co.uk/software/public/images/logo.png" alt="Cloud Travel"
                    class="h-24 mr-4" />
            </div>
        </div>



        <div class="grid grid-cols-3 gap-2 mt-4">

            <div class="w-full ">
                &nbsp
            </div>
            <div class="w-full flex justify-center">
                <h1 class="text-2xl font-bold">INVOICE</h1>
            </div>
            <div class=" w-full text-right flex flex-col">
                <div class="flex justify-end items-center">
                    <h1 class="font-bold text-sm ">Invoice Date:</h1>
                    <span class="font-normal text-sm ml-2">04/05/1998</span>
                </div>
                <div class="flex justify-end items-center">
                    <h1 class="font-bold text-sm ">Invoice No:</h1>
                    <span class="font-normal text-sm ml-2">CLDI0006044</span>
                </div>
                <div class="flex justify-end items-center">
                    <h1 class="font-bold text-sm ">Client ID:</h1>
                    <span class="font-normal text-sm ml-2">CLDI0006044</span>
                </div>


            </div>
        </div>
        <div class="mt-4 grid grid-cols-2 ">
            <div class="w-full ">
                <h2 class="text-lg font-bold text-[#26ace2]">TO</h2>
                <p class="text-sm">
                    8580984998
                </p>
                <p class="text-sm">8580984998</p>
                <p class="text-sm">8580984998</p>
                <p class="text-sm">8580984998</p>
                <p class="text-sm">8580984998</p>
                <p class="text-sm">8580984998 </p>
                <p class="text-sm"><strong>TEL:</strong>8580984998</p>
                <p class="text-sm"><strong>E-MAIL:</strong>8580984998 </p>
            </div>

            <div class="w-full text-right">
                <h2 class="text-lg font-bold text-[#26ace2]">ISSUED BY</h2>
                <p class="text-sm">62 KING STREET,</p>
                <p class="text-sm">SOUTHALL,</p>
                <p class="text-sm">MIDDLESEX,</p>
                <p class="text-sm">UB2 4DB</p>
                <p class="text-sm"><strong>TEL:</strong> 02035000000</p>
                <p class="text-sm"><strong>E-MAIL:</strong> info@cloudtravels.co.uk</p>
            </div>
        </div>
        <div class="mt-4 w-full">
            <h2 class="text-md font-bold  bg-[#26ace2] p-3 w-max text-white">FLIGHT</h2>
            <h3 class="text-md font-bold text-black mt-6">1. Passenger Details</h3>
            <div class="w-full overflow-hidden mt-2">
                <table class="w-full">
                    <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                        <td class="p-1 border-r-[1px] border-gray-100">S#</td>
                        <td class="p-1 border-r-[1px] border-gray-100">PAX TYPE</td>
                        <td class="p-1 border-r-[1px] border-gray-100">TITLE / FIRST NAME</td>
                        <td class="p-1 border-r-[1px] border-gray-100">LAST NAME</td>
                        <td class="p-1">GENDER</td>
                    </tr>

                    {{-- Display Adult Passenger Details --}}
                    @if (isset($adultPassengerDetails[0]) && is_array($adultPassengerDetails[0]))
                        @foreach ($adultPassengerDetails[0] as $index => $title)
                            <tr class="text-black text-sm border-b-[1px] border-blue-100">
                                <td class="p-1">{{ $index + 1 }}</td>
                                <td class="p-1">ADULT</td>
                                <td class="p-1">{{ $title }} {{ $adultPassengerDetails[1][$index] ?? '' }}
                                </td>
                                <td class="p-1">{{ $adultPassengerDetails[3][$index] ?? '' }}</td>
                                <td class="p-1">{{ $adultPassengerDetails[4][$index] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- Display Child Passenger Details --}}
                    @if (isset($childPassengerDetails[0]) && is_array($childPassengerDetails[0]))
                        @foreach ($childPassengerDetails[0] as $index => $title)
                            <tr class="text-black text-sm border-b-[1px] border-blue-100">
                                <td class="p-1">{{ $index + 1 + count($adultPassengerDetails[0] ?? []) }}</td>
                                <td class="p-1">CHILD</td>
                                <td class="p-1">{{ $title }} {{ $childPassengerDetails[1][$index] ?? '' }}
                                </td>
                                <td class="p-1">{{ $childPassengerDetails[3][$index] ?? '' }}</td>
                                <td class="p-1">{{ $childPassengerDetails[4][$index] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- Display Infant Passenger Details --}}
                    @if (isset($infantPassengerDetails[0]) && is_array($infantPassengerDetails[0]))
                        @foreach ($infantPassengerDetails[0] as $index => $title)
                            <tr class="text-black text-sm border-b-[1px] border-blue-100">
                                <td class="p-1">
                                    {{ $index + 1 + count($adultPassengerDetails[0] ?? []) + count($childPassengerDetails[0] ?? []) }}
                                </td>
                                <td class="p-1">INFANT</td>
                                <td class="p-1">{{ $title }} {{ $infantPassengerDetails[1][$index] ?? '' }}
                                </td>
                                <td class="p-1">{{ $infantPassengerDetails[3][$index] ?? '' }}</td>
                                <td class="p-1">{{ $infantPassengerDetails[4][$index] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif

                </table>



                <h3 class="text-md font-bold text-[#26ace2] ">Note - * denotes the lead passenger</h3>

            </div>
  {{dd($$details[0]['journey'])}}
            <h3 class="text-md font-bold text-black mt-6">2. Flight Details</h3>
            <div class="flex flex-wrap gap-2 mt-4">
                <div class="pr-4 border-r-[1px] border-[#aed6f1]">
                    <h3 class="text-sm font-bold text-[#26ace2]"><span class="text-black">AIRLINE REF:</span> VS DEIS32
                    </h3>
                </div>
                {{-- <div class="pr-4 border-r-[1px] border-[#aed6f1]">
                    <h3 class="text-sm  text-[#26ace2] "></h3>
                </div> --}}
                <div class="pr-4 border-r-[1px] border-[#aed6f1]">
                    <h3 class="text-sm font-bold text-[#26ace2]"><span class="text-black">PNR:</span> 7ZP600</h3>
                </div>
                <div class="pr-4 border-r-[1px] border-[#aed6f1]">
                    <h3 class="text-sm font-bold text-[#26ace2]"><span class="text-black">UN PNR:</span>
                        IBE12052061-BS5479</h3>
                </div>
                <div class="pr-4 border-r-[1px] border-[#aed6f1]">
                    <h3 class="text-sm font-bold text-[#26ace2]"><span class="text-black">BOOKING DATE:</span>
                        13/08/2024

                    </h3>
                </div>

            </div>

            <div class="w-full overflow-hidden mt-2">
                {{-- <table class="w-full ">
                    <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                        <td class="p-1 border-r-[1px] border-gray-100">AIRLINE</td>
                        <td class="p-1 border-r-[1px] border-gray-100">DEPARTURE</td>
                        <td class="p-1 border-r-[1px] border-gray-100">ARRIVAL</td>
                        <td class="p-1 border-r-[1px] border-gray-100">CLASS</td>
                        <td class="p-1 border-r-[1px] border-gray-100">BAGGAGE</td>
                        <td class="p-1 border-r-[1px] border-gray-100">DURATION</td>
                        <td class="p-1">STOPS</td>
                    </tr>


                    @foreach ($details[0]['journey'] as $flight)
                        <tr class="text-black text-sm border-b-[1px] border-blue-100">
                            <td class="p-1">
                                @php
                                    $carrier = \App\Models\Airline::where('iata', $flight['Carrier'])->first();
                                    $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';
                                @endphp

                                {{ $flight['Carrier'] }} ({{ $carrierName }}) <br>
                                FLIGHT NO :- {{ $flight['FlightNumber'] }}
                            </td>



                            <td class="p-1">
                                {{ $flight['Origin'] }} <br>
                                {{ Carbon::parse($flight['DepartureTime'])->format('d/m/Y h:i A') }} <br>
                                TERMINAL :- {{ $flight['Group'] }}
                            </td>

                            <td class="p-1">
                                {{ $flight['Destination'] }} <br>
                                {{ Carbon::parse($flight['ArrivalTime'])->format('d/m/Y h:i A') }} <br>
                                TERMINAL :- {{ $flight['Group'] }}
                            </td>

                            <td class="p-1">{{ $flight['ClassOfService'] }}</td>
                            <td class="p-1">
                                @php
                                    // Safely access the carryon allowance info
                                    $carryonallowance = $details[1]['details']['carryonallowanceinfo'] ?? '0 KG';
                                    $numericCarryonallowance = preg_replace('/\D/', '', $carryonallowance);

                                    // Safely access the baggage allowance info
                                    $baggageonallowance = $details[1]['details']['baggageallowanceinfo'] ?? '0 KG';
                                    $numericBaggageonallowance = preg_replace('/\D/', '', $baggageonallowance);
                                @endphp
                                {{ $numericCarryonallowance }} KG + {{ $numericBaggageonallowance }} KG
                            </td>



                            <td class="p-1">
                                @php
                                    $flightTimeMinutes = intval($flight['FlightTime']);
                                    $hours = intdiv($flightTimeMinutes, 60);
                                    $minutes = $flightTimeMinutes % 60;
                                @endphp
                                {{ $hours }} hrs {{ $minutes }} mins
                            </td>

                            <td class="p-1">0</td>
                        </tr>
                    @endforeach
                </table> --}}
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#aed6f1] text-black font-bold text-sm">
                            <td class="p-1 border-r-[1px] border-gray-100">AIRLINE</td>
                            <td class="p-1 border-r-[1px] border-gray-100">DEPARTURE</td>
                            <td class="p-1 border-r-[1px] border-gray-100">ARRIVAL</td>
                            <td class="p-1 border-r-[1px] border-gray-100">CLASS</td>
                            <td class="p-1 border-r-[1px] border-gray-100">BAGGAGE</td>
                            <td class="p-1 border-r-[1px] border-gray-100">DURATION</td>
                            <td class="p-1">STOPS</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $groupedFlights = [];

                            foreach ($details[0]['journey'] as $flight) {
                                $groupedFlights[$flight['Group']][] = $flight;
                            }
                        @endphp

                        @foreach ($groupedFlights as $group => $flights)
                            @php
                                $firstFlight = $flights[0];
                                $lastFlight = end($flights);
                                $stopCount = count($flights) - 1;

                                $totalTravelTime = 0;

                                foreach ($flights as $flight) {
                                    $totalTravelTime += intval($flight['TravelTime']);
                                }

                                $totalHours = intdiv($totalTravelTime, 60);
                                $totalMinutes = $totalTravelTime % 60;
                            @endphp

                            <tr class="bg-[#d6eaf8] text-black font-bold text-sm cursor-pointer"
                                onclick="toggleGroup('{{ $group }}')">
                                <td colspan="7" class="p-2 text-center">
                                    From {{ $firstFlight['Origin'] }} to {{ $lastFlight['Destination'] }}
                                    ({{ $totalHours }} hrs {{ $totalMinutes }} mins, {{ $stopCount }} stops)
                                </td>
                            </tr>

                            @foreach ($flights as $flight)
                                @php
                                    $departureTime = Carbon::parse($flight['DepartureTime']);
                                    $arrivalTime = Carbon::parse($flight['ArrivalTime']);
                                    $duration = $departureTime->diff($arrivalTime);
                                    $hours = $duration->h;
                                    $minutes = $duration->i;
                                    $carryonAllowance = $details[1]['details']['carryonallowanceinfo'] ?? 'N/A';
                                    $baggageAllowance = $details[1]['details']['baggageallowanceinfo'] ?? 'N/A';
                                @endphp

                                <tr
                                    class="flight-row-{{ $group }} text-black text-sm border-b-[1px] border-blue-100">
                                    <td class="p-1">
                                        @php
                                            $carrier = \App\Models\Airline::where('iata', $flight['Carrier'])->first();
                                            $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';
                                        @endphp
                                        {{ $carrierName }} ({{ $flight['Carrier'] }}) <br>
                                        FLIGHT NO :- {{ $flight['FlightNumber'] }}
                                    </td>

                                    <td class="p-1">
                                        @php
                                            $originAirport = \App\Models\Airport::where(
                                                'code',
                                                $flight['Origin'],
                                            )->first();
                                            $originAirportName = $originAirport
                                                ? $originAirport->airport
                                                : 'Unknown Airport';
                                        @endphp
                                        {{ $originAirportName }} ({{ $flight['Origin'] }}) <br>
                                        {{ Carbon::parse($flight['DepartureTime'])->format('d/m/Y h:i A') }} <br>
                                        TERMINAL :- {{ $flight['Terminal'] ?? 'N/A' }}
                                    </td>

                                    <td class="p-1">
                                        @php
                                            $destinationAirport = \App\Models\Airport::where(
                                                'code',
                                                $flight['Destination'],
                                            )->first();
                                            $destinationAirportName = $destinationAirport
                                                ? $destinationAirport->airport
                                                : 'Unknown Airport';
                                        @endphp
                                        {{ $destinationAirportName }} ({{ $flight['Destination'] }}) <br>
                                        {{ Carbon::parse($flight['ArrivalTime'])->format('d/m/Y h:i A') }} <br>
                                        TERMINAL :- {{ $flight['Terminal'] ?? 'N/A' }}
                                    </td>

                                    <td class="p-1">{{ $flight['ClassOfService'] }}</td>

                                    <td class="p-1">
                                        @if ($carryonAllowance != 'N/A' && $baggageAllowance != 'N/A')
                                            {{ $carryonAllowance }} + {{ $baggageAllowance }}
                                        @elseif($carryonAllowance != 'N/A')
                                            {{ $carryonAllowance }}
                                        @elseif($baggageAllowance != 'N/A')
                                            {{ $baggageAllowance }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="p-1">
                                        {{ $hours }} hrs {{ $minutes }} mins
                                    </td>

                                    <td class="p-1">0</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
                <script>
                    function toggleGroup(group) {
                        var rows = document.querySelectorAll('.flight-row-' + group);
                        rows.forEach(row => {
                            row.classList.toggle('hidden');
                        });
                    }
                </script>

                @php

                    $basePrice = $details[2]['price']['BasePrice'];
                    $formattedBasePrice = preg_replace('/([a-zA-Z]+)(\d+)/', '$1 $2', $basePrice);

                    $fees = $details[2]['price']['Fees'];
                    $formattedFees = preg_replace('/([a-zA-Z]+)(\d+)/', '$1 $2', $fees);

                    $taxes = $details[2]['price']['Taxes'];
                    $formattedTaxes = preg_replace('/([a-zA-Z]+)(\d+)/', '$1 $2', $taxes);

                    $totalPrice = $details[2]['price']['TotalPrice'];
                    $formattedTotalPrice = preg_replace('/([a-zA-Z]+)(\d+)/', '$1 $2', $totalPrice);
                @endphp

                <h3 class="text-md font-bold text-[#26ace2] text-right pt-6">
                    <span class="pr-6 text-black">Base:</span> {{ $formattedBasePrice }}
                </h3>
                <h3 class="text-md font-bold text-[#26ace2] text-right">
                    <span class="pr-6 text-black">Fees:</span> {{ $formattedFees }}
                </h3>
                <h3 class="text-md font-bold text-[#26ace2] text-right pb-2 border-b-[1px] border-gray-100">
                    <span class="pr-6 text-black">Taxes:</span> {{ $formattedTaxes }}
                </h3>
                <h3 class="text-md font-bold text-[#26ace2] text-right pt-2 pb-6">
                    <span class="pr-6 text-black">Total:</span> {{ $formattedTotalPrice }}
                </h3>


                {{-- <h3 class="text-md text-black text-right">
                    <strong class="pr-6">Total Amount: </strong> £560.00
                </h3>
                <h3 class="text-md text-black text-right">
                    <strong class="pr-6">Balance Amount:</strong> £560.00
                </h3> --}}


            </div>


        </div>


        <div class="flex flex-col mt-4">
            <span>Terms and Conditions</span>
            <strong>Notes:</strong>


            <ul class="list-disc pl-6 mt-4">
                <li><strong>This sale is covered by ATOL number 11867. </strong></li>
                <li> There is no liability if airline(s) above cease to trade, unless Scheduled Airline Failure
                    Insurance
                    (SAFI) has been paid.
                </li>
                <li>Passengers travelling to/ or via USA/CANADA: will require an ESTA at least 72 hours prior to travel,
                    even for transit purposes.
                </li>
                <li>Children under 18 travelling to South Africa and Botswana: All minors travelling will be required to
                    carry certified copies Birth Certificate, and if only one parent is travelling, certified written
                    consent from the other parent to allow the child to travel.
                </li>
                <li>If there are any long (or overnight transits), include multiple transit points in route within a
                    country, it is the passenger’s responsibility to make the necessary accommodation and visa
                    arrangements.
                </li>
                <li><strong>Foreign & Commonwealth Office Travel Advice: </strong> The Foreign & Commonwealth Office
                    (FCO)
                    issues travel advice on destinations, which include information on passports, visas, health, safety
                    and
                    security and more. For more information refer to the link:
                    <a href="https://www.gov.uk/foreign-travel-advice"
                        class="text-[#26ace2]">https://www.gov.uk/foreign-travel-advice</a>
                    New Security <strong>Requirements For Airlines:</strong> Phones, laptops and tablets larger than
                    16.0cm
                    x 9.3cm x 1.5cm not allowed in the cabin on flights to the UK from Turkey, Lebanon, Egypt, Saudi
                    Arabia,
                    Jordan and Tunisia. For more information please see
                    <a href="https://www.gov.uk/government/news/additional-hand-luggage-restrictions-on-some-flights-to-the-uk"
                        class="text-[#26ace2]">https://www.gov.uk/government/news/additional-hand-luggage-restrictions-on-some-flights-to-the-uk</a>
                </li>
            </ul>

            <strong class="mt-2">Notes:</strong>
            <p>Reconfirmation of any onward / return journey is passengers’ responsibility.</p>
            <p>Valid travel documentation such as valid passport, visa, and health precautions are passengers’
                responsibility.</p>
            <p>Timings are subject to change, please reconfirming with your airline operator before you fly.</p>
            <p>Any reissue / revalidation / cancellation will incur a fee. Any passengers under 18 years on age
                travelling
                to South Africa will be denied boarding if not carrying their original birth certificate. Any passengers
                who
                hold an OCI who travel to INDIA without their original OCI card will be denied boarding.</p>


            <strong>Your Financial Protection</strong>
            <p>When you buy an ATOL protected fight or flight inclusive holiday from us you will receive an ATOL
                Certificate. This lists what is financially protected, where you can get information on what this means
                for
                you and who to contact is things go wrong.</p>


            <strong>Travelling against the FCO’s advice</strong>
            <p class="mt-2">Critically, you may invalidate your insurance cover, including healthcare protections, or
                be
                unable to obtain it, if you’ve not yet bought any.</p>

            <p class="mt-2">So, call your insurer/check the wording of your insurance policy if you’re planning to
                take this
                risk. If you get ill while you’re travelling, you may not be able to get the treatment you need – or
                treatment may end up being very delayed and incredibly costly.</p>
            <p>Expect disruption to your travel arrangements, both:</p>
            <ul class="list-disc pl-6 mt-4">
                <li>while you’re in-country (many countries are operating Covid-19 screening procedures as a condition
                    of
                    entry and, in some cases, quarantine measures preventing you from any contact with local resident at
                    your destination)
                </li>
                <li>on your return, including the risk that you may not be able to get back home if borders close and/or
                    that you may face quarantine and self-isolation obligations when you get back. This will mean being
                    away
                    from your workplace, school/place of study and ensuring you have no social interactions for that
                    period
                    of quarantine
                </li>
            </ul>

            <strong class="mt-2">Passenger Notice:</strong>
            <p>Carriage and other services provided by the carrier are subject to conditions of contract, which are
                hereby
                incorporated by reference. These conditions may be obtained from the issuing carrier. The
                itinerary/receipt
                constitutes the passenger ticket for the purposes of Article 3 of the Warsaw convention, except where
                the
                carrier delivers to the passenger another document complying with the requirements of Article 3. If the
                passenger's journey involves an ultimate destination or stop in a country other than the country of
                departure the Warsaw Convention may be applicable, and the convention governs, and in most cases limits,
                the
                liability of carriers for death or personal injury and in respect of loss of or damage to baggage. See
                also
                notices headed Advice to International Passengers on limitation of liability and notice of baggage
                liability
                limitations. Full conditions can be found at www.iata.org If you are travelling to USA, all qualified
                Visa
                Waiver Program travellers will be required to obtain electronic travel authorization prior to boarding
                an
                air or sea carrier to the United States.</p>
            <p>Electronic System for Travel Authorization (ESTA) to USA</p>
            <p>Travellers who do not receive travel authorization prior to their departure may be denied boarding,
                experience delays or be denied admission into the United States. Applications may be submitted at any
                time
                prior to travel, but no less than 72 hours prior to departure.</p>
            <p>Travel Authorization is obtained through an online registration system known as the Electronic System for
                <strong>Travel Authorization (ESTA).</strong>
            </p>
            <p>If your registration is successful, it will be valid for multiple applications for two years or until the
                date on which your passport expires, whichever comes first.</p>
            <p>Submit your ESTA Application at <a
                    href="https://cloud-travel.co.uk/software/public/invoice/view/www.iata.org"
                    class="text-[#26ace2]">www.iata.org</a>
            </p>
            <strong class="mt-2">Note/Disclaimer: It is the sole responsibility of the passenger to ensure his/her
                eligibility to enter the destination country. Cloud Travel accepts no liability in this regard.</strong>
            <strong>In case of Visa, Flight suspensions, cancellation or not operating in that case we will apply for a
                full
                refund from airline and we will only Deduct our Service charge and all other ATOL/IATA protections, cash
                handling fee, administration charges will be applied</strong>

            <span class="mt-20 text-right">Yours Sincerely</span>


        </div>


    </div>

    <div class="flex justify-center mt-4">
        <button id="printInvoice" class="bg-[#28a745] text-white text-sm px-2 py-1 rounded-sm"  onclick="
         var printContents = document.getElementById('invoiceContainer').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        " >
            Print Invoice
        </button>
    </div>



