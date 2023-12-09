<?php
// database/seeders/EnrollmentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        // Create test enrollments
        Enrollment::create([
            'UserID' => 1,
            'SubjectID' => 1,
            'EnrollmentDate' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Enrollment::create([
            'UserID' => 1,
            'SubjectID' => 2,
            'EnrollmentDate' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
      
        // Add more enrollments as needed
    }
}
