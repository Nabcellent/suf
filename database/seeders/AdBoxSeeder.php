<?php

namespace Database\Seeders;

use App\Models\AdBox;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdBox::truncate();

        AdBox::insert([
            [
                'number' => 1,
                'title' => "some title",
                'description' => "some title",
                'image' => "slider-number-11.jpg",
                'url' => "some title",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                'number' => 2,
                'title' => "some title",
                'description' => "some title",
                'image' => "slider-number-12.jpg",
                'url' => "some title",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                'number' => 3,
                'title' => "some title",
                'description' => "some title",
                'image' => "slider-number-14.jpg",
                'url' => "some title",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
