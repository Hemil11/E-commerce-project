<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'user_type' => 1, // Admin user
                'otp' => null,
                'mo_no' => null,
                'image' => null,
                'gender' => 'male',
                'stripe_customer_id' => null,
                'surname' => 'AdminSurname',
                'is_subscribe' => true,
            ],
            [
                'name' => 'Regular User',
                'email' => ' ',
                'password' => Hash::make('password'),
                'user_type' => 2, // Regular user
                'otp' => null,
                'mo_no' => null,
                'image' => null,
                'gender' => 'female',
                'stripe_customer_id' => null,
                'surname' => 'UserSurname',
                'is_subscribe' => false,
            ],
            // Add more sample data as needed
        ];

        // Insert data into the users table
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
