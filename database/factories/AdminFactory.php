<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'user_id' => User::factory(),
            'username' => $this->faker->unique()->userName,
            'national_id' => $this->faker->unique()->numerify('########'),
            'type' => $this->faker->randomElement(['Seller', 'Super']),
            'created_at' => $this->faker->dateTimeBetween(now()->subDays(6), now())
        ];
    }
}
