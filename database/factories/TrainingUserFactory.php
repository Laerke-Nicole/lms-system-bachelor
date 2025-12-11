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
        $user = User::inRandomOrder()->first();
        $date = $this->faker->optional()->dateTimeBetween('-1 month', 'now');

        return [
            'user_id'  => $user->id,
            'training_id' => Training::inRandomOrder()->value('id'),
            'completed_evaluation_at' => $date,
            'assessment' => $this->faker->imageUrl(),
        ];
    }
}
