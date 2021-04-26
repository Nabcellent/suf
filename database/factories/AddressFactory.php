<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\SubCounty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'sub_county_id' => $this->faker->randomElement(SubCounty::pluck('id')->toArray()),
            'address' => $this->faker->address,
        ];
    }
}
