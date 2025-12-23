<?php

namespace Database\Factories;

use App\Models\Evaluation;
use App\Models\FollowUpTest;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween(1, 8),
            'duration_months' => $this->faker->numberBetween(1, 36),
            'max_participants' => $this->faker->numberBetween(5, 30),
            'image' => null,
            'evaluation_id' => Evaluation::factory(),
            'follow_up_test_id' => FollowUpTest::factory(),
        ];
    }
}
