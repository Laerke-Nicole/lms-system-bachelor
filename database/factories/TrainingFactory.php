<?php

namespace Database\Factories;

use App\Models\TrainingSlot;
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
        $statuses = ['Pending', 'Upcoming', 'Completed', 'Expiring'];

        $status = $this->faker->randomElement($statuses);

        return [
            'status' => $status,
            'reminder_sent_18_m' => in_array($status, ['Completed', 'Expiring']) && $this->faker->boolean(30),
            'reminder_before_training' => $status === 'Upcoming' ? $this->faker->optional()->dateTimeBetween('-1 month', '+1 month') : null,
            'completed_at' => $status === 'Completed' ? $this->faker->dateTimeBetween('-2 years', '+2 years') : null,
            'ordered_by_id' => User::where('role', 'leader')->inRandomOrder()->value('id'),
            'training_slot_id' => TrainingSlot::inRandomOrder()->value('id'),
        ];
    }
}
