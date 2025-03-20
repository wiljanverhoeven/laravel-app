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
        // Get all festivals
        $festivals = Festival::all();

        foreach ($festivals as $festival) {
            // Create multiple bus routes for each festival
            $this->createBusRoutesForFestival($festival);
        }
    }

    
    private function createBusRoutesForFestival(Festival $festival): void
    {
        // Define starting cities based on festival location
        $startingCities = $this->getStartingCitiesForLocation($festival->location);
        
        // Create departure dates (day before and first day of festival)
        $departureDates = [
            $festival->start_date->copy()->subDay(),
            $festival->start_date,
        ];
        
        // Create return dates (last day and day after festival)
        $returnDates = [
            $festival->end_date,
            $festival->end_date->copy()->addDay(),
        ];
        
        // Create bus routes for each starting city with various departure/return options
        foreach ($startingCities as $city) {
            foreach ($departureDates as $departureDate) {
                foreach ($returnDates as $returnDate) {
                    // Skip illogical combinations (return before departure)
                    if ($returnDate->lt($departureDate)) {
                        continue;
                    }
                    
                    // Create morning and afternoon departure options
                    $this->createBusRoute($festival, $city, $departureDate, $returnDate, '08:00');
                    $this->createBusRoute($festival, $city, $departureDate, $returnDate, '14:00');
                }
            }
        }
    }
    
   
    private function createBusRoute(Festival $festival, string $startCity, Carbon $departureDate, Carbon $returnDate, string $departureTime): void
    {
        // Calculate price based on distance/duration
        $price = $this->calculatePrice($startCity, $festival->location);
        
        // Calculate duration based on cities
        $duration = $this->calculateDuration($startCity, $festival->location);
        
        // Create the bus route
        BusRoute::create([
            'festival_id' => $festival->id,
            'departure_city' => $startCity,
            'destination' => $festival->location,
            'departure_date' => $departureDate,
            'departure_time' => $departureTime,
            'return_date' => $returnDate,
            'return_time' => '12:00', // Default return time
            'price' => $price,
            'duration' => $duration,
            'available_seats' => 50,
            'is_active' => true,
        ]);
    }
    
    
    private function getStartingCitiesForLocation(string $festivalLocation): array
    {
        // Define common cities for each country
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
        // Extract city names for comparison
        $startCityName = explode(',', $startCity)[0];
        $destinationName = explode(',', $destination)[0];
        
        // Define base prices
        $basePrice = 35.00;
        
        // Adjust price based on city combinations
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
        
        // Default price based on different cities
        return $basePrice;
    }
    
    
    private function calculateDuration(string $startCity, string $destination): int
    {
        // Extract city names for comparison
        $startCityName = explode(',', $startCity)[0];
        $destinationName = explode(',', $destination)[0];
        
        // Define durations in minutes for specific routes
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
        
        // Default duration (2 hours)
        return 120;
    }
}