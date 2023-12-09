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
'CategoryImage'=> 'https://cdn.discordapp.com/attachments/1176177405715558520/1179822866708041778/image.png',

                'created_at' => now(),
                'updated_at' => now(),
        ]);

        Category::create([
                'CategoryID' => 2,
                'CategoryName' => "รวมเรื่องเล่า The Ghost Radio",
                'CategoryImage'=> "https://cdn.discordapp.com/attachments/1176177405715558520/1179822866934550600/image.png",

                'created_at' => now(),
                'updated_at' => now(),
        ]);

        // เพิ่มข้อมูลเพิ่มเติมตามต้องการ
    }
}
