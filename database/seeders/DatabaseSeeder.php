<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\CourseMaterial;
use App\Models\Email;
use App\Models\EmailUser;
use App\Models\Evaluation;
use App\Models\FollowUpTest;
use App\Models\PostalCode;
use App\Models\Requirement;
use App\Models\Site;
use App\Models\Training;
use App\Models\TrainingSlot;
use App\Models\TrainingUser;
use App\Models\User;
use Database\Factories\SignatureFactory;
use Database\Factories\UserTestResultFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PostalCode::factory(30)->create();
        Address::factory(50)->create();
        Company::factory(4)->create();
        Site::factory(5)->create();
        User::factory(300)->create();
        Email::factory(20)->create();
        $this->call(CourseSeeder::class);
        Evaluation::factory(20)->create();
        FollowUpTest::factory(4)->create();
        TrainingSlot::factory(50)->create();
        Training::factory(3)->create();
        Certificate::factory(10)->create();
        CourseMaterial::factory(20)->create();
        Requirement::factory(10)->create();
        SignatureFactory::new()->count(50)->create();
        UserTestResultFactory::new()->count(50)->create();
        EmailUser::factory(100)->create();
        TrainingUser::factory(100)->create();

        //  seeders
        $this->call([
            PostalCodeSeeder::class,
            AddressSeeder::class,
            AbInventechSeeder::class,
            GdprSeeder::class,
        ]);
    }
}
