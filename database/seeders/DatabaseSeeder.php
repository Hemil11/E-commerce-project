<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(AdminSedder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(CartsTableSeeder::class);
    }
}
