<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Facture;

class FactureApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_factures()
    {
        $response = $this->getJson('/api/factures');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_facture()
    {
        $facture = Facture::factory()->create();

        $response = $this->getJson("/api/factures/{$facture->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $facture->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_facture()
    {
        $data = [
            // Add required fields for creation
        ];

        $response = $this->postJson('/api/factures', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_facture()
    {
        $facture = Facture::factory()->create();

        $data = [
            // Add fields to update
        ];

        $response = $this->patchJson("/api/factures/{$facture->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_facture()
    {
        $facture = Facture::factory()->create();

        $response = $this->deleteJson("/api/factures/{$facture->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('factures', ['id' => $facture->id]);
    }
}
