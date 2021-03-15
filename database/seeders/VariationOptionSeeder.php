<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\VariationOption;

class VariationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        VariationOption::truncate();

        VariationOption::insert([
            [
                "variation_id" => 1,
                "variant" => "s",
                "extra_price" => 0,
            ],[
                "variation_id" => 1,
                "variant" => "M",
                "extra_price" => 7.5,
            ],[
                "variation_id" => 1,
                "variant" => "XL",
                "extra_price" => 17.5,
            ]
        ]);
    }
}
