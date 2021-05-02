<?php

namespace Database\Factories;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        $phone = $this->faker->randomElement([
            11 . $this->faker->unique()->numerify('#######'),
            7 . $this->faker->unique()->numerify('########')
        ]);

        return [
            'phone' => $phone,
            'primary' => 1,
        ];
    }
}
