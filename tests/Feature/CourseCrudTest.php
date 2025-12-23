<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Evaluation;
use App\Models\FollowUpTest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Read
     */
    public function test_admin_can_view_courses_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this
            ->actingAs($admin)
            ->get(route('courses.index'));

        $response->assertStatus(200);
    }

    /**
     * Create
     */
    public function test_admin_can_create_course()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'title' => 'Test Course',
            'description' => 'This is a test course description.',
            'duration' => 4,
            'duration_months' => 12,
            'max_participants' => 20,
            'evaluation_link' => 'https://example.com/evaluation',
            'test_link' => 'https://example.com/test',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('courses.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('courses', [
            'title' => 'Test Course',
        ]);

        $this->assertDatabaseHas('evaluations', [
            'evaluation_link' => 'https://example.com/evaluation',
        ]);

        $this->assertDatabaseHas('follow_up_tests', [
            'test_link' => 'https://example.com/test',
        ]);
    }

    /**
     * Create with image
     */
    public function test_admin_can_create_course_with_image()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'title' => 'Test Course with Image',
            'description' => 'This is a test course description.',
            'duration' => 4,
            'duration_months' => 12,
            'max_participants' => 20,
            'evaluation_link' => 'https://example.com/evaluation',
            'test_link' => 'https://example.com/test',
            'image' => UploadedFile::fake()->image('course.jpg'),
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('courses.store'), $data);

        $response->assertRedirect();

        $course = Course::where('title', 'Test Course with Image')->first();
        $this->assertNotNull($course->image);
        Storage::disk('public')->assertExists($course->image);
    }

    /**
     * Update
     */
    public function test_admin_can_update_course()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $evaluation = Evaluation::factory()->create();
        $followUpTest = FollowUpTest::factory()->create();
        $course = Course::factory()->create([
            'evaluation_id' => $evaluation->id,
            'follow_up_test_id' => $followUpTest->id,
        ]);

        $data = [
            'title' => 'Updated Course',
            'description' => 'Updated description.',
            'duration' => 6,
            'duration_months' => 24,
            'max_participants' => 15,
            'evaluation_link' => 'https://example.com/updated-evaluation',
            'test_link' => 'https://example.com/updated-test',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('courses.update', $course), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'title' => 'Updated Course',
        ]);

        $this->assertDatabaseHas('evaluations', [
            'id' => $evaluation->id,
            'evaluation_link' => 'https://example.com/updated-evaluation',
        ]);

        $this->assertDatabaseHas('follow_up_tests', [
            'id' => $followUpTest->id,
            'test_link' => 'https://example.com/updated-test',
        ]);
    }

    /**
     * Update with image
     */
    public function test_admin_can_update_course_with_new_image()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $evaluation = Evaluation::factory()->create();
        $followUpTest = FollowUpTest::factory()->create();
        $course = Course::factory()->create([
            'evaluation_id' => $evaluation->id,
            'follow_up_test_id' => $followUpTest->id,
            'image' => 'courses/old-image.jpg',
        ]);

        Storage::disk('public')->put('courses/old-image.jpg', 'old image content');

        $data = [
            'title' => 'Updated Course',
            'description' => 'Updated description.',
            'duration' => 6,
            'duration_months' => 24,
            'max_participants' => 15,
            'evaluation_link' => 'https://example.com/updated-evaluation',
            'test_link' => 'https://example.com/updated-test',
            'image' => UploadedFile::fake()->image('new-image.jpg'),
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('courses.update', $course), $data);

        $response->assertRedirect();

        $course->refresh();
        Storage::disk('public')->assertExists($course->image);
        Storage::disk('public')->assertMissing('courses/old-image.jpg');
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_course()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $evaluation = Evaluation::factory()->create();
        $followUpTest = FollowUpTest::factory()->create();
        $course = Course::factory()->create([
            'evaluation_id' => $evaluation->id,
            'follow_up_test_id' => $followUpTest->id,
        ]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('courses.destroy', $course));

        $response->assertRedirect();

        $this->assertDatabaseMissing('courses', [
            'id' => $course->id,
        ]);
    }

    /**
     * Delete with image
     */
    public function test_admin_can_delete_course_with_image()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $evaluation = Evaluation::factory()->create();
        $followUpTest = FollowUpTest::factory()->create();
        $course = Course::factory()->create([
            'evaluation_id' => $evaluation->id,
            'follow_up_test_id' => $followUpTest->id,
            'image' => 'courses/image.jpg',
        ]);

        Storage::disk('public')->put('courses/image.jpg', 'image content');

        $response = $this
            ->actingAs($admin)
            ->delete(route('courses.destroy', $course));

        $response->assertRedirect();

        $this->assertDatabaseMissing('courses', [
            'id' => $course->id,
        ]);

        Storage::disk('public')->assertMissing('courses/image.jpg');
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_courses()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('courses.index'));

        $response->assertStatus(403);
    }
}
