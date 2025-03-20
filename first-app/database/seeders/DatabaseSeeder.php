<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        // The order is important due to foreign key relationships
        $this->call([
            UserSeeder::class,
            FestivalSeeder::class,
            BusRouteSeeder::class,
            ReturnBusRouteSeeder::class,
            BookingSeeder::class,
            ReturnBookingSeeder::class,
            PassengerSeeder::class,
            PaymentSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}