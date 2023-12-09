<?php
// database/seeders/ProgressSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    public function run()
    {
        // Create test progress records
        Progress::create([
            'UserID' => 1,
            'VideoID' => 1,
            'EnrollmentId' => 2,
            'ProgressPercentage' => 50,
            'lastViewedTimestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Progress::create([
            'UserID' => 1,
            'VideoID' => 2,
            'EnrollmentId' => 2,
            'ProgressPercentage' => 50,
            'lastViewedTimestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Progress::create([
            'UserID' => 1,
            'VideoID' => 3,
            'EnrollmentId' => 3,
            'ProgressPercentage' => 50,
            'lastViewedTimestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Progress::create([
            'UserID' => 1,
            'VideoID' => 4,
            'EnrollmentId' => 3,
            'ProgressPercentage' => 50,
            'lastViewedTimestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Add more progress records as needed
        
    }
}
