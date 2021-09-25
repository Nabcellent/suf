<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CmsPage::insert([
            [
                'title' => 'About Us',
                'description' => 'Content coming soon',
                'url' => 'about-us',
                'meta_title' => 'About Us',
                'meta_desc' => 'About Su-F Store Web App',
                'meta_keywords' => 'about us, about suf, su-f, ecommerce, suf-store, store',
            ],
            [
                'title' => 'Privacy policy',
                'description' => 'Content coming soon',
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy Policy',
                'meta_desc' => 'Privacy policy of suf store ecommerce',
                'meta_keywords' => 'privacy policy',
            ]
        ]);
    }
}
