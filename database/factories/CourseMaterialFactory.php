<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $materialType = ['Preparation', 'Follow up'];
        $types = ['Video', 'PDF', 'Task', 'Quiz', 'Other'];
        $url = $this->faker->optional()->url();

        return [
            'material_type' => $this->faker->randomElement($materialType),
            'title' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement($types),
            'url' => $url,
            'pdf' => $url,
            'course_id' => Course::inRandomOrder()->value('id'),
        ];
    }
}
