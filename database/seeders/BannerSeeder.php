<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Banner::truncate();

        Banner::insert([
            [
                "image" => "banner-1.jpg",
                "link" => "#",
                "title" => "Banner 1",
                'alt' => 'Sport shoes',
                'description' => 'Best offer you gon get'
            ],[
                "image" => "banner-2.jpg",
                "link" => "#",
                "title" => "Banner 2",
                'alt' => 'Sport shoes',
                'description' => 'Best offer you gon get'
            ],[
                "image" => "banner-3.jpg",
                "link" => "#",
                "title" => "Banner 3",
                'alt' => 'Sport shoes',
                'description' => 'Best offer you gon get'
            ],[
                "image" => "banner-4.jpg",
                "link" => "#",
                "title" => "Banner 4",
                'alt' => 'Sport shoes',
                'description' => 'Best offer you gon get'
            ],[
                "image" => "banner-5.jpg",
                "link" => "#",
                "title" => "Banner 5",
                'alt' => 'Sport shoes',
                'description' => 'Best offer you gon get'
            ],
        ]);
    }
}
