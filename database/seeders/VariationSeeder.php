<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Variation;
use JsonException;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run(): void
    {
        $arr = array("Sizes" => ["S", "M", "XL"]);
        $jsonArr = json_encode($arr, JSON_THROW_ON_ERROR);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Variation::truncate();

        Variation::insert([
            [
                "product_id" => 1,
                "variation" => $jsonArr,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
