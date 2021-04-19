<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Phone::truncate();

        Phone::insert([
            [
                'phoneable_type' => Admin::class,
                'phoneable_id' => 2,
                'phone' => 110039315,
                'primary' => 1
            ],[
                'phoneable_type' => Admin::class,
                'phoneable_id' => 1,
                'phone' => 715270660,
                'primary' => 1
            ],[
                'phoneable_type' => User::class,
                'phoneable_id' => 1,
                'phone' => 736388405,
                'primary' => 1
            ],[
                'phoneable_type' => User::class,
                'phoneable_id' => 2,
                'phone' => 736383205,
                'primary' => 1
            ],[
                'phoneable_type' => User::class,
                'phoneable_id' => 11,
                'phone' => 710382305,
                'primary' => 1
            ],[
                'phoneable_type' => User::class,
                'phoneable_id' => 16,
                'phone' => 700382305,
                'primary' => 1
            ],[
                'phoneable_type' => User::class,
                'phoneable_id' => 17,
                'phone' => 110382234,
                'primary' => 1
            ]
        ]);
    }
}
