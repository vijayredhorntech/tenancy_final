    <div class="lg:w-[70%] md:w-[90%] w-full px-2 mx-auto mt-5">
        <div class="w-full">
            <div class="w-full bg-primaryDarkColor p-2 flex gap-2 justify-center">
                <span class="text-white bg-transparent border-transparent px-12 py-2 font-semibold lg:text-lg md:text-lg sm:text-lg text-md rounded-full shadow-lg shadow-primaryColor/10">
                    Accommodation Search
                </span>
            </div>
            <div class="w-full">
                <div class="w-full m-auto h-auto flex flex-col justify-center border-2 border-primaryDarkColor p-2 border-t-[0px] rounded-b-md bg-primaryColor/10">
                    <div class="w-full py-2">
                        <form action="{{ route('hotel.search') }}" method="GET" id="hotelSearchForm">
                            <div class="grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-x-2 gap-y-4">
                                <!-- Country Field -->
                                <div class="w-full relative">
                                    <label for="country" class="text-black/80 font-medium text-sm">Country</label>
                                    <input type="text" id="country" required autocomplete="off" 
                                           placeholder="Search Country" value="{{ old('country') }}"
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                   <input type="hidden" id="coutnrycode" name="country"> 
                                           <div id="countrySuggestions" class="absolute hidden top-full left-0 z-30 max-h-72 overflow-y-auto w-full bg-white border-[1px] border-primaryColor/50 shadow-lg shadow-primaryColor/20 rounded-[3px]"></div>
                                </div>
                                
                                <!-- Location Field -->
                                <div class="w-full relative">
                                    <label for="location" class="text-black/80 font-medium text-sm">Location</label>
                                    <input type="text" id="location"  autocomplete="off" 
                                           placeholder="Search Location" value="{{ old('location') }}"
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/>
                                    <input type="hidden" id="locationcode" name="city">
                                           <div id="locationSuggestions" class="absolute hidden top-full left-0 z-30 max-h-72 overflow-y-auto w-full bg-white border-[1px] border-primaryColor/50 shadow-lg shadow-primaryColor/20 rounded-[3px]"></div>
                                </div>
                                
                                <!-- Date Range Field -->
                                <div class="w-full">
                                    <label for="checkInDate" class="text-black/80 font-medium text-sm">Check-in & Check-out Date</label>
                                    <!-- <input type="text" id="checkInDate" name="checkInDate" 
                                           placeholder="YYYY-MM-DD - YYYY-MM-DD" 
                                           class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80"/> -->
                                           <input type="text" id="dateRangePicker" placeholder="Select date range" class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
            
                                                <input type="hidden" name="checkInDate" id="checkInDate">
                                                <input type="hidden" name="checkOutDate" id="checkOutDate">
                                        </div>
                                
                                <!-- Guest Selection -->
                                <div class="w-full relative">
                                    <label for="guests" class="text-black/80 font-medium text-sm">Guest</label>
                                    <button type="button" id="guestSelector"
                                            class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                        {{ old('rooms', '1') }} Room(s), {{ old('adults', '1') }} Adult(s)
                                    </button>
                                    <div id="guestModal" class="hidden max-h-[500px] overflow-y-auto h-max bg-gray-100 rounded-md absolute left-[50%] translate-x-[-50%] z-50 shadow-md shadow-primaryColor/20 border-[1px] border-primaryColor/30 p-2">
                                        <div class="w-full">
                                            <label for="rooms" class="text-black/80 font-medium text-sm">Rooms</label>
                                            <select id="rooms" name="rooms" class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}" {{ old('rooms', '1') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                        <div id="roomContainer">
                                            <!-- Room fields will be added here dynamically -->
                                        </div>
                                        
                                        <div class="w-full pt-4">
                                            <button type="button" id="closeGuestModal"
                                                    class="w-full text-center font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">
                                                Done
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Search Button -->
                                <div class="w-full">
                                    <label for="rooms" class="text-black/80 font-medium text-sm">&nbsp;</label>
                                    <button type="submit" class="w-full mt-2 h-max text-center font-semibold text-md bg-primaryDarkColor/80 text-white/90 px-6 py-2 rounded-[3px] border-[1px] border-primaryDarkColor hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




    <script>
      
    document.getElementById('hotelSearchForm').addEventListener('submit', function (e) {
        // Get values from the fields
        const country = document.getElementById('country').value.trim();
        const location = document.getElementById('location').value.trim();
        const checkIn = document.getElementById('checkInDate').value.trim();
        const checkOut = document.getElementById('checkOutDate').value.trim();

        // Check if all fields are filled
        if (country && location && checkIn && checkOut) {
            // Show the loader
            document.getElementById('loading_overlay1').classList.remove('hidden');
             // Set values to display in loader
            document.getElementById('coutnry-name').textContent = country;
            document.getElementById('city-name').textContent = location;
            document.getElementById('checkin').textContent = checkIn;
            document.getElementById('checkout').textContent = checkOut;
        } else{
            e.preventDefault();
        }
    });


        document.addEventListener('DOMContentLoaded', function() {
         
   
        
            // Initialize date picker
     

            flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                minDate: "today",
                showMonths: 2,
       
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {
                        const [start, end] = selectedDates;
                        $('#checkInDate').val(flatpickr.formatDate(start, "Y-m-d"));
                        $('#checkOutDate').val(flatpickr.formatDate(end, "Y-m-d"));
                    }
                }
            });


            // Guest modal functionality
            const guestSelector = document.getElementById('guestSelector');
            const guestModal = document.getElementById('guestModal');
            const closeGuestModal = document.getElementById('closeGuestModal');
            const roomsSelect = document.getElementById('rooms');
            const roomContainer = document.getElementById('roomContainer');
            
            // Toggle guest modal
            guestSelector.addEventListener('click', function() {
                guestModal.classList.toggle('hidden');
                updateRoomsContent();
            });
            
            closeGuestModal.addEventListener('click', function() {
                guestModal.classList.add('hidden');
                updateGuestSelectorText();
            });
            
            // Update rooms when selection changes
            roomsSelect.addEventListener('change', updateRoomsContent);
            
            function updateRoomsContent() {
                const roomCount = parseInt(roomsSelect.value);
                roomContainer.innerHTML = '';
                
                // Determine grid classes based on room count
                let gridClasses = 'grid grid-cols-1';
                if (roomCount === 2) {
                    gridClasses = 'grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-2';
                } else if (roomCount > 2) {
                    gridClasses = 'grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-2';
                }
                
                roomContainer.className = gridClasses;
                
                // Add room fields
                for (let i = 0; i < roomCount; i++) {
                    const roomDiv = document.createElement('div');
                    roomDiv.innerHTML = `
                        <div class="w-full mt-4">
                            <div class="px-2 rounded-[2px] w-full font-semibold text-md bg-primaryDarkColor text-white">Room ${i+1}</div>
                            <div class="w-full mt-2">
                                <label for="adults_${i}" class="text-black/80 font-medium text-sm">Adults</label>
                                <select id="adults_${i}" name="numberofAdults[]" class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="children_${i}" class="text-black/80 font-medium text-sm">Children</label>
                                <select id="children_${i}" name="numberOfChildren[]" class="w-full mt-2 p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div id="childAges_${i}" class="child-age-container"></div>
                        </div>
                    `;
                    roomContainer.appendChild(roomDiv);
                    
                    // Add event listener for children select
                    document.getElementById(`children_${i}`).addEventListener('change', function() {
                        updateChildAges(i);
                    });
                }
            }
            
            function updateChildAges(roomIndex) {
                const childrenSelect = document.getElementById(`children_${roomIndex}`);
                const childAgesContainer = document.getElementById(`childAges_${roomIndex}`);
                const childCount = parseInt(childrenSelect.value);
                
                childAgesContainer.innerHTML = '';
                
                for (let i = 0; i < childCount; i++) {
                    const ageDiv = document.createElement('div');
                    ageDiv.className = 'w-full mt-2';
                    ageDiv.innerHTML = `
                        <label for="child_age_${roomIndex}_${i}" class="text-black/80 font-medium text-sm">Child ${i+1} Age</label>
                        <select id="child_age_${roomIndex}_${i}" name="child_ages[${roomIndex}][]" class="w-full p-2.5 font-medium text-primaryDarkColor text-sm rounded-[3px] border-[1px] border-primaryDarkColor/80 focus:border-primaryDarkColor bg-transparent focus:outline-none focus:ring-0 placeholder-primaryDarkColor/80">
                            ${Array.from({length: 12}, (_, j) => `<option value="${j+1}">${j+1}</option>`).join('')}
                        </select>
                    `;
                    childAgesContainer.appendChild(ageDiv);
                }
            }
            
            function updateGuestSelectorText() {
                const roomCount = parseInt(roomsSelect.value);
                let totalAdults = 0;
                
                for (let i = 0; i < roomCount; i++) {
                    const adultsSelect = document.getElementById(`adults_${i}`);
                    if (adultsSelect) {
                        totalAdults += parseInt(adultsSelect.value);
                    }
                }
                
                guestSelector.textContent = `${roomCount} Room(s), ${totalAdults} Adult(s)`;
            }
            
            // Country and location autocomplete
            const countryInput = document.getElementById('country');
            const countrySuggestions = document.getElementById('countrySuggestions');
            const locationInput = document.getElementById('location');
            const locationSuggestions = document.getElementById('locationSuggestions');
            
            countryInput.addEventListener('input', function() {        
                    fetchCountries(this.value);
            });
            
            locationInput.addEventListener('input', function() {  
                    fetchLocations(this.value, $("#coutnrycode").val());
            });


    

    function fetchCountries(query) {
    $.ajax({
        url: `/api/countriesByName/${query}`,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.length > 0) {
                $('#countrySuggestions').html(
                    data.map(country => `
                        <div class="text-primaryDarkColor px-2 py-1 w-full border-b-[1px] border-primaryColor/20 hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000 cursor-pointer"
                             data-code="${country.code}">
                            ${country.name}
                        </div>
                    `).join('')
                ).removeClass('hidden');

                $('#countrySuggestions div').on('click', function() {
                    const selectedCountry = $(this).text().trim();
                    const countryCode = $(this).data('code');

                    $('#countryInput').val(selectedCountry);
                    $('#coutnrycode').val(countryCode); // Make sure this ID is correct in your HTML
                    $('#countrySuggestions').addClass('hidden');
                });
            } else {
                $('#countrySuggestions').addClass('hidden');
            }
        }
    });
}
     function fetchLocations(query, country) {
                $.ajax({
                    url: `/api/locations`, // Ensure this route matches the one in your Laravel backend
                    method: 'GET',
                    data: { query: query, country: country },
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            $('#locationSuggestions').html(
                                data.map(location => `
                                    <div class="text-primaryDarkColor px-2 py-1 w-full border-b-[1px] border-primaryColor/20 hover:bg-primaryDarkColor hover:text-white transition ease-in duration-2000 cursor-pointer"
                                        data-id="${location.id}"> <!-- Added data-id here -->
                                        ${location.name}
                                    </div>
                                `).join('')
                            ).removeClass('hidden');

                            $('#locationSuggestions div').on('click', function() {
                                var locationName = $(this).text().trim();  // Get the location name
                                var locationId = $(this).data('id');  // Now we can get the location ID

                                $('#location').val(locationName);
                                $('#locationcode').val(locationId);
                                $('#locationSuggestions').addClass('hidden');
                            });
                        } else {
                            $('#locationSuggestions').addClass('hidden');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching locations:", error);
                        $('#locationSuggestions').addClass('hidden');
                    }
                });
    }


            
            // Close suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!countryInput.contains(e.target) && !countrySuggestions.contains(e.target)) {
                    countrySuggestions.classList.add('hidden');
                }
                
                if (!locationInput.contains(e.target) && !locationSuggestions.contains(e.target)) {
                    locationSuggestions.classList.add('hidden');
                }
                
                if (!guestSelector.contains(e.target) && !guestModal.contains(e.target)) {
                    guestModal.classList.add('hidden');
                }
            });
            
            // Initialize with one room
            updateRoomsContent();
        });
    </script>