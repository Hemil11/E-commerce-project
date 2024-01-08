<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make(1111);
        $admin->mo_no = 9925762118;
        $admin->gender = "male";
        $admin->user_type= 1;
        $admin->save();
    }
}
