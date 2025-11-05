<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ['invitation', 'reminder_before_training', 'reminder_18_m', 'reminder_19_m', 'reminder_22_m', 'certificate'];

        return [
            'send_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'type' => $this->faker->randomElement($types),
            'subject' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'sender_id' => User::inRandomOrder()->value('id'),
            'recipient_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
