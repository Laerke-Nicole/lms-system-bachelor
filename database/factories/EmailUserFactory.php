<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Email;
use App\Models\EmailUser;

class EmailUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = EmailUser::class;


    public function definition()
    {
        return [
            'user_id'  => User::inRandomOrder()->value('id'),
            'email_id' => Email::inRandomOrder()->value('id'),
        ];
    }
}
