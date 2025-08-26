<x-main.layout>

{{-- Banner and search section --}}
<div class="w-full relative bg-white">

    {{-- home slider section here--}}
    <div class="w-full">
        <div class="homeBanner">
            @php
                $sliderImages = [
                    'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg',
                    'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                    'https://cloud-travel.co.uk/live_flight/frontend/assets/images/book-holiday.jpg',
                    'https://cloud-travel.co.uk/live_flight/frontend/assets/images/flight-discount2.jpg',
                ];
            @endphp

            @foreach($sliderImages as $image)
                <div><img src="{{ $image }}"
                          class="w-full lg:h-[500px] md:h-[400px] sm:h-[400px] h-[350px] object-cover" alt="Image 1">
                </div>
            @endforeach
        </div>
    </div>
    {{-- home slider section ends here--}}

    {{-- Search Tabs --}}
    <div class="w-full absolute top-[60%]">
        <div class="lg:w-[80%] md:w-[90%] w-[95%] bg-white p-4 flex flex-col gap-2 rounded-t-md mx-auto">
            <span class="font-semibold lg:text-3xl md:text-2xl sm:text-xl text-lg">
                Discover, Explore the World with Ease
            </span>

            {{-- Tabs --}}
            <div class="flex gap-2 py-2 w-full border-b border-b-ternary/20">
                <button onclick="openTab(event, 'flights')"
                    class="tab-btn bg-black text-white hover:bg-black/80 hover:text-white py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-200 active" data-id="flights">
                    Flights
                </button>

                <button onclick="openTab(event, 'hotels')"
                    class="tab-btn text-ternary bg-transparent hover:bg-ternary/20 hover:text-black py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000" data-id="hotels">
                    Hotels
                </button>

                <button onclick="openTab(event, 'visa')"
                    class="tab-btn text-ternary bg-transparent hover:bg-ternary/20 hover:text-black py-1 px-4 font-medium text-sm rounded-md transition ease-in duration-2000" data-id="visa">
                    Visa
                </button>
            </div>
        </div>

        {{-- Tab Content --}}
        <div class="lg:w-[80%] md:w-[90%] w-full mx-auto bg-white rounded-b-md shadow-lg shadow-ternary/30">
            <div id="flights" class="tab-content p-4 block">
                 <x-flight-search></x-flight-search>     
            </div>

            <div id="hotels" class="tab-content p-4 hidden">
                 <x-hotel-search></x-hotel-search>     
            </div>

            <div id="visa" class="tab-content p-4 hidden">
       
                  <x-visa-search :countries="$countries" />

            </div>
        </div>
    </div>
</div>

{{-- Main Content Sections --}}
<div class="w-full lg:px-6 px-4 lg:mt-[100px] md:mt-[100px] sm:mt-[100px] mt-[100px] bg-white">

    {{-- ===== Destinations Section ===== --}}
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">Choose Your Destinations</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8" id="destinations"></div>

    {{-- ===== Offers Section ===== --}}
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">Special Flight Offers</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8" id="offers"></div>

    {{-- ===== Why Choose Us ===== --}}
    <section class="py-10 text-center">
        <h2 class="text-3xl font-semibold text-gray-800 mb-8">Why Choose Us</h2>
        <div class="flex flex-col md:flex-row gap-6 max-w-5xl mx-auto" id="features"></div>
    </section>

    {{-- ===== Trip Planners ===== --}}
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">Trip Planners</h2>
        <a href="#" class="text-primary font-bold text-sm">View All</a>
    </div>
    <p class="text-gray-600 mb-6">Choose your destination, discover activities, and build personalized itineraries with ease.</p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10" id="trip-planners"></div>

    {{-- ===== Traveler Experience ===== --}}
    <section class="bg-blue-50 py-12 px-4 text-center rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800">Traveler Experience</h2>
        <p class="text-primary mt-2 mb-8">Since 2014, trusted by travelers worldwide</p>
        <div class="flex flex-col md:flex-row justify-center gap-6 max-w-6xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-sm max-w-md text-left">
                <p class="italic text-gray-700 mb-4">"Super easy to plan and book everything in one place."</p>
                <p class="font-bold text-gray-800">Anjali S. - Delhi</p>
                <div class="text-star mt-2">★★★★</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm max-w-md text-left">
                <p class="italic text-gray-700 mb-4">"Amazing experience! Everything ran smoothly."</p>
                <p class="font-bold text-gray-800">Rahul K. - Mumbai</p>
                <div class="text-star mt-2">★★★★★</div>
            </div>
        </div>
    </section>

    {{-- ===== Subscribe ===== --}}
    <div class="bg-blue-100 flex flex-col md:flex-row justify-between items-center p-6 rounded-lg my-10 gap-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Subscribe To Our Mailing List</h2>
            <p class="text-gray-600 mt-2">Get exclusive deals straight to your inbox</p>
        </div>
        <form class="flex bg-white rounded overflow-hidden shadow-sm">
            <input type="email" placeholder="Enter your email" class="px-4 py-3 w-48 md:w-64 focus:outline-none">
            <button class="bg-accent text-white px-5 py-3 font-medium hover:bg-purple-800 transition">Subscribe</button>
        </form>
    </div>


