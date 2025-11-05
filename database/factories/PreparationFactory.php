<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreparationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['quiz', 'task'];

        return [
            'title' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement($types),
            'url' => $this->faker->url(),
            'course_id' => Course::inRandomOrder()->value('id'),
        ];
    }
}
