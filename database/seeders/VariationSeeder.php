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
        $jsonArr = json_encode([
            'S' => [
                'stock' => 0,
                'extra_price' => 0,
                'image' => '',
                'status' => 1
            ],
            "M" => [
                'stock' => 0,
                'extra_price' => 0,
                'image' => '',
                'status' => 1
            ],
            "XL" => [
                'stock' => 0,
                'extra_price' => 0,
                'image' => '',
                'status' => 1
            ]
        ], JSON_THROW_ON_ERROR);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Variation::truncate();

        Variation::insert([
            [
                "product_id" => 1,
                "attribute_id" => 2,
                "options" => $jsonArr,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
