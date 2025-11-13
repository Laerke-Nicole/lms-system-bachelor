<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $places = ['Online', 'On site'];

        $statuses = ['Upcoming', 'Completed', 'Expired'];

        $status = $this->faker->randomElement($statuses);

        return [
            'place' => $this->faker->randomElement($places),
            'status' => $status,
            'training_date' => $this->faker->dateTimeBetween('-6 months', '+6 months'),
            'participation_link' => $this->faker->url(),

            'reminder_sent_18_m' => in_array($status, ['Completed', 'Expired']) && $this->faker->boolean(30),
            'reminder_sent_22_m' => in_array($status, ['Completed', 'Expired']) && $this->faker->boolean(10),
            'reminder_before_training' => $status === 'Upcoming' ? $this->faker->optional()->dateTimeBetween('-1 month', '+1 month') : null,

            'course_id' => Course::inRandomOrder()->value('id'),
            'ordered_by_id' => User::inRandomOrder()->value('id'),
            'trainer_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
