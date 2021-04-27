<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Policy::truncate();

        Policy::insert([
            [
                'title' => 'Policy One',
                'description' => 'The Laravel routing component allows all characters except / to be present within route parameter values. You must explicitly allow / to be part of your placeholder using a where condition regular expression:',
            ],[
                'title' => 'Policy Two',
                'description' => 'Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route by chaining the name method onto the route definition:',
            ],[
                'title' => 'Policy Three',
                'description' => 'Once you have assigned a name to a given route, you may use the route\'s name when generating URLs or redirects via Laravel\'s route and redirect helper functions:',
            ],
        ]);
    }
}
