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
                'user_id' => 2,
                'username' => 'Majoka',
                'national_id' => 39876542,
                'type' => 'Seller',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'user_id' => 3,
                'username' => 'Cado',
                'national_id' => 39876543,
                'type' => 'Super',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
