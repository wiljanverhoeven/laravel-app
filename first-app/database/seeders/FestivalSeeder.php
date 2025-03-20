<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FestivalSeeder extends Seeder
{
    
    public function run(): void
    {
        $festivals = [
            [
                'name' => 'Tomorrowland',
                'description' => 'Een van de grootste EDM festivals.',
                'location' => 'Boom, Belgie',
                'start_date' => Carbon::create(2025, 7, 18),
                'end_date' => Carbon::create(2025, 7, 27),
                'image_path' => '',
                'is_active' => true,
            ],
            [
                'name' => 'Defqon',
                'description' => 'Het grootste hardstyle festival.',
                'location' => 'Biddinguizen, Nederland',
                'start_date' => Carbon::create(2025, 6, 26),
                'end_date' => Carbon::create(2025, 6, 29),
                'image_path' => '',
                'is_active' => true,
            ],
            [
                'name' => 'Pinkpop',
                'description' => 'Een jaarlijks driedaags popfestival.',
                'location' => 'Landgraaf, Nederland',
                'start_date' => Carbon::create(2025, 6, 20),
                'end_date' => Carbon::create(2025, 6, 22),
                'image_path' => '',
                'is_active' => true,
            ],
        ];

        foreach ($festivals as $festival) {
            Festival::create($festival);
        }
    }
}