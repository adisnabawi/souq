<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locs =[
            [
                'loc_id' => 1,
                'loc_name' => 'All Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loc_id' => 2,
                'loc_name' => 'IIUM Gombak Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loc_id' => 3,
                'loc_name' => 'IIUM Kuantan Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loc_id' => 4,
                'loc_name' => 'IIUM Pagoh Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loc_id' => 5,
                'loc_name' => 'IIUM Gambang Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'loc_id' => 6,
                'loc_name' => 'IIUM KL Campus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Location::insert($locs);
    }
}
