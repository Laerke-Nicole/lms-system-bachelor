<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowUpTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'test_link' => $this->faker->url(),
            'course_id' => Course::inRandomOrder()->value('id'),
        ];
    }
}
