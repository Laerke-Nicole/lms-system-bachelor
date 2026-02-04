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
    protected static array $usedCombinations = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $places = ['Online', 'On site'];
        $statuses = ['Available', 'Unavailable'];

        $courseId = Course::inRandomOrder()->value('id');
        $dateTime = $this->faker->dateTimeBetween('now', '+3 months');
        $trainingDay = $dateTime->format('Y-m-d');

        $maxAttempts = 100;
        $attempts = 0;
        while (isset(static::$usedCombinations[$courseId . '-' . $trainingDay]) && $attempts < $maxAttempts) {
            $dateTime = $this->faker->dateTimeBetween('now', '+3 months');
            $trainingDay = $dateTime->format('Y-m-d');
            $attempts++;
        }

        static::$usedCombinations[$courseId . '-' . $trainingDay] = true;

        return [
            'training_date' => $dateTime,
            'training_day'  => $trainingDay,
            'place' => $this->faker->randomElement($places),
            'status' => $this->faker->randomElement($statuses),
            'participation_link' => $this->faker->url(),
            'course_id' => $courseId,
            'created_by_admin_id' => User::where('role', 'admin')->inRandomOrder()->value('id'),
            'trainer_id' => User::where('role', 'admin')->inRandomOrder()->value('id'),
        ];
    }
}
