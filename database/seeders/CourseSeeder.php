<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Evaluation;
use App\Models\FollowUpTest;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Operator Course
        $operatorEvaluation = Evaluation::create([
            'evaluation_link' => 'https://example.com/evaluation/operator',
        ]);

        $operatorTest = FollowUpTest::create([
            'test_link' => 'https://example.com/test/operator',
        ]);

        Course::create([
            'title' => 'Operator',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 5,
            'evaluation_id' => $operatorEvaluation->id,
            'follow_up_test_id' => $operatorTest->id,
            'image' => 'storage/courses/operator.png',
        ]);

        // Maintenance Course
        $maintenanceEvaluation = Evaluation::create([
            'evaluation_link' => 'https://example.com/evaluation/maintenance',
        ]);

        $maintenanceTest = FollowUpTest::create([
            'test_link' => 'https://example.com/test/maintenance',
        ]);

        Course::create([
            'title' => 'Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 4,
            'evaluation_id' => $maintenanceEvaluation->id,
            'follow_up_test_id' => $maintenanceTest->id,
            'image' => 'storage/courses/maintenance.png',
        ]);

        // Advanced Maintenance Course
        $advancedMaintenanceEvaluation = Evaluation::create([
            'evaluation_link' => 'https://example.com/evaluation/advanced-maintenance',
        ]);

        $advancedMaintenanceTest = FollowUpTest::create([
            'test_link' => 'https://example.com/test/advanced-maintenance',
        ]);

        Course::create([
            'title' => 'Advanced Maintenance',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 4,
            'evaluation_id' => $advancedMaintenanceEvaluation->id,
            'follow_up_test_id' => $advancedMaintenanceTest->id,
            'image' => 'storage/courses/advanced_maintenance.jpg',
        ]);

        // Engineer/recipe Course
        $engineerEvaluation = Evaluation::create([
            'evaluation_link' => 'https://example.com/evaluation/engineer',
        ]);

        $engineerTest = FollowUpTest::create([
            'test_link' => 'https://example.com/test/engineer',
        ]);

        Course::create([
            'title' => 'Engineer/recipe',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'duration' => 8,
            'duration_months' => 24,
            'max_participants' => 5,
            'evaluation_id' => $engineerEvaluation->id,
            'follow_up_test_id' => $engineerTest->id,
            'image' => 'storage/courses/engineer.jpg',
        ]);
    }
}
