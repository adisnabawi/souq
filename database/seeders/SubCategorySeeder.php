<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subs;
class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $subs =[
            [
                'cat_id' => 1,
                'sub_name' => 'Muslim Fashion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 1,
                'sub_name' => 'Muslimah Fashion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 1,
                'sub_name' => 'Health & Beauty',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 2,
                'sub_name' => 'Home Decor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 2,
                'sub_name' => 'Furniture',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 3,
                'sub_name' => 'Computers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 3,
                'sub_name' => 'Mobile phones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 3,
                'sub_name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 4,
                'sub_name' => 'Textbooks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 4,
                'sub_name' => 'Books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 4,
                'sub_name' => 'Stationaries',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 5,
                'sub_name' => 'Tuition',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 5,
                'sub_name' => 'Gadget & Electronic repairs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_id' => 5,
                'sub_name' => 'Others',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Subs::insert($subs);

    }
}
