<?php

namespace Tests\Feature;

use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluationCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create
     */
    public function test_admin_can_create_evaluation()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'title' => 'Test Evaluation',
            'evaluation_link' => 'https://example.com/evaluation',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('evaluations.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('evaluations', [
            'evaluation_link' => 'https://example.com/evaluation',
        ]);
    }

    /**
     * Update
     */
    public function test_admin_can_update_evaluation()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $evaluation = Evaluation::factory()->create();

        $data = [
            'title' => 'Updated Evaluation',
            'evaluation_link' => 'https://example.com/updated-evaluation',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('evaluations.update', $evaluation), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('evaluations', [
            'id' => $evaluation->id,
            'evaluation_link' => 'https://example.com/updated-evaluation',
        ]);
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_evaluation()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $evaluation = Evaluation::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->delete(route('evaluations.destroy', $evaluation));

        $response->assertRedirect();

        $this->assertDatabaseMissing('evaluations', [
            'id' => $evaluation->id,
        ]);
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_evaluations()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('evaluations.index'));

        $response->assertStatus(403);
    }
}
