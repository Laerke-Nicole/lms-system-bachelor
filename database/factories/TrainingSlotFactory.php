<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingSlot>
 */
class TrainingSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $places = ['Online', 'On site'];
        $statuses = ['Available', 'Unavailable'];

        return [
            'training_date' => $this->faker->dateTimeBetween('-1 month', '+1 months'),
            'place' => $this->faker->randomElement($places),
            'status' => $this->faker->randomElement($statuses),
            'participation_link' => $this->faker->url(),
            'course_id' => Course::inRandomOrder()->value('id'),
            'created_by_admin_id' => User::where('role', 'admin')->inRandomOrder()->value('id'),
            'trainer_id' => User::where('role', 'admin')->inRandomOrder()->value('id'),
        ];
    }
}
