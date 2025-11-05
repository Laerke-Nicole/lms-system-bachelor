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
            'duration_months' => 24,
            'image' => 'images/operator.png',
        ]);

        $maintenance = Course::create([
            'title' => 'Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration_months' => 24,
            'image' => 'images/maintenance.jpg',
        ]);

        $advancedMaintenance = Course::create([
            'title' => 'Advanced Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration_months' => 24,
            'image' => 'images/advanced_maintenance.jpg',
        ]);

        $engineerRecipe = Course::create([
            'title' => 'Engineer/recipe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration_months' => 24,
            'image' => 'images/engineer.jpg',
        ]);

        return [
            $operator,
            $maintenance,
            $advancedMaintenance,
            $engineerRecipe,
        ];
    }
}
