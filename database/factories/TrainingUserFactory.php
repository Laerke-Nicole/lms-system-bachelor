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
            'completed_test_at' => $date,
            'completed_evaluation_at' => $date,
            'signature' => $user->first_name . ' ' . $user->last_name,
            'signature_confirmed' => true,
            'signed_at' => $date,
        ];
    }
}
