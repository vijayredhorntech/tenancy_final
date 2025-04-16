@stack('customStyle')
<Style>

</Style>
{{-- @dd($searchParams) --}}
{{-- @dd($hotels) --}}
 {{-- @dd($filteredHotels) --}}

<x-layout>
    @php
    $cityName = App\Models\City::where('cityID', '=', $searchParams['city'])->first();
    @endphp
   
    {{-- @dd($cityName) --}}
    <div class="w-full h-max ">
        <div class="w-full h-96 bg-no-repeat bg-center bg-cover bg-[url('https://plus.unsplash.com/premium_photo-1682145930966-712ce7177919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')]">

        </div>
    </div>

    <x-common.search-bar></x-common.search-bar>
    <x-common.filter-bar></x-common.filter-bar>
    


    <div class="lg:w-3/4 md:w-3/4 sm:w-full w-full h-max m-auto  py-4 bg-sky-200 ">

        <div class="w-full h-max flex justify-between lg:flex-row md:flex-row sm:flex-col flex-col relative ">

             <x-common.hotel-types></x-common.hotel-types>
            <div class=" h-max lg:w-1/4 md:w-1/4 sm:w-full w-full flex justify-end px-12">
                <div class="m-auto">
                    <span class="text-sky-900 text-lg font-semibold mr-2 m-auto "><i class="fa-solid fa-map" style="color: deepskyblue"></i></span>
                    <button class="text-gray-600 text-lg font-semibold m-auto" id="toggleMap" >Show Maps</button>
                </div>
            </div>
            

            <x-models.filter-modal></x-models.filter-modal>
            <x-models.refund-modal></x-models.refund-modal>
            <x-models.search-modal></x-models.search-modal>
            <x-models.rating-modal></x-models.rating-modal>
            <x-models.location-modal></x-models.location-modal>
            <x-models.budget-modal></x-models.budget-modal>
            <x-models.sort-modal></x-models.sort-modal>




        </div>
          {{-- @if(isset($HotelsFound) && $HotelsFound) --}}
        <div class="w-full mt-10 relative ">

            
            {{-- <x-models.map-modal></x-models.map-modal> --}}
            <div class='map z-10 absolute right-0 lg:w-1/2 md:w-1/2 sm:w-full w-full p-2 h-max bg-white border-4 border-sky-400 rounded-lg hidden'>
                <div class="flex brder-2 border-black" id="map-container">
                    <div class="bg-sky-500 h-max p-1 rounded-md text-white flex" id='closeMap'>
                        <i class="fa-solid fa-xmark" ></i>
                    </div>
                  <div id='map' class='w-full h-full border-2 border-red-600' style='width: 900px; height: 600px;'>
                  {{-- <div class="mx-8 w-full h-max my-8 text-lg " id='infoElement'></div> --}}
                </div>
                </div>
              </div>
              
            <x-common.hotel-card-heading title="Trending with other Agents" address="https://www.google.com"></x-common.hotel-card-heading>
            <div class="px-6 w-full mt-2 grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6">
                @php
                $arrayRoomPrice = [];
               @endphp
  
               @if (isset($filteredHotels) && is_array($filteredHotels))            
                 {{-- @if (isset($filteredHotels) && (int) $hotels['Response']['Body']['HotelsReturned'] > 0) --}}
                 {{-- <span class="font-normal italic text-md ml-2"><span class="font-bold text-lg mr-2">{{ $hotels['Response']['Body']['HotelsReturned'] }} </span> Hotels Found</span> --}}
                 @foreach ($filteredHotels as $hotel)
                       
                   @foreach ($hotel['Options']['Option'] as $record)
                         @if (is_array($record) && isset($record['TotalPrice']))
                         @php
                             $arrayRoomPrice[] = $record['TotalPrice'];
                         @endphp
                         @endif
                   @endforeach
                   {{-- @dd($arrayRoomPrice) --}}
                   
                 <x-common.hotel-card hotel-url="{{route('hotel.details',['hotelDetails' =>$hotel])}}" hotel-name="{{ $hotel['HotelName'] }}" hotel-desc="" city-name="{{ $cityName['CityName'] }}" rating-count="{{ $hotel['StarRating'] }}" rating-status="Excellent" price="£ {{ min($arrayRoomPrice) }} to  £ {{ max($arrayRoomPrice) }}" hotel-image="{{ $hotel['MoreDetails']['Images']['Image'][0] }}"></x-common.hotel-card>
                 
                @endforeach
                {{-- <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596386461350-326ccb383e9f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1113&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Aska Lara Resort & Spa" hotel-desc="Antalya-Lara" rating-count="4.4" rating-status="Excellent" price="841" hotel-image="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596436889106-be35e843f974?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card> --}}
                {{-- @else
                <p class="text-3xl ml-12 font-semibold">No Hotels Found</p>
                @endif --}}
              @else          
                  <div class="mt-[-83vh] md:mt-12  items-center justify-center"> 
                    {{-- <h1 class="ml-12 md:ml-8 text-red-800 text-lg ">{{ $filteredHotels['Response']['Body']['Error']['ErrorText'] }}</h1> --}}
                    <p class="text-3xl ml-12 font-semibold">No Hotels Found</p>
                  </div>          
            @endif
            </div>

        </div>
        {{-- @else
        <p  class="text-3xl ml-12 mt-4 mx-auto  font-semibold">No hotels found</p>
        @endif --}}
        {{-- <div class="w-full mt-10 ">
            <x-common.hotel-card-heading title="Luxe Collection" address="https://www.google.com"></x-common.hotel-card-heading>
            <div class="px-6 w-full mt-6 grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-4">
                <x-common.hotel-card hotel-name="Aska Lara Resort & Spa" hotel-desc="Antalya-Lara" rating-count="4.4" rating-status="Excellent" price="841" hotel-image="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596386461350-326ccb383e9f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1113&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Aska Lara Resort & Spa" hotel-desc="Antalya-Lara" rating-count="4.4" rating-status="Excellent" price="841" hotel-image="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596436889106-be35e843f974?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>

            </div>

        </div> --}}

        {{-- <div class="w-full mt-10 ">
            <x-common.hotel-card-heading title="Recommended for beach lovers" address="https://www.google.com"></x-common.hotel-card-heading>
            <div class="px-6 w-full mt-6 grid lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-4">
                <x-common.hotel-card hotel-name="Aska Lara Resort & Spa" hotel-desc="Antalya-Lara" rating-count="4.4" rating-status="Excellent" price="841" hotel-image="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596386461350-326ccb383e9f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1113&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Aska Lara Resort & Spa" hotel-desc="Antalya-Lara" rating-count="4.4" rating-status="Excellent" price="841" hotel-image="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>
                <x-common.hotel-card hotel-name="Hotel Mumbai" hotel-desc="Antalya-Lara" rating-count="4.0" rating-status="Average" price="500" hotel-image="https://images.unsplash.com/photo-1596436889106-be35e843f974?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"></x-common.hotel-card>

            </div>

        </div> --}}
    </div>
    <!-- Button to open the modal -->






     {{--newslatter--}}
  <x-common.news-letter></x-common.news-letter>
 

  <x-splade-script>
 console.log('hello')
 document.getElementById('toggleMap').addEventListener('click', function () {
    var mapContainer = document.querySelector('.map');
    mapContainer.classList.toggle('hidden');
});

