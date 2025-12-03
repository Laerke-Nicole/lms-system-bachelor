<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Training;
use App\Models\TrainingUser;

class TrainingUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'user_id'  => User::inRandomOrder()->value('id'),
            'training_id' => Training::inRandomOrder()->value('id'),
            'completed_test_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'completed_evaluation_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'signed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
