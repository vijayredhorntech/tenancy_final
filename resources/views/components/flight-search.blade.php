
<div id="loading_overlay1" class="hidden">
    <div class="fixed inset-0 justify-center flex h-screen w-full bg-ternary items-center z-30 opacity-90"> </div>

    <div class="z-40 fixed inset-0  justify-center  flex  h-screen w-full items-center p-4">
        <div class="lg:w-[50%] md:w-[80%] w-full rounded-[30px]  bg-white p-4 pt-8 shadow-lg shadow-black/60 flex flex-col items-center">
            <div class="relative flex justify-center items-center">
                <div class="absolute animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-secondary"></div>
                <img src="https://www.svgrepo.com/show/509001/avatar-thinking-9.svg"  class="rounded-full h-16 w-16">
            </div>
            <div class="w-full mt-4 flex justify-center flex items-center">
                <span class="font-medium text-md text-secondary">Searching Flights</span>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
                <div class="h-1 w-1 rounded-full bg-secondary animate-ping ml-2"></div>
            </div>
            <div id="loaderFlightPath" class=" w-full grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-6 mt-2">
                <div class="w-full flex flex-col px-4 ">
                    <span class="font-medium text-sm text-gray-600"><i class="fa fa-plane-departure text-sm text-secondary mr-2" ></i> Departure From</span>
                     <div class="mt-2 mb-1"> <span class="font-semibold text-gray-600 text-md" id="loaderLeavingFrom"></span> </div>
                    <span class="font-medium text-sm text-secondary" id="loaderDepartureDate"></span>
                </div>
                <div class="flex flex-col justify-center items-center px-4">
                      <div class="w-full flex  items-center">
                        <div class="h-16 w-16 flex-none rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                            <div class="h-12 w-12 rounded-full flex justify-center items-center bg-secondary/20 border-[1px] border-secondary/10">
                                <div class="h-8 w-8 rounded-full flex justify-center items-center bg-secondary">
                                      <i class="fa fa-plane-departure text-white text-xs"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-full grow bg-[#f3f4f6] flex justify-center">
                            <span class="font-medium text-xs text-secondary" id="loaderFlightType"></span>
                        </div>
                        <div class="w-8 h-8 flex-none rounded-full bg-secondary flex justify-center items-center">
                            <i class="fa fa-plane-arrival text-white text-xs"></i>
                        </div>
                    </div>
                </div>
                <div class="w-full flex flex-col px-4">
                    <span class="font-medium text-sm text-gray-600"><i class="fa fa-plane-arrival text-sm text-secondary mr-2" ></i>Arrival At</span>
                    <div class="mt-2 mb-1"><span class="font-semibold text-gray-600 text-md" id="loaderArrivalTo"></span></div>
                    <span class="font-medium text-sm text-secondary" id="loaderReturnDate"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w-full m-auto h-auto flex flex-col justify-center  bg-white px-4 pb-6  rounded-b-md" >
    @php
        $airports = \App\Models\Airport::all();
        //  dd($airports);
    @endphp
    <form  action="{{ route('flight.search') }}" method="post" autocomplete="off" id="flightSearch">
        @csrf
        <div class="flex gap-4 lg:flex-row md:flex-row sm:flex-row flex-col ">
            <div data-validation-key="type" class="flex gap-2 items-center">
                <label class="flex items-center">
                    <div class="px-2 py-1.5 bg-ternary/10 rounded-[5px] font-semibold text-sm hover:bg-primary/30 hover:text-black transition ease-in duration-2000">
                        <input name="type" type="radio"
                               class="rounded-full border-primaryDarkColor text-primaryColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50"
                               value="return" {{ $defaults['type'] === 'return' ? 'checked' : '' }}
                               onclick="changeFlightType(this)">
                        <span class="ml-1">Return</span>
                    </div>
                </label>
                <label class="flex items-center">
                    <div class="px-2 py-1.5 bg-ternary/10 rounded-[5px] font-semibold text-sm hover:bg-primary/30 hover:text-black transition ease-in duration-2000">
                        <input name="type" type="radio"
                               class="rounded-full border-primaryDarkColor text-primaryColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50"
                               value="oneWay" {{ $defaults['type'] === 'oneWay' ? 'checked' : '' }}
                               onclick="changeFlightType(this)">
                        <span class="ml-1">One Way</span>
                    </div>
                </label>
                <label class="flex items-center">
                    <div class="px-2 py-1.5 bg-ternary/10 rounded-[5px] font-semibold text-sm hover:bg-primary/30 hover:text-black transition ease-in duration-2000">
                        <input name="type" type="radio"
                               class="rounded-full border-primaryDarkColor text-primaryColor shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50"
                               value="multiCity" onclick="changeFlightType(this)" disabled>
                        <span class="ml-1">Multi City</span>
                    </div>
                </label>
            </div>
            <div class="flex items-center">
                <div class="lg:pl-4 md:pl-4 pl-0">
                    <label class="flex items-center">
                        <input name="directFlight" type="checkbox"
                               class="rounded-sm border-secondary text-primary shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50"
                               value="true" @checked($defaults['directFlight'])>
                        <span class="ml-2 text-ternary font-bold text-sm">Direct Flight</span>
                    </label>
                </div>
                <div class="pl-4 {{ $defaults['type'] === 'oneWay' ? 'hidden' : '' }}" id="flexiCheckBoxDiv">
                    <label class="flex items-center">
                        <input name="flexi" type="checkbox" id="flexiCheckBox"
                               class="rounded-sm border-secondary text-primary shadow-sm focus:border-primaryDarkColor focus:ring-0 focus:outline-none disabled:opacity-50"
                               value="true">
                        <span class="ml-2 text-ternary font-bold text-sm">Flexi (+/- 3 Days)</span>
                    </label>
                </div>

            </div>
        </div>

        <div class="mt-8 grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 gap-x-2 gap-y-4">
            <div class="lg:col-span-2 col-span-1 w-full relative flex flex-col" style="height: max-content;">
                <label for="leavingFrom" class="text-ternary font-bold text-sm">Leaving From</label>
                 <div class="w-full relative">
                     <input
                         class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                         name="origin" type="text" id="originInput" required placeholder="Leaving From..."
                         value="{{ $defaults['origin'] }}">
                        <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                        <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                 </div>

                @if ($errors->has('origin'))
                    <span class="text-red-600">{{ $errors->first('origin') }}</span>
                @endif
                <div id="originOptions" class=" absolute top-[100%] left-0 w-full rounded-b-[3px] z-40 bg-gray-100"></div>
                <div id="leaveToErrorMessage" style="color: red; display: none;"></div>
            </div>
            <div class="lg:col-span-2 col-span-1 w-full relative flex flex-col">
                <label for="arriveTo" class="text-ternary font-bold text-sm">Arrive To</label>
                <div class="w-full relative">
                            <input
                                class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                name="destination" type="text" id="destinationInput" required
                                placeholder="Arrive To..." value="{{ $defaults['destination'] }}">
                    <i class="fa fa-location-dot text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>

                @if ($errors->has('destination'))
                    <span class="text-red-600">{{ $errors->first('destination') }}</span>
                @endif
                <div id="destinationOptions" class="bg-white absolute top-[100%] left-0 w-full rounded-b-[3px] z-40 bg-gray-100"></div>
                <div id="arriveToErrorMessage" style="color: red; display: none;"></div>

            </div>
            <div class=" w-full relative flex flex-col {{ $defaults['type'] === 'oneWay' ? 'col-span-2' : '' }}" id="departureDateContainer">
                <label for="departureDate" class="text-ternary font-bold text-sm">Departure Date</label>
                <div class="w-full relative">
                            <input name="departureDate" type="date" id="departureDate" required
                                   class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                   placeholder="Departure Date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                   onchange="setMinReturnDate(this)" onclick="this.showPicker()"
                                   value="{{ $defaults['departureDate'] }}">
                    <i class="fa fa-calendar-days text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>

                @if ($errors->has('departureDate'))
                    <span class="text-red-600">{{ $errors->first('departureDate') }}</span>
                @endif
            </div>
            <div class=" w-full relative flex flex-col {{ $defaults['type'] === 'oneWay' ? 'hidden' : '' }}" id="returnDateContainer">
                <label for="returnDate" class="text-ternary font-bold text-sm">Return Date</label>
                <div class="w-full relative">
                                <input name="returnDate" type="date" id="returnDate"
                                                                  class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60"
                                                                  placeholder="Return Date"
                                                                  {{ $defaults['type'] === 'return' ? '' : 'disabled' }}
                                                                  onclick="this.showPicker()"
                                                                  value="{{ $defaults['returnDate'] }}">
                    <i class="fa fa-calendar-days text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('returnDate'))
                    <span class="text-red-600">{{ $errors->first('returnDate') }}</span>
                @endif
            </div>
        </div>

        <div id="sameAirportErrorMessage" style="color: red; display: none;">Leaving From and Arrive To cannot be the same</div>


        <div class="mt-8 grid lg:grid-cols-6 md:grid-cols-4 grid-cols-2 gap-x-2 gap-y-4">
            <div class="w-full relative flex flex-col">
                <label for="adult" class="text-ternary font-bold text-sm">Adult (&gt;15)</label>
                <div class="w-full relative">
                <select name="adult" data-validation-key="adult"
                        class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                    @for ($i = 1; $i <= 9; $i++)
                        <option value="{{ $i }}" class="text-ternary font-bold text-sm"
                            {{ $defaults['adult'] == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>
                    <i class="fa fa-person text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('adult'))
                    <span class="text-red-600">{{ $errors->first('adult') }}</span>
                @endif
            </div>
            <div class="w-full relative flex flex-col">
                <label for="children" class="text-ternary font-bold text-sm">Children (2 - 15)</label>
                <div class="w-full relative">
                 <select name="child" data-validation-key="child"
                         class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                     @for ($i = 0; $i <= 9; $i++)
                         <option value="{{ $i }}"
                             {{ $defaults['child'] == $i ? 'selected' : '' }}>{{ $i }}
                         </option>
                     @endfor
                 </select>
                    <i class="fa fa-child text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('child'))
                    <span class="text-red-600">{{ $errors->first('child') }}</span>
                @endif
            </div>
            <div class="w-full relative flex flex-col">
                <label for="infant" class="text-ternary font-bold text-sm">Infant (&lt;2)</label>
                <div class="w-full relative">
                  <select name="infant" data-validation-key="infant"
                          class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                      @for ($i = 0; $i <= 9; $i++)
                          <option value="{{ $i }}"
                              {{ $defaults['infant'] == $i ? 'selected' : '' }}>{{ $i }}
                          </option>
                      @endfor
                  </select>
                    <i class="fa fa-wheelchair text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('infant'))
                    <span class="text-red-600">{{ $errors->first('infant') }}</span>
                @endif
            </div>
            <div class="w-full relative flex flex-col">
                <label for="travelClass" class="text-ternary font-bold text-sm">Preferred Airline</label>
                <div class="w-full relative">
                  <select name="preferredAirline"
                          data-validation-key="preferredAirline"
                          class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                      <option value=""
                          {{ $defaults['preferredAirline'] == '' ? 'selected' : '' }}>
                          All Airlines
                      </option>
                      @foreach ($airlines as $code => $airline)
                          <option value="{{ $code }}"
                              {{ $defaults['preferredAirline'] == $code ? 'selected' : '' }}>
                              {{ $airline }}</option>
                      @endforeach
                  </select>
                    <i class="fa fa-plane-departure text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('infant'))
                    <span class="text-red-600">{{ $errors->first('infant') }}</span>
                @endif
            </div>
            <div class="w-full relative flex flex-col">
                <label for="travelClass" class="text-ternary font-bold text-sm">Travel Class</label>
                <div class="w-full relative">
                  <select name="cabinClass" data-validation-key="cabinClass"
                          class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                      @foreach ($cabinClasses as $cabinClass)
                          <option value="{{ $cabinClass }}"
                              {{ $defaults['cabinClass'] == $cabinClass ? 'selected' : '' }}>
                              {{ $cabinClass }}</option>
                      @endforeach
                  </select>
                    <i class="fa fa-plane text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
                @if ($errors->has('infant'))
                    <span class="text-red-600">{{ $errors->first('infant') }}</span>
                @endif
            </div>
            <div class="w-full relative flex flex-col">
                <label for="travelClass" class="text-ternary font-bold text-sm">Currency</label>
                <div class="w-full relative">
                   <select name="currency" data-validation-key="currency"
                           class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                       @foreach ($currencies as $currency)
                           <option value="{{ $currency }}"
                               {{ $defaults['currency'] == $currency ? 'selected' : '' }}>
                               {{ $currency }}</option>
                       @endforeach
                   </select>
                    <i class="fa fa-wallet text-secondary absolute left-3 text-xl top-[60%] translate-y-[-60%]"></i>
                    <i class="fa-solid fa-chevron-down text-black absolute right-3 text-xl top-[60%] translate-y-[-60%]"></i>
                </div>
            </div>
            <div class="w-full relative flex flex-col" style="display: none;">
                <label for="travelClass" class="text-ternary font-bold text-sm">Fare Type</label>
                   <select name="fareType" data-validation-key="fareType"
                           class="w-full mt-2 py-3 px-10 font-medium text-black/80 text-md rounded-[3px] border-[0px] bg-[#f3f4f6] focus:outline-none focus:ring-0 placeholder-black/60">
                       @foreach ($fareTypes as $key => $fareType)
                           <option value="{{ $key }}"
                               {{ $defaults['fareType'] == $fareType ? 'selected' : '' }}>
                               {{ $fareType }}</option>
                       @endforeach
                   </select>
            </div>
            <div class="w-full relative flex justify-end lg:col-span-6 md:col-span-4 col-span-2">
                <div class="">
                    <input type="submit" id="searchFlightButton" value="Search Flight"
                            class="showLoader font-bold text-lg bg-primary text-white px-6 py-2 rounded-[3px]  hover:bg-secondary hover:text-white transition ease-in duration-2000">
                            <!-- Search Flight <i class="fa fa-arrow-right ml-2"></i>
                    </button> -->
                </div>
            </div>
        </div>

    </form>
</div>






<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    var airports = @json($airports);

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('searchFlightButton').addEventListener('click', function (event) {
            // Get the values entered by the user
            var leavingFrom = document.getElementById('originInput').value;
            var arriveTo = document.getElementById('destinationInput').value;

            alert(leavingFrom);

            document.getElementById('loaderLeavingFrom').textContent = leavingFrom;
            document.getElementById('loaderArrivalTo').textContent = arriveTo;

            var departureDate = document.getElementById('departureDate').value;
            var returnDate = document.getElementById('returnDate').value;
            document.getElementById('loaderDepartureDate').textContent = departureDate;
            document.getElementById('loaderReturnDate').textContent = returnDate;

            // document.getElementById('loaderFlightPath').style.display = 'block';

            var type = document.querySelector('input[name="type"]:checked').value;
            document.getElementById('loaderFlightType').textContent = type + ' Flight';


            // Check if leavingFrom matches any airport
            var leavingFromMatch = checkAirportMatch(leavingFrom);

            // Check if arriveTo matches any airport
            var arriveToMatch = checkAirportMatch(arriveTo);

            // Log success or error
            if (leavingFromMatch) {
                console.log("Leaving From matched:", leavingFromMatch);
            } else {
                console.error("Invalid Leaving From value");
                showErrorMessage('leaveToErrorMessage', 'Invalid Leaving From value');
                event.preventDefault();
                return;

            }

            if (arriveToMatch) {
                console.log("Arrive To matched:", arriveToMatch);
            } else {
                console.error("Invalid Arrive To value");
                showErrorMessage('arriveToErrorMessage', 'Invalid Arrive To value');
                event.preventDefault();
                return;

            }
            if (leavingFromMatch && arriveToMatch && leavingFromMatch.id === arriveToMatch.id) {
                console.error("Leaving From and Arrive To are the same");
                showErrorMessage('sameAirportErrorMessage',
                    'Leaving From and Arrive To cannot be the same');
                event.preventDefault();
                return;
            }
        });


        document.getElementById('originInput').addEventListener('input', function () {
            hideErrorMessage(leaveToErrorMessage);
            hideErrorMessage(sameAirportErrorMessage);
        });

        document.getElementById('destinationInput').addEventListener('input', function () {
            hideErrorMessage(arriveToErrorMessage);
            hideErrorMessage(sameAirportErrorMessage);
        });
    });

    function checkAirportMatch(value) {
        var extractedValue = value.match(/([^,]+),\s*\[([^\]]+)\],\s*([^,]+)/);
        if (extractedValue) {
            var airportName = extractedValue[1].replace(/\s+/g, ' ').trim();
            var code = extractedValue[2].replace(/\s+/g, ' ').trim();
            var country = extractedValue[3].replace(/\s+/g, ' ').trim();
            for (var i = 0; i < airports.length; i++) {
                if (
                    airports[i].code === code &&
                    airports[i].country === country &&
                    airports[i].airport === airportName
                ) {
                    return airports[i];
                }
            }
        }

        // No match found
        return null;
    }


    // Function to show an error message
    function showErrorMessage(elementId, message) {
        var errorMessageElement = document.getElementById(elementId);
        if (errorMessageElement) {
            errorMessageElement.textContent = message;
            errorMessageElement.style.display = 'block';
        }
    }

    // Function to hide an error message
    function hideErrorMessage(errorMessageElement) {
        if (errorMessageElement) {
            errorMessageElement.style.display = 'none';
        }
    }


    function changeFlightType(input) {
        if (input.value === 'return') {
            document.getElementById('returnDateContainer').classList.remove('hidden');
            document.getElementById('departureDateContainer').classList.remove('col-span-2');
            document.getElementById('flexiCheckBoxDiv').classList.remove('hidden');
        } else {
            document.getElementById('returnDateContainer').classList.add('hidden');
            document.getElementById('departureDateContainer').classList.add('col-span-2');
            document.getElementById('flexiCheckBoxDiv').classList.add('hidden');
            document.getElementById('flexiCheckBox').checked = false;
        }
    }

    // onchange of departure date set min value for return date to the selected value to departure date
    function setMinReturnDate(input) {
        document.getElementById('returnDate').value = '';
        document.getElementById('returnDate').removeAttribute('disabled');
        var type = document.querySelector('input[name="type"]:checked').value;
        if (type === 'return') {
            document.getElementById('returnDate').setAttribute('min', input.value);
            document.getElementById('returnDate').showPicker();
        }
    }
</script>


<!-- <script>
    $(document).ready(function () {
        $('.showLoader').click(function () {
            $('#loading_overlay1').hide();
        });
    });
</script> -->
