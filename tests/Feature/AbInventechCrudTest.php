<?php

namespace Tests\Feature;

use App\Models\AbInventech;
use App\Models\Address;
use App\Models\PostalCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AbInventechCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Read
     */
    public function test_admin_can_view_ab_inventech_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this
            ->actingAs($admin)
            ->get(route('ab_inventech.index'));

        $response->assertStatus(200);
    }

    /**
     * Create
     */
    public function test_admin_can_create_ab_inventech()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'ab_inventech_name' => 'Test AB Inventech',
            'ab_inventech_web' => 'https://test-abinventech.com',
            'ab_inventech_mail' => 'test@abinventech.com',
            'ab_inventech_phone' => '12345678',
            'street_name' => 'Test Street',
            'street_number' => '123',
            'postal_code' => '1000',
            'city' => 'Copenhagen',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('ab_inventech.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('ab_inventech', [
            'ab_inventech_name' => 'Test AB Inventech',
            'ab_inventech_mail' => 'test@abinventech.com',
        ]);
    }

    /**
     * Create with logo
     */
    public function test_admin_can_create_ab_inventech_with_logo()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'ab_inventech_name' => 'Test AB Inventech',
            'ab_inventech_web' => 'https://test-abinventech.com',
            'ab_inventech_mail' => 'test@abinventech.com',
            'ab_inventech_phone' => '12345678',
            'logo' => UploadedFile::fake()->image('logo.png'),
            'street_name' => 'Test Street',
            'street_number' => '123',
            'postal_code' => '1000',
            'city' => 'Copenhagen',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('ab_inventech.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('ab_inventech', [
            'ab_inventech_name' => 'Test AB Inventech',
            'ab_inventech_mail' => 'test@abinventech.com',
        ]);

        $abInventech = AbInventech::where('ab_inventech_mail', 'test@abinventech.com')->first();
        Storage::disk('public')->assertExists($abInventech->logo);
    }

    /**
     * Update
     */
    public function test_admin_can_update_ab_inventech()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $abInventech = AbInventech::factory()->create(['address_id' => $address->id]);

        $data = [
            'ab_inventech_name' => 'Updated AB Inventech',
            'ab_inventech_web' => 'https://updated-abinventech.com',
            'ab_inventech_mail' => 'updated@abinventech.com',
            'ab_inventech_phone' => '87654321',
            'street_name' => 'Updated Street',
            'street_number' => '456',
            'postal_code' => '2000',
            'city' => 'Frederiksberg',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('ab_inventech.update', $abInventech), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('ab_inventech', [
            'id' => $abInventech->id,
            'ab_inventech_name' => 'Updated AB Inventech',
            'ab_inventech_mail' => 'updated@abinventech.com',
        ]);
    }

    /**
     * Update with logo
     */
    public function test_admin_can_update_ab_inventech_with_new_logo()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $abInventech = AbInventech::factory()->create([
            'address_id' => $address->id,
            'logo' => 'ab_inventech/old-logo.png',
        ]);

        Storage::disk('public')->put('ab_inventech/old-logo.png', 'old logo content');

        $data = [
            'ab_inventech_name' => 'Updated AB Inventech',
            'ab_inventech_web' => 'https://updated-abinventech.com',
            'ab_inventech_mail' => 'updated@abinventech.com',
            'ab_inventech_phone' => '87654321',
            'logo' => UploadedFile::fake()->image('new-logo.png'),
            'street_name' => 'Updated Street',
            'street_number' => '456',
            'postal_code' => '2000',
            'city' => 'Frederiksberg',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('ab_inventech.update', $abInventech), $data);

        $response->assertRedirect();

        $abInventech->refresh();
        Storage::disk('public')->assertExists($abInventech->logo);
        Storage::disk('public')->assertMissing('ab_inventech/old-logo.png');
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_ab_inventech()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $abInventech = AbInventech::factory()->create(['address_id' => $address->id]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('ab_inventech.destroy', $abInventech));

        $response->assertRedirect();

        $this->assertDatabaseMissing('ab_inventech', [
            'id' => $abInventech->id,
        ]);
    }

    /**
     * Delete with logo
     */
    public function test_admin_can_delete_ab_inventech_with_logo()
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $abInventech = AbInventech::factory()->create([
            'address_id' => $address->id,
            'logo' => 'ab_inventech/logo.png',
        ]);

        Storage::disk('public')->put('ab_inventech/logo.png', 'logo content');

        $response = $this
            ->actingAs($admin)
            ->delete(route('ab_inventech.destroy', $abInventech));

        $response->assertRedirect();

        $this->assertDatabaseMissing('ab_inventech', [
            'id' => $abInventech->id,
        ]);

        Storage::disk('public')->assertMissing('ab_inventech/logo.png');
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_ab_inventech()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('ab_inventech.index'));

        $response->assertStatus(403);
    }
}
