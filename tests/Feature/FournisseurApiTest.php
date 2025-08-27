<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Fournisseur;

class FournisseurApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_fournisseurs()
    {
        $response = $this->getJson('/api/fournisseurs');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_fournisseur()
    {
        $fournisseur = Fournisseur::factory()->create();

        $response = $this->getJson("/api/fournisseurs/{$fournisseur->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $fournisseur->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_fournisseur()
    {
        $data = [
            'nom' => 'Fournisseur Test',
            'adresse' => '123 rue Fournisseur',
            'telephone' => '0123456789',
            'email' => 'fournisseur@test.com',
        ];

        $response = $this->postJson('/api/fournisseurs', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_fournisseur()
    {
        $fournisseur = Fournisseur::factory()->create();

        $data = [
            'nom' => 'Fournisseur Modifié',
        ];

        $response = $this->patchJson("/api/fournisseurs/{$fournisseur->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_fournisseur()
    {
        $fournisseur = Fournisseur::factory()->create();

        $response = $this->deleteJson("/api/fournisseurs/{$fournisseur->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('fournisseurs', ['id' => $fournisseur->id]);
    }
}
