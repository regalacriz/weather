<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function fetch(Request $request)
    {
        // Validate input
        $request->validate([
            'city'      => 'required|string',
            'country'   => 'nullable|string',
        ]);

        // POST Data
        $city    = $request->city;
        $country = $request->country;

        // Build query string
        $query = $city;
        if ($country) {
            $query .= ',' . $country;
        }

        // Create Cache Key
        $cache  = "weather_" . str_replace(',', '_', $query);
        $source = cache()->has($cache);

        try {
            $data = Cache::remember($cache, 600, function () use ($query) {
                $base_url = env('OPENWEATHERMAP_URL');
                $apiKey  = env('OPENWEATHERMAP_KEY');

                $response = Http::withoutVerifying()->get("{$base_url}/weather", [
                    'q'     => $query,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                throw new \RuntimeException('OpenWeatherMap API returned an error.');
            });

            $source = Cache::has($cache) ? 'cache' : 'external';

            return response()->json([
                'source' => $source,
                'data'   => $data,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage() ?: 'Unable to fetch weather data.'
            ], 500);
        }
    }
}
