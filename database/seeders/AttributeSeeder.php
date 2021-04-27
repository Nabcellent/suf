<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Attribute;
use Illuminate\Database\Seeder;
use JsonException;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run(): void
    {
        Attribute::truncate();

        Attribute::insert([
            [
                'name' => 'Colors',
                'values' => json_encode(["Green", "Blue", "White"], JSON_THROW_ON_ERROR),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                'name' => 'Sizes',
                'values' => json_encode(["S", "M", "L", "XL"], JSON_THROW_ON_ERROR),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                'name' => 'Materials',
                'values' => json_encode("Cotton", JSON_THROW_ON_ERROR),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ]);
    }
}
