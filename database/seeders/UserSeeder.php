<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();

        User::insert([
            [
                "first_name" => "Michael",
                "last_name" => "Nabangi",
                "gender" => "Male",
                "ip_address" => "127.0.0.1",
                "is_admin" => "7",
                "email" => 'miguelnabz@gmail.com',
                "password" => Hash::make("M1gu3l."),
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "first_name" => "Michael",
                "last_name" => "Nabangi",
                "gender" => "Male",
                "ip_address" => "127.0.0.1",
                "is_admin" => "1",
                "email" => "michael.nabangi@strathmore.edu",
                "password" => Hash::make("mike"),
                "email_verified_at" => Carbon::now(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
