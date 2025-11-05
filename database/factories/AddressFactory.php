<?php

namespace Database\Factories;

use App\Models\PostalCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street_name' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'postal_code_id' => PostalCode::inRandomOrder()->value('id'),
        ];
    }
}
