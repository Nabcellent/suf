<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Address::truncate();

        Address::insert([
            [
                'user_id' => 1,
                'sub_county_id' => 321,
            ],[
                'user_id' => 1,
                'sub_county_id' => 310,
            ],[
                'user_id' => 2,
                'sub_county_id' => 317,
            ],[
                'user_id' => 3,
                'sub_county_id' => 313,
            ]
        ]);
    }
}
