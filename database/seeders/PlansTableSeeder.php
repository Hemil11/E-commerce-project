<?php

namespace Database\Seeders;

use Illuminate\Database\Console\DbCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'plan_id' => 'BASIC123',
                'amount' => 1999,
            ],
            [
                'name' => 'Premium Plan',
                'plan_id' => 'PREMIUM456',
                'amount' => 3999,
            ],
            // Add more sample data as needed
        ];

        // Insert data into the plans table
        foreach ($plans as $plan) {
            DB::table('plans')->insert($plan);
        }
    }
}
