<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Company;
use App\Models\PostalCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyCrudTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Read
     */
    public function test_admin_can_view_companies_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this
            ->actingAs($admin)
            ->get(route('companies.index'));

        $response->assertStatus(200);
    }

    /**
     * Create
     */
    public function test_admin_can_create_company()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $data = [
            'company_name' => 'Test Company',
            'company_mail' => 'test@company.com',
            'company_phone' => '12345678',
            'street_name' => 'Test Street',
            'street_number' => '123',
            'postal_code' => '1000',
            'city' => 'Copenhagen',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->post(route('companies.store'), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('companies', [
            'company_name' => 'Test Company',
            'company_mail' => 'test@company.com',
        ]);
    }

    /**
     * Update
     */
    public function test_admin_can_update_company()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $company = Company::factory()->create(['address_id' => $address->id]);

        $data = [
            'company_name' => 'Updated Company',
            'company_mail' => 'updated@company.com',
            'company_phone' => '87654321',
            'street_name' => 'Updated Street',
            'street_number' => '456',
            'postal_code' => '2000',
            'city' => 'Frederiksberg',
            'country' => 'Denmark',
        ];

        $response = $this
            ->actingAs($admin)
            ->put(route('companies.update', $company), $data);

        $response->assertRedirect();

        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'company_name' => 'Updated Company',
            'company_mail' => 'updated@company.com',
        ]);
    }

    /**
     * Delete
     */
    public function test_admin_can_delete_company()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $postalCode = PostalCode::factory()->create();
        $address = Address::factory()->create(['postal_code_id' => $postalCode->id]);
        $company = Company::factory()->create(['address_id' => $address->id]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('companies.destroy', $company));

        $response->assertRedirect();

        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
        ]);
    }

    /**
     * Authentication test
     */
    public function test_leader_cannot_access_companies()
    {
        $leader = User::factory()->create(['role' => 'leader']);

        $response = $this
            ->actingAs($leader)
            ->get(route('companies.index'));

        $response->assertStatus(403);
    }
}
