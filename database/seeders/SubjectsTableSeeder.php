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
            'SubjectID' => 1,
                // 'CategoryID' => 1,
                'SubjectName' => "RLCraft ครัวเหลี่ยมข้าวอร่อย",
                'Description' => "Introduction to RLCraft ครัวเหลี่ยมข้าวอร่อย",
                'PlaylistLink' => "https://youtube.com/playlist?list=PLfwth3WMQnSMixTxh6NKIxqAGe89t-56H&si=_ZX5xBAIeCx2BDgN",
                'created_at' => now(),
                'updated_at' => now(),
        ]);

        Subject::create([
            'SubjectID' => 2,
                // 'CategoryID' => 2,
                'SubjectName' => "รวมเรื่องเล่า The Ghost Radio",
                'Description' => "Introduction to รวมเรื่องเล่า The Ghost Radio",
                'PlaylistLink' => "https://youtube.com/playlist?list=PLESnSmimWaOyrrEncqo3tQZXWvu-13UwF&si=8Yz-rjkucAHVzRtN",
                'created_at' => now(),
                'updated_at' => now(),
        ]);

        // เพิ่มข้อมูลเพิ่มเติมตามต้องการ
    }
}