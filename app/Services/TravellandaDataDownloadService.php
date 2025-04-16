<?php

// app/Services/TravellandaDataDownloadService.php

namespace App\Services;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class TravellandaDataDownloadService
{
    protected $username;
    protected $password;
    protected $endpoint;
    protected $travellandaService;

    public function __construct()
    {
        $this->username = config('services.travellanda.username');
        $this->password = config('services.travellanda.password');
        $this->endpoint = config('services.travellanda.endpoint');
        $this->travellandaService = new TravellandaService();
    }

    public function downloadCountries()
    {
        //clear old data
        Country::truncate();
        $xmlRequest = '<Request>
<Head>
<Username>' . $this->username . '</Username>
<Password>' . $this->password . '</Password>
<RequestType>GetCountries</RequestType>
</Head>
<Body/>
</Request>';
        $response = $this->travellandaService->sendRequest($xmlRequest);
        foreach ($response['Response']['Body']['Countries']['Country'] as $country) {
            Country::create([
                'countryCode' => $country['CountryCode'],
                'countryName' => $country['CountryName'],
            ]);
        }
    }

    public function downloadCities()
    {
        // clear old data
        City::truncate();
        $countries = Country::all();
        foreach ($countries as $country) {

            $xmlRequest = '<Request>
<Head>
<Username>' . $this->username . '</Username>
<Password>' . $this->password . '</Password>
<RequestType>GetCities</RequestType>
</Head>
<Body>
<CountryCode>' . $country->countryCode . '</CountryCode>
</Body>
</Request>';
            $response = $this->travellandaService->sendRequest($xmlRequest);
            $file = fopen('cities.txt', 'a');
            fwrite($file, json_encode($response));
            fclose($file);
            if ($response['Response']['Body']['CitiesReturned'] === '0') {
                continue;
            } else {
                if ($response['Response']['Body']['CitiesReturned'] === '1') {
                    $country->cities()->create($response['Response']['Body']['Countries']['Country']['Cities']['City']);
                } else {
                    $country->cities()->createMany($response['Response']['Body']['Countries']['Country']['Cities']['City']);
                }
            }
        }
    }




}
