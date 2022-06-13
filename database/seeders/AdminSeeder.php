<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user -> first_name = "mohammed";
        $user -> last_name = "ahmed";
        $user -> email = "mohammed@gmail.com";
        $user -> password = Hash::make(12345678);
        $user -> level = 1;
        $user -> save();
    }
}
