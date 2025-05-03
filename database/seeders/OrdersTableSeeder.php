<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'user_name' => 'John Smith',
                'user_email' => 'john.smith@example.com',
                'date' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
                'number_of_seats' => 2,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Emma Johnson',
                'user_email' => 'emma.j@example.com',
                'date' => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'),
                'number_of_seats' => 4,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Michael Brown',
                'user_email' => 'michael.b@example.com',
                'date' => Carbon::now()->addDays(7)->format('Y-m-d H:i:s'),
                'number_of_seats' => 6,
                'status' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Sarah Wilson',
                'user_email' => 'sarah.w@example.com',
                'date' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'),
                'number_of_seats' => 3,
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'David Lee',
                'user_email' => 'david.lee@example.com',
                'date' => Carbon::now()->addHours(5)->format('Y-m-d H:i:s'),
                'number_of_seats' => 1,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('orders')->insert($orders);

        // Generate 15 more random orders
        for ($i = 0; $i < 15; $i++) {
            DB::table('orders')->insert([
                'user_name' => fake()->name(),
                'user_email' => fake()->unique()->safeEmail(),
                'date' => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d H:i:s'),
                'number_of_seats' => fake()->numberBetween(1, 8),
                'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}