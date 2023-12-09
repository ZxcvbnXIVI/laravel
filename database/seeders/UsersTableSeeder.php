<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert a sample user into the users table
        User::create([
            'UserName' => 'John Doe',
            'password' => Hash::make('password'), // Use Hash::make to securely hash the password
            'Role' => 'user',
            'image_path' => 'path_to_image.jpg', // Replace with the actual image path
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // You can add more users if needed
        // ...

        // Display a message in the console after seeding
        $this->command->info('Users table seeded successfully.');
    }
}
