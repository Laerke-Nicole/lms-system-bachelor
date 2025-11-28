<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'title' => 'Operator',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 5,
            'image' => 'storage/courses/operator.png',
        ]);

        Course::create([
            'title' => 'Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 4,
            'image' => 'storage/courses/maintenance.png',
        ]);

        Course::create([
            'title' => 'Advanced Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 4,
            'image' => 'storage/courses/advanced_maintenance.jpg',
        ]);

        Course::create([
            'title' => 'Engineer/recipe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 5,
            'image' => 'storage/courses/engineer.jpg',
        ]);
    }
}
