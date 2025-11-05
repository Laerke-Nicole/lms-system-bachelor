<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostalCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postal_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
        ];
    }
}
