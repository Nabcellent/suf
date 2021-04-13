<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DeliveryAddress::truncate();

        DeliveryAddress::insert([
            [
                'user_id' => 1,
                'sub_county_id' => 312,
                'address' => 'Kabarsiran 543 Ave',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'user_id' => 2,
                'sub_county_id' => 310,
                'address' => 'Waruku',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
