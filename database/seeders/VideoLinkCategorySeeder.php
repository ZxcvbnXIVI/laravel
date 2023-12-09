<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoLinkCategory;

class VideoLinkCategorySeeder extends Seeder
{
    public function run()
    {
        // Assuming you have Video and Category records with IDs 1 and 2
        // Adjust the IDs according to your actual data

        VideoLinkCategory::create([
            'VideoID' => 1,
            'CategoryID' => 1,
        ]);

        VideoLinkCategory::create([
            'VideoID' => 2,
            'CategoryID' => 1,
        ]);

        VideoLinkCategory::create([
            'VideoID' => 3,
            'CategoryID' => 2,
        ]);

        VideoLinkCategory::create([
            'VideoID' => 4,
            'CategoryID' => 2,
        ]);

        // Add more records as needed
    }
}
