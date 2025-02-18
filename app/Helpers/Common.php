<?php
use Illuminate\Support\Collection;

// airline name where airline code is arilineCode
function getAirlineName($airlineCode, $airlines)
{
    $names = $airlines->where('iata', $airlineCode);
    return $names->count() ? $names->first()->name : $airlineCode;
}

function currencySymbol($currencyCode)
{
    $currencyCodes = collect([
        [
            'code' => 'USD',
            'symbol' => '$'
        ],
        [
            'code' => 'INR',
            'symbol' => '₹'
        ],
        [
            'code' => 'GBP',
            'symbol' => '£'
        ],

    ]);
    return $currencyCodes->where('code', $currencyCode)->first()['symbol'];
}

function hoursandmins($time, $format = '%02d hours %02d minutes')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}


// function airport($airportCode, $airports)
// {
//     return $airports->where('code', $airportCode)->first();
// }

function airport($code, $airports)
{
    if (isset($airports[$code])) {
        return $airports[$code];
    }

    $airport = \App\Models\Airport::where('code', $code)->first();

    if ($airport) {
        return $airport;
    }

    return (object) [
        'airport' => 'Unknown Airport',
        'code' => $code,
        'country' => 'Unknown Country'
    ];
}


function getAirportCode($inputString)
{
    $matches = [];
    preg_match('/\[(.*?)\]/', $inputString, $matches);
    
    // dd($matches);

    return isset($matches[1]) ? $matches[1] : null;
}

// function airportName($code){
//     $airport = \App\Models\Airport::where('code', $code)->first();
//     // dd($airport);
//     return $airport->airport . ', [' . $airport->code . '], ' . $airport->country;
//     return;
// }

function airportName($code)
{

    $airport = \App\Models\Airport::where('code', $code)->first();


    if ($airport) {
        return $airport->airport . ', [' . $airport->code . '], ' . $airport->country;
    } else {

        return 'Unknown Airport [' . $code . ']';
    }
}





