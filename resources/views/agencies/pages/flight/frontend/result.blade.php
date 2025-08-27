<x-main.layout>

<x-flight.result 
    :airlines="$airlines"
    :default-settings="$defaultSettings"
    :custom-settings="$customSettings"
    :flights="$flights"
    :unique-stops="$uniqueStops"
    :unique-airlines="$uniqueAirlines"
    :costliest-flight="$costliestFlight"
    :costliest-price="$costliestPrice"
    :cheapest-flight="$cheapestFlight"
    :cheapest-price="$cheapestPrice"
    :flight-search="$flightSearch"
/>
</x-main.layout>

