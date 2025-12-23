<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Company;
use App\Models\PostalCode;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SiteCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Read
     */
    public function test_admin_can_view_sites_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this
            ->actingAs($admin)
            ->get(route('sites.index'));

        $response->assertStatus(200);
    }

    /**
     * Create
     */
    public function test_admin_can_create_site()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $company = Company::factory()->create(['address_id' => $address->id]);

        $data = [
            'site_name' => 'Test Site',
            'site_mail' => 'test@site.com',
            'site_phone' => '12345678',
            'company_id' => $company->id,
            'street_name' => 'Test Street',
            'street_number' => '123',
            'postal_code' => '1000',
            'city' => 'Copenhagen',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('sites.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('sites', [
            'site_name' => 'Test Site',
            'site_mail' => 'test@site.com',
            'company_id' => $company->id,
        ]);
    }

    /**
     * Update
     */
    public function test_admin_can_update_site()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $company = Company::factory()->create(['address_id' => $address->id]);

        $sitePostalCode = PostalCode::factory()->create();
        $siteAddress = Address::factory()->create(['postal_code_id' => $sitePostalCode->id]);
        $site = Site::factory()->create([
            'company_id' => $company->id,
            'address_id' => $siteAddress->id,
        ]);

        $data = [
            'site_name' => 'Updated Site',
            'site_mail' => 'updated@site.com',
            'site_phone' => '87654321',
            'street_name' => 'Updated Street',
            'street_number' => '456',
            'postal_code' => '2000',
            'city' => 'Frederiksberg',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('sites.update', $site), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('sites', [
            'id' => $site->id,
            'site_name' => 'Updated Site',
            'site_mail' => 'updated@site.com',
        ]);
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_site()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $company = Company::factory()->create(['address_id' => $address->id]);

        $sitePostalCode = PostalCode::factory()->create();
        $siteAddress = Address::factory()->create(['postal_code_id' => $sitePostalCode->id]);
        $site = Site::factory()->create([
            'company_id' => $company->id,
            'address_id' => $siteAddress->id,
        ]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('sites.destroy', $site));

        $response->assertRedirect();

        $this->assertDatabaseMissing('sites', [
            'id' => $site->id,
        ]);
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_sites()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('sites.index'));

        $response->assertStatus(403);
    }
}
