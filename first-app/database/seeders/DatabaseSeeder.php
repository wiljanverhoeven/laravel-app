<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;



class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        // The order is important due to foreign key relationships
        $this->call([
            UserSeeder::class,
            FestivalSeeder::class,
            BusRouteSeeder::class,
            BookingSeeder::class,
            RolesAndPermissionsSeeder::class
            
        ]);
    }
}