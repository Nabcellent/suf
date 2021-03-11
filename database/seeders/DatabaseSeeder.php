<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\UserSeeder::factory(10)->create();
        $this->call([
            UserSeeder::class,
            SellerSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,
        ]);
    }
}
