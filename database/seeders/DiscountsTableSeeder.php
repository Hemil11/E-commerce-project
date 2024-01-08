<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Generate sample data for discounts table
          $discounts = [
            [
                'code' => 'DISCOUNT25',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'limit' => 100,
                'discount' => 25,
            ],
            [
                'code' => 'SALE50',
                'start_date' => '2023-02-15',
                'end_date' => '2023-03-15',
                'limit' => 50,
                'discount' => 50,
            ],
            // Add more sample data as needed
        ];

        // Insert data into the discounts table
        foreach ($discounts as $discount) {
            DB::table('discounts')->insert($discount);
        }
    }
}
