<?php

namespace Database\Seeders;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::truncate();

        Slider::insert([
            [
                "name" => "Slider 1",
                "image" => "slide-1.jpg",
                "url" => "#",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Slider 2",
                "image" => "slide-2.jpg",
                "url" => "#",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Slider 3",
                "image" => "slide-3.jpg",
                "url" => "#",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Slider 4",
                "image" => "slide-4.jpg",
                "url" => "#",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],[
                "name" => "Slider 5",
                "image" => "slide-5.jpg",
                "url" => "#",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);
    }
}
