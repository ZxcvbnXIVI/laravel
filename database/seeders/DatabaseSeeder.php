<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            // เพิ่ม Seeders อื่น ๆ ตามต้องการ
        ]);
    }
}
