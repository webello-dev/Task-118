<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FlightsSeeder extends Seeder
{
    public function run()
    {
        $startDate = '1403-07-10';
        $endDate = '1403-07-20';
    
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);
    
        for ($currentTimestamp = $startTimestamp; $currentTimestamp <= $endTimestamp; $currentTimestamp += 86400) { 
            $currentDate = date('Y-m-d', $currentTimestamp); 
    
            $url = 'https://chartertest3.ir/_bookingplus/public/api/hub/check-route';
    
            $data = [
                'adult'    => 1,
                'arrival'  => 'THR',
                'child'    => 0,
                'date'     => $currentDate,
                'departure'=> 'MHD',
                'infant'   => 0,
                'retDate'  => null
            ];
    
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0',
            ])->post($url, $data);
    
            if ($response->failed()) {
                echo "Token not found{$currentDate}.\n";
                continue; 
            }
    
            // استخراج توکن
            $responseData = $response->json();
            $token = $responseData['token'] ?? null;
    
            if (!$token) {
                echo "Token not found{$currentDate}.\n";
                continue; 
            }
    
            $url = 'https://chartertest3.ir/_booking/CheapestPrice/serachCacheToken/' . $token;
    
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0',
            ])->get($url);
    
            if ($response->failed()) {
                echo "api failed{$currentDate}.\n";
                continue; 
            }
    
            $flightsData = $response->json();
    
            if (empty($flightsData) || !isset($flightsData['outbound2'])) {
                echo "No information found{$currentDate}.\n";
                continue; 
            }
    
            foreach ($flightsData['outbound2'] as $flight) {
                foreach ($flight as $items) {
                    DB::table('flights')->insert([
                        'airline_name' => $items['flight_details']['airline_name_en'],
                        'flight_number' => $items['flight_details']['flight_number'],
                        'airplane' => $items['flight_details']['airplane'],
                        'class' => $items['flight_details']['class'],
                        'adult_fare' => $items['passenger_fare']['adult']['fare'],
                        'adult_tax' => $items['passenger_fare']['adult']['tax'],
                        'child_fare' => $items['passenger_fare']['child']['fare'],
                        'infant_fare' => $items['passenger_fare']['infant']['fare'],
                        'departure_city' => $items['departure']['city_name_en'],
                        'departure_location_code' => $items['departure']['location_code'],
                        'departure_airport' => $items['departure']['airport_name_en'],
                        'departure_date' => $items['departure']['date'],
                        'departure_time' => $items['departure']['time'],
                        'arrival_city' => $items['arrival']['city_name_en'],
                        'arrival_location_code' => $items['arrival']['location_code'],
                        'arrival_airport' => $items['arrival']['airport_name_en'],
                        'arrival_date' => $items['arrival']['date'],
                        'arrival_time' => $items['arrival']['time'],
                        'baggage_quantity' => $items['baggages']['Quantity'],
                        'baggage_unit' => $items['baggages']['Unit'],
                        'duration' => $items['duration'],
                        'price' => $items['price'],
                    ]);
                }
            }
    
            echo "Flight date{$currentDate}saved\n";

        }
    }
    
}
