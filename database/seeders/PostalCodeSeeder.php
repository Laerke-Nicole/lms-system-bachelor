<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostalCode;

class PostalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        PostalCode::updateOrCreate(
            ['postal_code' => '7430'],
            [
                'city' => 'Ikast',
                'country' => 'Denmark',
            ]
        );
    }
}
