<?php

namespace Database\Seeders;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        Banner::truncate();

        Banner::insert([
            [
                "title" => "Banner 1",
                "image" => "banner-1.jpg",
                "link" => "#",
                'alt' => 'Sport shoes',
                'type' => 'Slider',
                'description' => 'Best offer you gon get',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                "title" => "Banner 2",
                "image" => "banner-2.jpg",
                "link" => "#",
                'alt' => 'Sport shoes',
                'type' => 'Slider',
                'description' => 'Best offer you gon get',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                "title" => "Banner 3",
                "image" => "banner-3.jpg",
                "link" => "#",
                'alt' => 'Sport shoes',
                'type' => 'Slider',
                'description' => 'Best offer you gon get',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                "title" => "Banner 4",
                "image" => "banner-4.jpg",
                "link" => "#",
                'alt' => 'Sport shoes',
                'type' => 'Slider',
                'description' => 'Best offer you gon get',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                "title" => "Banner 5",
                "image" => "banner-5.jpg",
                "link" => "#",
                'alt' => 'Sport shoes',
                'type' => 'Slider',
                'description' => 'Best offer you gon get',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'title' => "some title",
                'image' => "slider-number-11.jpg",
                'link' => "some-link",
                'alt' => 'some advert',
                'type' => 'Box',
                'description' => "some title",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'title' => "some title",
                'image' => "slider-number-12.jpg",
                'link' => "some-link",
                'alt' => 'some advert',
                'type' => 'Box',
                'description' => "some title",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'title' => "some title",
                'image' => "slider-number-14.jpg",
                'link' => "some-link",
                'alt' => 'some advert',
                'type' => 'Box',
                'description' => "some title",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
