<?php

namespace Database\Seeders;

use Illuminate\Database\Console\DbCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = [
            [
                'product_id' => 1,
                'user_id' => 1, 
                'quantity' => 2,
            ],
            [
                'product_id' => 2,
                'user_id' => 2, 
                'quantity' => 3,
            ],
            
        ];

        foreach ($carts as $cart) {
            
            $productExists = DB::table('products')->where('id', $cart['product_id'])->exists();

            $userExists = DB::table('users')->where('id', $cart['user_id'])->exists();

            if ($productExists && $userExists) {
                DB::table('carts')->insert($cart);
            } else {
                if (!$productExists) {
                    echo "Product with ID {$cart['product_id']} does not exist in the products table.\n";
                }
                if (!$userExists) {
                    echo "User with ID {$cart['user_id']} does not exist in the users table.\n";
                }
            }
        }

    }
}
