<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // เพิ่มข้อมูลตัวอย่าง
        DB::table('categories')->insert([
            'CategoryName' => 'Category 1',
        ]);

        DB::table('categories')->insert([
            'CategoryName' => 'Category 2',
        ]);


    }
}
