<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $operator = Course::create([
            'title' => 'Operator',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'image' => 'courses/operator.png',
        ]);

        $maintenance = Course::create([
            'title' => 'Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'image' => 'courses/maintenance.jpg',
        ]);

        $advancedMaintenance = Course::create([
            'title' => 'Advanced Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'image' => 'courses/advanced_maintenance.jpg',
        ]);

        $engineerRecipe = Course::create([
            'title' => 'Engineer/recipe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'image' => 'courses/engineer.jpg',
        ]);

        return [
            $operator,
            $maintenance,
            $advancedMaintenance,
            $engineerRecipe,
        ];
    }
}
