<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\PostalCode;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $postal = PostalCode::where('postal_code', '7430')->firstOrFail();

        Address::updateOrCreate(
            [
                'street_name' => 'Eli Christensensvej',
                'street_number' => '76-84',
            ],
            [
                'postal_code_id' => $postal->id,
            ]
        );
    }
}
