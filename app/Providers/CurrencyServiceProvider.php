<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        try {
      
            // Get user IP
            $ip = request()->ip() == '127.0.0.1'
                ? '8.8.8.8'  // fallback for localhost
                : request()->ip();

            // Geo lookup API
            $res = Http::get("https://ipapi.co/{$ip}/json/");
          

            $country = $res->json()['country'] ?? 'GB';

            // Country → currency mapping
            $currencyMap = [
                'GB' => '£',
                'US' => '$',
                'IN' => '₹',
                'EU' => '€',
                'AE' => 'د.إ',
            ];

            // Default if not mapped
            $selectedCurrency = $currencyMap[$country] ?? '£';

            // 🔥 Set global config dynamically
            config(['app.currency' => $selectedCurrency]);

        } catch (\Exception $e) {

            // Fallback value
            config(['app.currency' => '£']);
        }
    }
}
