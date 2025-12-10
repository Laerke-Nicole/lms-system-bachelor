<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SignatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->optional()->dateTimeBetween('-1 month', 'now');
        $certificate = \App\Models\Certificate::inRandomOrder()->first();

        return [
            'signature_image' => 'signatures/fake_signature.png',
            'signed_certificate_pdf' => null,
            'final_certificate_pdf' => 'certificates/final_fake.pdf',
            'signature_confirmed' => true,
            'signed_at' => $date,
            'certificate_id' => $certificate->id,
            'training_user_id' => $certificate->training_user_id,
        ];
    }
}
