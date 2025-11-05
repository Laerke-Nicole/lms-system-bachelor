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

    protected $model = TrainingUser::class;

    public function definition()
    {
        return [
            'user_id'  => User::inRandomOrder()->value('id'),
            'training_id' => Training::inRandomOrder()->value('id'),
        ];
    }
}
