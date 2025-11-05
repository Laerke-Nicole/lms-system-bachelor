<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $issueDate = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'title' => $this->faker->sentence(3),
            'date' => $issueDate,
            'valid_until' => $this->faker->dateTimeBetween($issueDate, '+2 years'),
            'vestas_format' => $this->faker->boolean(30),
            'url' => $this->faker->url(),
            'content' => $this->faker->paragraph(),
            'verified_by_id' => User::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
