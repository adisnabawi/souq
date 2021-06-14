<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'cat_id' => 1,
            'cat_name' => 'Fashion',
            'cat_sname' => 'Fashion',
            'cat_image' => 'fashion.png',
        ]);

        DB::table('category')->insert([
            'cat_id' => 2,
            'cat_name' => 'Home & Living',
            'cat_sname' => 'Home',
            'cat_image' => 'home.png',
        ]);

        DB::table('category')->insert([
            'cat_id' => 3,
            'cat_name' => 'Mobiles & Electronics',
            'cat_sname' => 'Electronic',
            'cat_image' => 'electronic.png',
        ]);

        DB::table('category')->insert([
            'cat_id' => 4,
            'cat_name' => 'Books & Stationaries',
            'cat_sname' => 'Book',
            'cat_image' => 'book.png',
        ]);

        DB::table('category')->insert([
            'cat_id' => 5,
            'cat_name' => 'Services',
            'cat_sname' => 'Services',
            'cat_image' => 'services.png',
        ]);
    }
}
