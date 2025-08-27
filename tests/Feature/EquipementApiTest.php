<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Equipement;

class EquipementApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_equipements()
    {
        $response = $this->getJson('/api/equipements');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_an_equipement()
    {
        $equipement = Equipement::factory()->create();

        $response = $this->getJson("/api/equipements/{$equipement->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $equipement->id,
            ]);
    }

    /** @test */
    public function it_can_create_an_equipement()
    {
        $fournisseur = \App\Models\Fournisseur::factory()->create();

        $data = [
            'nom' => 'Equipement Test',
            'type' => 'Type Test',
            'fournisseur_id' => $fournisseur->id,
        ];

        $response = $this->postJson('/api/equipements', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_an_equipement()
    {
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $data = [
            'nom' => 'Equipement Modifié',
            'fournisseur_id' => $fournisseur->id,
        ];

        $response = $this->patchJson("/api/equipements/{$equipement->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_an_equipement()
    {
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $response = $this->deleteJson("/api/equipements/{$equipement->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('equipements', ['id' => $equipement->id]);
    }
}
