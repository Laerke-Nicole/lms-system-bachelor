<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company(),
            'company_mail' => $this->faker->unique()->companyEmail(),
            'company_phone' => $this->faker->unique()->phoneNumber(),
            'is_vestas' => $this->faker->boolean(20),
            'address_id' => Address::inRandomOrder()->value('id'),
        ];
    }
}
