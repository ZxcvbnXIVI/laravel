<?php
namespace Database\Seeders;
use App\Models\Bookmark;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookmarksTableSeeder extends Seeder
{
    public function run()
    {
        // Create sample bookmarks
        Bookmark::create([
            'UserID' => 1, // replace with a valid user ID
            'VideoID' => 1, // replace with a valid video ID
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add more sample bookmarks as needed
    }
}
