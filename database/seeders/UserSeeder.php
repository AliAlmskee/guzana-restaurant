<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
      
            User::create([
                'name' => "Admin",
                'email' => "admin@example.com",
                'password' => Hash::make('password'), 
                'role' => 'admin', 
            ]);
        

        // Create 2 Secretaries
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "Secretary $i",
                'email' => "secretary$i@example.com",
                'password' => Hash::make('password'), 
                'role' => 'secretary', 
            ]);
        }
    }
}
