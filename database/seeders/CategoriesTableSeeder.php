<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Category 1'],
            ['name' => 'Category 2'],
            ['name' => 'Category 3'],
            // Add more categories as needed
        ];

        // Use the DB facade to insert data
        DB::table('categories')->insert($categories);
    }
}
