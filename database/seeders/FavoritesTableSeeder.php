<?php

namespace Database\Seeders;

use App\Models\Favorite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
        {
            // Create sample favorites
            Favorite::create([
                'UserID' => 1, // replace with a valid user ID
                'VideoID' => 1, // replace with a valid video ID
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Add more sample favorites as needed
        }
    
}
