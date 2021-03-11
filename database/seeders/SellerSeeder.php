<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Seller::truncate();

        Seller::insert([
            [
                "user_id" => 2,
                "id_number" => 12345,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
