<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    @vite('resources/js/app.js')
{{--    <script src="https://kit.fontawesome.com/4e2c7ef5ef.js" crossorigin="anonymous"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">


{{--    google font link--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    {{--    slider css here--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>


    <style>

        * {
            margin: 0px;
            padding: 0px;
        }


        .dropdown-option {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 2.5rem;
            padding-right: 2.5rem;
            border-top: 1px solid #f3f4f6;
            border-bottom: 1px solid #f3f4f6;
        }

        .dropdown-option:hover {
            background-color: rgba(255, 66, 22, 0.13);
            border-bottom:1px solid #ff4216;
            border-top:1px solid #ff4216;
            cursor: pointer;
            transition: all 0.6s;
        }

         input[type="date"]::-webkit-inner-spin-button,
         input[type="date"]::-webkit-calendar-picker-indicator {
             display: none !important;
             -webkit-appearance: none !important;
         }
        select {
            -webkit-appearance: none !important; /* Hides the arrow in WebKit-based browsers (Chrome, Safari, Edge) */
            -moz-appearance: none !important;    /* Hides the arrow in Firefox */
            appearance: none !important;         /* Standard property */
            background: #f3f4f6 !important ;         /* Removes background if needed */
        }
    </style>
    @livewireStyles
    @livewireScripts

</head>

<body style="font-family: 'Public Sans', serif; background-color: white">
<div class="min-h-screen bg-white">
    <x-navigation />
    <main style="position: relative">
        {{ $slot }}
    </main>
    <x-footer/>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script>
        function openFilterModal() {
            document.getElementById("filterModal").classList.remove("hidden");

        }

        function closeFilterModal() {
            document.getElementById("filterModal").classList.add("hidden");
        }

        function openRecomendModal() {
            document.getElementById("refundFilterModal").classList.remove("hidden");

        }

        function closeRecomendModal() {
            document.getElementById("refundFilterModal").classList.add("hidden");
        }


        function openMapModal() {
            document.getElementById("mapModal").classList.remove("hidden");

        }

        function closeMapModal() {
            document.getElementById("mapModal").classList.add("hidden");
        }


        function openGuestModal() {
            document.getElementById("guestModal").classList.remove("hidden");

        }

        function closeGuestModal() {
            document.getElementById("guestModal").classList.add("hidden");
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var originInput = document.getElementById('originInput');
            var destinationInput = document.getElementById('destinationInput');
            var originDropdownContainer = document.getElementById('originOptions');
            var destinationDropdownContainer = document.getElementById('destinationOptions');


            destinationInput.addEventListener('input', function() {
                var inputText = destinationInput.value;
                if (inputText.length >= 3) {
                    fetchAutocompleteResults(inputText, destinationInput, destinationDropdownContainer);
                } else {
                    destinationDropdownContainer.innerHTML = '';
                }
            });

            originInput.addEventListener('input', function() {
                var inputText = originInput.value;
                if (inputText.length >= 3) {
                    fetchAutocompleteResults(inputText, originInput, originDropdownContainer);
                } else {
                    originDropdownContainer.innerHTML = '';
                }
            });

            function fetchAutocompleteResults(inputText, input, dropdownContainer) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        displayAutocompleteResults(data, input, dropdownContainer);
                    }
                };
                xhr.open('GET', '/search/airport/' + encodeURIComponent(inputText), true);
                xhr.send();
            }

            function displayAutocompleteResults(results, input, dropdownContainer) {
                dropdownContainer.innerHTML = '';

                for (var i = 0; i < results.length; i++) {
                    var option = document.createElement('div');
                    option.className = 'dropdown-option';
                    option.textContent = results[i];
                    dropdownContainer.appendChild(option);
                }

                var dropdownOptions = document.getElementsByClassName('dropdown-option');
                for (var j = 0; j < dropdownOptions.length; j++) {
                    dropdownOptions[j].addEventListener('click', function() {
                        input.value = this.textContent;
                        dropdownContainer.innerHTML = '';
                    });
                }
            }
        });

    </script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Function to create a room section
            function createRoomSection(roomNumber) {
                return `
          <div class="w-full roomSection" data-room-number="${roomNumber}">
            <div class="w-full py-2 px-6">
              <span class="text-black font-semibold text-md">Room ${roomNumber}</span>
            </div>
            <div class="w-full flex justify-between py-2 px-6 border-b-2 border-b-gray-300">
              <span class="text-gray-600 font-semibold text-md">Adults</span>
              <select name="room[${roomNumber}]['adult']" class="adultsCount bg-white border border-gray-200 text-black text-sm rounded-md focus:ring-0 focus:border-none block w-32 py-1.5 px-3">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div class="w-full flex justify-between py-2 px-6 border-b-2 border-b-gray-300">
              <span class="text-gray-600 font-semibold text-md">Children</span>
              <select name="room[${roomNumber}]['children']" class="childrenCount bg-white border border-gray-200 text-black text-sm rounded-md focus:ring-0 focus:border-none block w-32 py-1.5 px-3">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div class="w-full children-ages py-2 px-6 border-b-2 border-b-gray-300">
              <!-- Children ages go here -->
              ${createChildrenAgeFields(0)} <!-- Initial state with 0 children -->
            </div>
          </div>`;
            }

            // Function to create child age fields based on the selected children count
            function createChildrenAgeFields(roomNumber, childrenCount) {
                let childrenAgesHtml = '';

                for (let i = 1; i <= childrenCount; i++) {
                    childrenAgesHtml += `
          <div class="w-full py-2 px-6 border-b-2 border-b-gray-300">
            <label class="text-gray-600 font-semibold text-md" for="room${roomNumber}-childAge${i}">Child Age - ${i}</label>
            <input type="number" name="room[${roomNumber}][children][childAge][]" id="room${roomNumber}-childAge${i}" class="bg-white border border-gray-200 text-black text-sm rounded-md focus:ring-0 focus:border-none block w-full py-1.5 px-2" placeholder="Child ${i} Age">
          </div>`;
                }

                return childrenAgesHtml;
            }

            // Function to update room sections based on the selected room count
            function updateRoomSections() {
                const roomCount = parseInt($('#roomCount').val());
                let roomSectionsHtml = '';

                for (let i = 1; i <= roomCount; i++) {
                    roomSectionsHtml += createRoomSection(i);
                }

                $('#roomSections').html(roomSectionsHtml);
            }

            // Event listener for room count select
            $('#roomCount').change(function() {
                updateRoomSections();
            });

            // Event listener for children count select
            $(document).on('change', '.childrenCount', function() {
                const childrenCount = parseInt($(this).val());
                const section = $(this).closest('.roomSection');
                const roomNumber = section.data('room-number');

                if (section.find('.adultsCount').val() === '4') {
                    $(this).val('0');
                    updateChildrenAges(roomNumber, 0, section);
                } else {
                    updateChildrenAges(roomNumber, childrenCount, section);
                }
            });

            function updateChildrenAges(roomNumber, childrenCount, section) {
                if (childrenCount === 0) {
                    section.find('.children-ages').html('');
                } else {
                    const childrenAgesHtml = createChildrenAgeFields(roomNumber, childrenCount);
                    section.find('.children-ages').html(childrenAgesHtml);
                }
            }

            // Event listener for adults count select
            $(document).on('change', '.adultsCount', function() {
                const adultsCount = parseInt($(this).val());
                const $childrenCountSelect = $(this).closest('.roomSection').find('.childrenCount');

                // Disable children selection if adults count is 4
                $childrenCountSelect.prop('disabled', adultsCount === 4);
                // Set children count to 0 if adults count is 4
                $childrenCountSelect.val(adultsCount === 4 ? 0 : $childrenCountSelect.val());
                // Trigger change event to update children section
                $childrenCountSelect.change();
            });

            // Initialize room sections
            updateRoomSections();
        });
    </script>
    <script>
        $(document).ready(function() {
            function filterFlights() {
                const sliderValue = parseInt($('#priceSlider').val());
                const stopsCheckboxes = $('.stopsCheckbox:checked');
                const airlinesCheckboxes = $('.airlinesCheckbox:checked');

                let visibleFlights = $('.flight-card').filter(function() {
                    const flightAirline = $(this).attr('data-airline');
                    const flightPrice = parseInt($(this).attr('data-price'));
                    const flightStops = parseInt($(this).attr('data-stops'));

                    const airlineFilterPass = airlinesCheckboxes.length === 0 || airlinesCheckboxes.map(
                        function() {
                            return $(this).val();
                        }).get().includes(flightAirline);

                    const stopsFilterPass = stopsCheckboxes.length === 0 || stopsCheckboxes.map(function() {
                        return parseInt($(this).val());
                    }).get().includes(flightStops);

                    const priceFilterPass = flightPrice <= sliderValue;

                    return airlineFilterPass && stopsFilterPass && priceFilterPass;
                });

                // Calculate the number of flights
                const numOfFlights = visibleFlights.length;
                // get the lowest and highest attr('data-price') values
                const lowestPrice = visibleFlights.sort(function(a, b) {
                    return $(a).attr('data-price') - $(b).attr('data-price');
                }).first().attr('data-price');
                const highestPrice = visibleFlights.sort(function(a, b) {
                    return $(b).attr('data-price') - $(a).attr('data-price');
                }).first().attr('data-price');

                $('#cheapestFlightPrice').html(lowestPrice ?? 0);


                // Display the number of flights, lowest price, and highest price
                $('#flightsFound').html(numOfFlights);
                // console.log('Lowest Price:', lowestPrice);
                // console.log('Highest Price:', highestPrice);

                // Hide all flights first
                $('.flight-card').hide();

                // Show the visible flights
                visibleFlights.show();
            }

            // Add event listener to the checkboxes
            $('.airlinesCheckbox').change(function() {
                filterFlights();
            });

            $('.stopsCheckbox').change(function() {
                filterFlights();
            });

            // Add event listener to the price slider
            $('#priceSlider').on('input', function() {
                filterFlights();
            });


            function sortByPriceAscending() {
                const sortedFlights = $('.flight-card').sort(function(a, b) {
                    const priceA = parseInt($(a).attr('data-price'));
                    const priceB = parseInt($(b).attr('data-price'));
                    return priceA - priceB;
                });
                $('.flights-container').html(sortedFlights);
                // Show the low-to-high icon and hide the high-to-low icon
                $('.lowToHighPrice').show();
                $('.highToLowPrice').hide();
            }

            // Function to sort flight cards by price in descending order
            $('.highToLowPrice').hide();

            function sortByPriceDescending() {
                const sortedFlights = $('.flight-card').sort(function(a, b) {
                    const priceA = parseInt($(a).attr('data-price'));
                    const priceB = parseInt($(b).attr('data-price'));
                    return priceB - priceA;
                });
                $('.flights-container').html(sortedFlights);

                // Show the high-to-low icon and hide the low-to-high icon
                $('.highToLowPrice').show();
                $('.lowToHighPrice').hide();
            }

            // Initial sort order is ascending
            let sortAscending = true;

            // Add event listener to the sorting button
            $('.sortByPrice').click(function() {
                if (sortAscending) {
                    sortByPriceDescending();
                    sortAscending = false;
                } else {
                    sortByPriceAscending();
                    sortAscending = true;
                }
            });

            let sortAscendingTime = true;

            // Function to sort flight cards by flight time in ascending order
            function sortByFlightTimeAscending() {
                const sortedFlights = $('.flight-card').sort(function(a, b) {
                    const timeA = parseInt($(a).attr('data-flight-time'));
                    const timeB = parseInt($(b).attr('data-flight-time'));
                    return timeA - timeB;
                });
                $('.flights-container').html(sortedFlights);

                // Show the low-to-high icon and hide the high-to-low icon
                $('.lowToHighDestination').show();
                $('.highToLowDestination').hide();
            }

            $('.highToLowDestination').hide();


            // Function to sort flight cards by flight time in descending order
            function sortByFlightTimeDescending() {
                const sortedFlights = $('.flight-card').sort(function(a, b) {
                    const timeA = parseInt($(a).attr('data-flight-time'));
                    const timeB = parseInt($(b).attr('data-flight-time'));
                    return timeB - timeA;
                });
                $('.flights-container').html(sortedFlights);

                // Show the high-to-low icon and hide the low-to-high icon
                $('.lowToHighDestination').hide();
                $('.highToLowDestination').show();
            }

            // Add event listener to the flight time sorting button
            $('.flightTimeSortButton').click(function() {
                if (sortAscendingTime) {
                    sortByFlightTimeDescending();
                    sortAscendingTime = false;
                } else {
                    sortByFlightTimeAscending();
                    sortAscendingTime = true;
                }
            });

        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.homeBanner').slick({
                slidesToShow: 1, // Number of visible slides at a time
                slidesToScroll: 1,
                prevArrow: '<button class="slick-prev absolute top-[50%] left-4 translate-y-[-50%] z-40">Previous</button>',
                nextArrow: '<button class="slick-next absolute top-[50%] right-4 translate-y-[-50%] z-40">Next</button>',
                responsive: [
                    // {
                    //     breakpoint: 768,
                    //     settings: {
                    //         slidesToShow: 1, // Adjust for smaller screens
                    //         slidesToScroll: 1
                    //     }
                    // }
                ]
            });
        });
        $(document).ready(function(){
            $('.flightOfferSlider').slick({
                slidesToShow: 5, // Number of visible slides at a time
                slidesToScroll: 1,
                prevArrow: '<button class="slick-prev absolute top-[50%] left-4 translate-y-[-50%] z-40">Previous</button>',
                nextArrow: '<button class="slick-next absolute top-[50%] right-4 translate-y-[-50%] z-40">Next</button>',
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 4 , // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3 , // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2 , // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1, // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
        $(document).ready(function(){
            $('.TravelersExperience').slick({
                slidesToShow: 3, // Number of visible slides at a time
                slidesToScroll: 1,
                prevArrow: '<button class="slick-prev absolute top-[50%] left-4 translate-y-[-50%] z-40">Previous</button>',
                nextArrow: '<button class="slick-next absolute top-[50%] right-4 translate-y-[-50%] z-40">Next</button>',
                responsive: [

                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2 , // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1, // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
        $(document).ready(function(){
            $('.holidaySlider').slick({
                slidesToShow: 4, // Number of visible slides at a time
                slidesToScroll: 1,
                prevArrow: '<button class="slick-prev absolute top-[50%] left-4 translate-y-[-50%] z-40">Previous</button>',
                nextArrow: '<button class="slick-next absolute top-[50%] right-4 translate-y-[-50%] z-40">Next</button>',
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2, // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 500,
                        settings: {
                            slidesToShow: 1, // Adjust for smaller screens
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>
