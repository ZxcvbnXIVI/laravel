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
'CategoryImage'=> 'https://media.discordapp.net/attachments/1176177405715558520/1179822866708041778/image.png?ex=6584692b&is=6571f42b&hm=bfb29ddf79d86cac9de2348135823a7854c5b4d4e9d1d20137455d68f24bb21a&=&format=webp&quality=lossless&width=187&height=187',

                'created_at' => now(),
                'updated_at' => now(),
        ]);

        Category::create([
                'CategoryID' => 2,
                'CategoryName' => "ศิลปะ",
                'CategoryImage'=> "https://media.discordapp.net/attachments/1176177405715558520/1179822866934550600/image.png?ex=6584692b&is=6571f42b&hm=9cfbda32ef7c5cd91c4079f7a48590ab2974e67f1c17bf29142a69b0101fdffe&=&format=webp&quality=lossless&width=187&height=187",

                'created_at' => now(),
                'updated_at' => now(),
        ]);

        // เพิ่มข้อมูลเพิ่มเติมตามต้องการ
    }
}
