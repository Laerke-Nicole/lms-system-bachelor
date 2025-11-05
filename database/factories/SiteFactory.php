<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_name' => $this->faker->company() . ' - ' . $this->faker->city(),
            'site_mail' => $this->faker->unique()->companyEmail(),
            'site_phone' => $this->faker->unique()->phoneNumber(),
            'company_id' => Company::inRandomOrder()->value('id'),
        ];
    }
}
