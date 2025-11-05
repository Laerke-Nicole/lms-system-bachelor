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
        $postalCode = PostalCode::create([
            'postal_code' => '7430',
            'city'        => 'Ikast',
            'country'     => 'Denmark',
        ]);

        return $postalCode;
    }
}
