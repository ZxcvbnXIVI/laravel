<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // สร้างข้อมูลทดสอบ
        Category::create([
                'CategoryID' => 1,
                'CategoryName' => "ธรรมะ",


                'created_at' => now(),
                'updated_at' => now(),
        ]);

        Category::create([
                'CategoryID' => 2,
                'CategoryName' => "รวมเรื่องเล่า The Ghost Radio",

                'created_at' => now(),
                'updated_at' => now(),
        ]);

        // เพิ่มข้อมูลเพิ่มเติมตามต้องการ
    }
}
