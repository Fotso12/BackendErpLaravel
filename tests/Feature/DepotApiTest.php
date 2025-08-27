<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Depot;

class DepotApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_depots()
    {
        $response = $this->getJson('/api/depots');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_depot()
    {
        // Création de l'entité parente entreprise
        $entreprise = \App\Models\Entreprise::factory()->create();

        $depot = Depot::factory()->create([
            'entreprise_id' => $entreprise->id,
        ]);

        $response = $this->getJson("/api/depots/{$depot->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $depot->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_depot()
    {
        // Création de l'entité parente entreprise
        $entreprise = \App\Models\Entreprise::factory()->create();

        $data = [
            'nom' => 'Depot Test',
            'adresse' => '123 rue de test',
            'entreprise_id' => $entreprise->id,
            'actif' => true,
        ];

        $response = $this->postJson('/api/depots', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_depot()
    {
        // Création de l'entité parente entreprise
        $entreprise = \App\Models\Entreprise::factory()->create();

        $depot = Depot::factory()->create([
            'entreprise_id' => $entreprise->id,
        ]);

        $data = [
            'nom' => 'Depot Modifié',
            'adresse' => '456 rue modifiée',
        ];

        $response = $this->patchJson("/api/depots/{$depot->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_depot()
    {
        // Création de l'entité parente entreprise
        $entreprise = \App\Models\Entreprise::factory()->create();

        $depot = Depot::factory()->create([
            'entreprise_id' => $entreprise->id,
        ]);

        $response = $this->deleteJson("/api/depots/{$depot->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('depots', ['id' => $depot->id]);
    }
}
