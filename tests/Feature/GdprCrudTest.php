<?php

namespace Tests\Feature;

use App\Models\Gdpr;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GdprCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Read
     */
    public function test_admin_can_view_gdprs_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this
            ->actingAs($admin)
            ->get(route('gdprs.index'));

        $response->assertStatus(200);
    }

    /**
     * Create
     */
    public function test_admin_can_create_gdpr()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'title' => 'Test GDPR Policy',
            'content' => 'This is the content of the GDPR policy.',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('gdprs.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('gdprs', [
            'title' => 'Test GDPR Policy',
        ]);
    }

    /**
     * Update
     */
    public function test_admin_can_update_gdpr()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $gdpr = Gdpr::factory()->create();

        $data = [
            'title' => 'Updated GDPR Policy',
            'content' => 'This is the updated content.',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('gdprs.update', $gdpr), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('gdprs', [
            'id' => $gdpr->id,
            'title' => 'Updated GDPR Policy',
        ]);
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_gdpr()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $gdpr = Gdpr::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->delete(route('gdprs.destroy', $gdpr));

        $response->assertRedirect();

        $this->assertDatabaseMissing('gdprs', [
            'id' => $gdpr->id,
        ]);
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_gdprs()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('gdprs.index'));

        $response->assertStatus(403);
    }
}