</div>

{{-- Scripts --}}
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#2980b9',
                    dark: '#2c3e50',
                    light: '#f9f9f9',
                    accent: '#5c1cfc',
                    star: '#ffc107',
                }
            }
        }
    }
</script>

<script>
    // Tab functionality
    function openTab(evt, tabName) {
        // Hide all content
        document.querySelectorAll(".tab-content").forEach(el => {
            el.classList.add("hidden");
            el.classList.remove("block");
        });

        // Show the selected content
        document.getElementById(tabName).classList.remove("hidden");
        document.getElementById(tabName).classList.add("block");

        // Remove active styles from all buttons
        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.classList.remove("bg-black", "text-white");
            btn.classList.add("text-ternary", "bg-transparent");
        });

        // Add active styles to clicked button
        evt.currentTarget.classList.add("bg-black", "text-white");
        evt.currentTarget.classList.remove("text-ternary", "bg-transparent");
    }

    // ✅ Dynamic Data Loading
    const data = {
        destinations: [
            {name: "Taj Mahal", loc: "Agra, India", img: "https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&w=500&q=80"},
            {name: "Berlin Monument", loc: "Germany", img: "https://images.unsplash.com/photo-1587330979470-3595ac045ab0?auto=format&fit=crop&w=500&q=80"},
            {name: "Red Fort", loc: "Delhi, India", img: "https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=500&q=80"},
            {name: "Rialto Bridge", loc: "Venice, Italy", img: "https://images.unsplash.com/photo-1533856493584-0c6ca8ca9ce3?auto=format&fit=crop&w=500&q=80"},
            {name: "Eiffel Tower", loc: "Paris, France", img: "https://images.unsplash.com/photo-1431274172761-fca41d930114?auto=format&fit=crop&w=500&q=80"}
        ],
        offers: [
            {title: "Cuba", desc: "Drive the dream in Cuba.", price: "£499", rating: "★★★★", img: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80"},
            {title: "Bali", desc: "Escape to paradise in Bali.", price: "£699", rating: "★★★★", img: "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80"},
            {title: "Dubai", desc: "Discover the magic of Dubai.", price: "£599", rating: "★★★★", img: "https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1000&q=80"},
            {title: "Thailand", desc: "Adventure through Thailand.", price: "£549", rating: "★★★★", img: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80"},
            {title: "Maldives", desc: "Relax in the Maldives.", price: "£799", rating: "★★★★", img: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80"}
        ],
        features: [
            {icon: "💲", title: "Best Price", desc: "Low prices worldwide guaranteed"},
            {icon: "⚡", title: "Easy Booking", desc: "Search and book quickly"},
            {icon: "🏆", title: "Award Support", desc: "Reliable customer care"}
        ],
        planners: [
            {name: "Paris", img: "https://images.unsplash.com/photo-1431274172761-fca41d930114?auto=format&fit=crop&w=500&q=80"},
            {name: "Tokyo", img: "https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?auto=format&fit=crop&w=500&q=80"},
            {name: "Bali", img: "https://images.unsplash.com/photo-1539367628448-4bc5c9d171c8?auto=format&fit=crop&w=500&q=80"},
            {name: "New York", img: "https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&w=500&q=80"}
        ]
    };

    const load = (id, html) => document.getElementById(id).innerHTML = html;

    // Load content when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        load("destinations", data.destinations.map(d => 
          `<div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <img src="${d.img}" alt="${d.name}" class="w-full h-32 object-cover">
            <div class="p-3">
              <div class="font-bold text-gray-800">${d.name}</div>
              <div class="text-gray-600 text-sm">${d.loc}</div>
            </div>
          </div>`).join(""));

        load("offers", data.offers.map(o => 
          `<div class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
            <img src="${o.img}" alt="${o.title}" class="w-full h-28 object-cover">
            <div class="p-3">
              <div class="font-bold text-gray-800">${o.title}</div>
              <div class="text-gray-600 text-sm">${o.desc}</div>
              <div class="font-bold text-black mt-1">${o.price}</div>
              <div class="text-yellow-500 text-sm">${o.rating}</div>
            </div>
          </div>`).join(""));

        load("features", data.features.map(f => 
          `<div class="bg-white p-6 rounded-lg shadow-sm text-center">
            <div class="text-3xl mb-3">${f.icon}</div>
            <h3 class="font-semibold text-gray-800 mb-2">${f.title}</h3>
            <p class="text-gray-600">${f.desc}</p>
          </div>`).join(""));

        load("trip-planners", data.planners.map(p => 
          `<div class="relative rounded-lg overflow-hidden thumb-hover">
            <img src="${p.img}" alt="${p.name}" class="w-full h-32 object-cover">
            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white p-2 text-sm font-bold">${p.name}</div>
          </div>`).join(""));
    });
</script>

</x-main.layout>