document.getElementById('closeMap').addEventListener('click', function () {
    var mapContainer = document.querySelector('.map');
    mapContainer.classList.add('hidden');
});
    console.log("thissdddd v");
    var yourVariable = @json($filteredHotels);
    var city = @json($searchParams);
     
    var cityDetails = @json($cityName);
    var cityName = cityDetails.CityName;
    console.log('City', cityName);
     console.log('fetched hotelssss',yourVariable);
    
     
    var hotelNames= yourVariable;
    console.log('Hotel Name:', hotelNames[0]['HotelName']);
   
    
     
    mapboxgl.accessToken = 'pk.eyJ1Ijoicm56YWo2MCIsImEiOiJjbHB6M3U4NTYxM3owMmlwZmcxbnFyZ3Z1In0.dOAVa2Dq7btKxFdPlihPnA';
    const accessToken = 'pk.eyJ1Ijoicm56YWo2MCIsImEiOiJjbHB6M3U4NTYxM3owMmlwZmcxbnFyZ3Z1In0.dOAVa2Dq7btKxFdPlihPnA';
     
     
     const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [76.7794, 30.7333], // Chandigarh coordinates
                zoom: 10,
            });
     
     console.log('mmmmm',map)
     
    <!-- // using location  -->
     
     
     hotelNames.forEach(async hotelName => {
          console.log('hotelNameee',hotelName);
       const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${hotelName.HotelName}, ${cityName}.json?access_token=${accessToken}`);
      <!-- const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${hotelName.HotelName},Anshun.json?access_token=${accessToken}`); -->
     
      const data = await response.json();
      const coordinates = data.features[0].center;
      const placeName = data.features[0].place_name;
      map.setCenter(coordinates);
       console.log('map is',map)
      const marker = new mapboxgl.Marker()
        .setLngLat(coordinates)
        .addTo(map);
     
        const popup = new mapboxgl.Popup({ offset: 25 })
        .setHTML(`<h3>${hotelName.HotelName}</h3><p>${placeName}</p>`);
     
        <!-- //when user click on marked location ,Displaying message on right side of map -->
        marker.getElement().addEventListener('click', () => {
        <!-- // Update the info element with location details -->
        {{-- infoElement.innerHTML = `<p class="border border-gray-400 ml-2 p-2 text-black font-serif">${placeName}</p>`; --}}
      });
     
      marker.setPopup(popup);
     
      <!-- // Show popup on mouse enter -->
      marker.getElement().addEventListener('mouseenter', () => {
        popup.addTo(map);
      });
     
      <!-- // Hide popup on mouse leave -->
      marker.getElement().addEventListener('mouseleave', () => {
        popup.remove();
      });
     
    <!-- //   // Show popup on marker click -->
      marker.on('click', () => {
        marker.togglePopup();
      });
    });
</x-splade-script>    
</x-layout>
