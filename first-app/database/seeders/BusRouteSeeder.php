<?php

namespace Database\Seeders;

use App\Models\BusRoute;
use App\Models\Festival;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BusRouteSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = Festival::all();

        foreach ($festivals as $festival) {
            $this->createBusRoutesForFestival($festival);
        }
    }

    private function createBusRoutesForFestival(Festival $festival): void
    {

        $startingCities = $this->getStartingCitiesForLocation($festival->location);


        $departureDates = [
            $festival->start_date->copy()->subDay(),
            $festival->start_date,
        ];


        $returnDates = [
            $festival->end_date,
            $festival->end_date->copy()->addDay(),
        ];


        foreach ($startingCities as $city) {
            foreach ($departureDates as $departureDate) {
                foreach ($returnDates as $returnDate) {
                    if ($returnDate->lt($departureDate)) {
                        continue;
                    }

                    $this->createBusRoute($festival, $city, $departureDate, $returnDate, '08:00');
                    $this->createBusRoute($festival, $city, $departureDate, $returnDate, '14:00');
                }
            }
        }
    }

    private function createBusRoute(Festival $festival, string $startCity, Carbon $departureDate, Carbon $returnDate, string $departureTime): void
    {

        $price = $this->calculatePrice($startCity, $festival->location);


        $duration = $this->calculateDuration($startCity, $festival->location);

        BusRoute::create([
            'festival_id' => $festival->id,
            'departure_location' => $startCity, // use 'departure_location' instead of 'departure_city'
            'departure_address' => 'Unknown', // Add a placeholder for departure address
            'departure_coordinates' => 'Unknown', // You can replace this with real coordinates if needed
            'departure_date' => $departureDate,
            'arrival_date' => $returnDate, // Use the return date as arrival date
            'capacity' => 50,
            'price' => $price,
            'is_active' => true,
        ]);
    }

    private function getStartingCitiesForLocation(string $festivalLocation): array
    {

        if (str_contains($festivalLocation, 'Belgie') || str_contains($festivalLocation, 'België')) {
            return [
                'Amsterdam, Nederland', 
                'Rotterdam, Nederland',
                'Antwerpen, België',
                'Brussel, België',
                'Gent, België',
                'Eindhoven, Nederland',
            ];
        } elseif (str_contains($festivalLocation, 'Nederland')) {
            return [
                'Amsterdam, Nederland', 
                'Rotterdam, Nederland',
                'Utrecht, Nederland',
                'Eindhoven, Nederland',
                'Antwerpen, België',
                'Brussel, België',
            ];
        } else {
            return [
                'Amsterdam, Nederland', 
                'Rotterdam, Nederland',
                'Brussel, België',
            ];
        }
    }

    private function calculatePrice(string $startCity, string $destination): float
    {
 
        $startCityName = explode(',', $startCity)[0];
        $destinationName = explode(',', $destination)[0];

     
        $basePrice = 35.00;

       
        if ($startCityName === 'Amsterdam' && $destinationName === 'Boom') {
            return 45.00;
        } elseif ($startCityName === 'Amsterdam' && $destinationName === 'Biddinguizen') {
            return 29.99;
        } elseif ($startCityName === 'Amsterdam' && $destinationName === 'Landgraaf') {
            return 49.99;
        } elseif ($startCityName === 'Brussel' && $destinationName === 'Boom') {
            return 19.99;
        } elseif ($startCityName === 'Brussel' && $destinationName === 'Biddinguizen') {
            return 59.99;
        }

 
        return $basePrice;
    }

    private function calculateDuration(string $startCity, string $destination): int
    {
       
        $startCityName = explode(',', $startCity)[0];
        $destinationName = explode(',', $destination)[0];

     
        if ($startCityName === 'Amsterdam' && $destinationName === 'Boom') {
            return 180; // 3 hours
        } elseif ($startCityName === 'Amsterdam' && $destinationName === 'Biddinguizen') {
            return 90; // 1.5 hours
        } elseif ($startCityName === 'Amsterdam' && $destinationName === 'Landgraaf') {
            return 150; // 2.5 hours
        } elseif ($startCityName === 'Brussel' && $destinationName === 'Boom') {
            return 45; // 45 minutes
        } elseif ($startCityName === 'Brussel' && $destinationName === 'Biddinguizen') {
            return 210; // 3.5 hours
        }

       
        return 120;
    }
}
