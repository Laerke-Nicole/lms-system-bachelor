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
        $places = ['online', 'on_site'];
        $statuses = ['upcoming', 'completed', 'expired'];

        return [
            'place' => $this->faker->randomElement($places),
            'status' => $this->faker->randomElement($statuses),
            'training_time' => $this->faker->time(),
            'training_date' => $this->faker->dateTimeBetween('-6 months', '+6 months'),
            'participation_link' => $this->faker->url(),
            'reminder_sent_18_m' => $this->faker->boolean(30),
            'reminder_sent_22_m' => $this->faker->boolean(20),
            'reminder_before_training' => $this->faker->optional()->dateTimeBetween('-1 month', '+1 month'),
            'extra_comments' => $this->faker->optional()->paragraph(),
            'course_id' => Course::inRandomOrder()->value('id'),
            'ordered_by_id' => User::inRandomOrder()->value('id'),
            'trainer_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
