<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'user_id' => 1,
                'phone' => 110039317,
                'primary' => 1
            ],[
                'user_id' => 1,
                'phone' => 715270660,
                'primary' => 0
            ],[
                'user_id' => 2,
                'phone' => 736388405,
                'primary' => 1
            ]
        ]);
    }
}
