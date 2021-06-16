<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stats =[
            [
                'stat_id' => 1,
                'stat_name' => 'On Sale',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat_id' => 2,
                'stat_name' => 'Sold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat_id' => 3,
                'stat_name' => 'Reserved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'stat_id' => 4,
                'stat_name' => 'Withdrawn',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Status::insert($stats);
    }
}
