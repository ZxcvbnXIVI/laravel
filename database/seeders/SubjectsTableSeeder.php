<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        // สร้างข้อมูลทดสอบ
        Subject::create([
            'SubjectName' => 'Math',
            'Description' => 'Introduction to Mathematics',
            'PlaylistLink' => 'https://youtube.com/mathplaylist',
        ]);

        Subject::create([
            'SubjectName' => 'Science',
            'Description' => 'Introduction to Science',
            'PlaylistLink' => 'https://youtube.com/scienceplaylist',
        ]);

        // เพิ่มข้อมูลเพิ่มเติมตามต้องการ
    }
}