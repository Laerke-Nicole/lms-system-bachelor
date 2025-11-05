<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GdprFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $consentDate = $this->faker->dateTimeBetween('-2 years', 'now');

        return [
            'consent_date' => $consentDate,
            'valid_until' => $this->faker->dateTimeBetween($consentDate, '+3 years'),
            'user_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
