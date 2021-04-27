<?php

namespace Database\Seeders;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();

        Brand::insert([
            [
                "name" => "Arrow",
                "status" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Gap",
                "status" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Lee",
                "status" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Monte Carlo",
                "status" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Peter England",
                "status" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
