<?php

namespace Tests\Feature;

use App\Models\FollowUpTest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowUpTestCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create
     */
    public function test_admin_can_create_follow_up_test()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'test_link' => 'https://example.com/test',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('follow_up_tests.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('follow_up_tests', [
            'test_link' => 'https://example.com/test',
        ]);
    }

    /**
     * Update
     */
    public function test_admin_can_update_follow_up_test()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $followUpTest = FollowUpTest::factory()->create();

        $data = [
            'test_link' => 'https://example.com/updated-test',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('follow_up_tests.update', $followUpTest), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('follow_up_tests', [
            'id' => $followUpTest->id,
            'test_link' => 'https://example.com/updated-test',
        ]);
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_follow_up_test()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $followUpTest = FollowUpTest::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->delete(route('follow_up_tests.destroy', $followUpTest));

        $response->assertRedirect();

        $this->assertDatabaseMissing('follow_up_tests', [
            'id' => $followUpTest->id,
        ]);
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_follow_up_tests()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('follow_up_tests.index'));

        $response->assertStatus(403);
    }
}
