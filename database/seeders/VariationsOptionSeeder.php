<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\VariationsOption;

class VariationsOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        VariationsOption::truncate();

        VariationsOption::insert([
            [
                "variation_id" => 1,
                "variant" => "S",
                "stock" => "12",
                "extra_price" => 0,
            ],[
                "variation_id" => 1,
                "variant" => "M",
                "stock" => "7",
                "extra_price" => 7.5,
            ],[
                "variation_id" => 1,
                "variant" => "XL",
                "stock" => "3",
                "extra_price" => 17.5,
            ]
        ]);
    }
}
