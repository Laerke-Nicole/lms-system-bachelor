<?php

namespace Database\Factories;

use App\Models\FollowUpTest;
use App\Models\User;
use App\Models\UserTestResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTestResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    //    specify the name of the table since Laravel would assume its called follow_up_test_user instead
    protected $model = UserTestResult::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'follow_up_test_id' => FollowUpTest::inRandomOrder()->value('id'),
            'is_passed' => $this->faker->boolean(70),
            'completed_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
