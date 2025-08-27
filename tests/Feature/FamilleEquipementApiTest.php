<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\FamilleEquipement;

class FamilleEquipementApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_familles_equipement()
    {
        $response = $this->getJson('/api/familles-equipement');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_famille_equipement()
    {
        $familleEquipement = FamilleEquipement::factory()->create();

        $response = $this->getJson("/api/familles-equipement/{$familleEquipement->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $familleEquipement->id,
                'nom' => $familleEquipement->nom,
                'description' => $familleEquipement->description,
                'actif' => $familleEquipement->actif,
            ]);
    }

    /** @test */
    public function it_can_create_a_famille_equipement()
    {
        $data = [
            'nom' => 'Famille Equipement Test',
        ];

        $response = $this->postJson('/api/familles-equipement', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_famille_equipement()
    {
        $familleEquipement = FamilleEquipement::factory()->create();

        $data = [
            'nom' => 'Famille Equipement Modifié',
        ];

        $response = $this->patchJson("/api/familles-equipement/{$familleEquipement->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_famille_equipement()
    {
        $familleEquipement = FamilleEquipement::factory()->create();

        $response = $this->deleteJson("/api/familles-equipement/{$familleEquipement->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('famille_equipements', ['id' => $familleEquipement->id]);
    }
}
