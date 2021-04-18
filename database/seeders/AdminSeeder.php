<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Admin::truncate();

        Admin::insert([
            [
                "first_name" => "Michael",
                "last_name" => "Nabangi",
                "username" => "lobengz",
                "gender" => "Male",
                "national_id" => 38907326,
                "type" => 'Admin',
                "email" => "michael.nabangi@strathmore.edu",
                "password" => Hash::make("mike"),
                "ip_address" => "127.0.0.1",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "first_name" => "Michael",
                "last_name" => "Nabangi",
                "username" => "chapatisella",
                "gender" => "Male",
                "national_id" => 38907327,
                "type" => 'Seller',
                "email" => "miguelnabz@gmail.com",
                "password" => Hash::make("mike"),
                "ip_address" => "127.0.0.1",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
