<?php

namespace Database\Factories;

use App\Models\TrainingUser;
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
        return [
            'training_user_id' => TrainingUser::whereNotNull('completed_evaluation_at')->inRandomOrder()->value('id'),
            'file_path' => null,
            'vestas_format' => $this->faker->boolean(5),
        ];
    }
}
