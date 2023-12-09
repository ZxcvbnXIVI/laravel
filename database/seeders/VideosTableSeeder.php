<?php

namespace Database\Seeders;
use App\Models\Video;

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        // สร้างข้อมูลทดสอบ
        Video::create([
            'VideoID' => 1,
            'SubjectID' => 1,
            'VideoTitle' => "ชายผู้เติมไวที่สุด | RLCraft ครัวเหลี่ยมข้าวอร่อย EP.1",
            'VideoURL' => "https://youtu.be/hDEKU33U020?si=wXMVb1cwt9XAeuJ2",
            'Thumbnail' => "https://img.youtube.com/vi/hDEKU33U020/0.jpg",
            'ChannelName' => "Gssspotted",
            'VideoCode' => "hDEKU33U020",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Video::create([
            'VideoID' => 2,
            'SubjectID' => 1,
            'VideoTitle' => "บ้านนี้เจ้าที่แรง | RLCraft ครัวเหลี่ยมข้าวอร่อย EP.2",
            'VideoURL' => "https://youtu.be/FcQvAOyD9i8?si=cvmS35f4tikHhqSf",
            'Thumbnail' => "https://img.youtube.com/vi/R7ZCPM-Aufw/0.jpg",
            'ChannelName' => "Gssspotted",
            'VideoCode' => "FcQvAOyD9i8",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Video::create([
            'VideoID' => 3,
            'SubjectID' => 2,
            'VideoTitle' => "'เฮี้ยน' | คุณแก๊ป | 5 ก.พ. 17 | THE GHOST RADIO | เล่าเรื่องผีเดอะโกส",
            'VideoURL' => "https://youtu.be/0byQ3wvcs58?si=yFUZLyHABevJ_ROI",
            'Thumbnail' => "https://img.youtube.com/vi/0byQ3wvcs58/0.jpg",
            'ChannelName' => "The ghost",
            'VideoCode' => "0byQ3wvcs58",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Video::create([
            'VideoID' => 4,
        'SubjectID' => 2,
        'VideoTitle' => "'ห้องสนิม | คุณแป้ง | 6 ม.ค. 61 | ***น่ากลัวมากของปี 2561 THE GHOST RADIO | ฟังเรื่องผีเดอะโกส'",
        'VideoURL' => "https://youtu.be/R7ZCPM-Aufw?si=v4YvPAzLUEseC-cA",
        'Thumbnail' => "https://img.youtube.com/vi/R7ZCPM-Aufw/0.jpg",
        'ChannelName' => "The ghost",
        'VideoCode' => "R7ZCPM-Aufw",
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}