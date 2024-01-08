<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product 1',
                'price' => 1500,
                'quantity' => 50,
                'category_id' => 1,
                'description' => 'Description for Product 1',
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'Product 2',
                'price' => 2000,
                'quantity' => 30,
                'category_id' => 1,
                'description' => 'Description for Product 2',
                'image' => 'product2.jpg',
            ],
            [
                'name' => 'Product 3',
                'price' => 1500,
                'quantity' => 50,
                'category_id' => 2,
                'description' => 'Description for Product 1',
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'Product 4',
                'price' => 1500,
                'quantity' => 50,
                'category_id' => 2,
                'description' => 'Description for Product 1',
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'Product 5',
                'price' => 1500,
                'quantity' => 50,
                'category_id' => 3,
                'description' => 'Description for Product 1',
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'Product 6',
                'price' => 1500,
                'quantity' => 50,
                'category_id' => 3,
                'description' => 'Description for Product 1',
                'image' => 'product1.jpg',
            ],
            // Add more sample data as needed
        ];

        // Insert data into the products table
        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
