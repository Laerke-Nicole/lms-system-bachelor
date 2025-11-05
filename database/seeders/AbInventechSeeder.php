<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\AbInventech;
use App\Models\Address;

class AbInventechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = Address::where('street_name', 'Eli Christensensvej')->first();

        $abInventech = new AbInventech([
            'ab_inventech_name'  => 'AbInventech',
            'ab_inventech_web'   => 'https://www.ab-inventech.dk/',
            'ab_inventech_mail'  => 'mail@ab-inventech.dk',
            'ab_inventech_phone' => '+45 97 15 50 22',
            'logo' => 'logos/ab_inventech.png',
            'address_id' => $address->id,
        ]);
        $abInventech->save();
    }
}
