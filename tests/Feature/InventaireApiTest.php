<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Inventaire;

class InventaireApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_inventaires()
    {
        $response = $this->getJson('/api/inventaires');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_an_inventaire()
    {
        $inventaire = Inventaire::factory()->create();

        $response = $this->getJson("/api/inventaires/{$inventaire->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $inventaire->id,
            ]);
    }

    /** @test */
    public function it_can_create_an_inventaire()
    {
        // Création des entités parentes nécessaires
        $depot = \App\Models\Depot::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create();

        $data = [
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
            'quantite' => 10,
            'date_inventaire' => now()->toDateString(),
        ];

        $response = $this->postJson('/api/inventaires', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_an_inventaire()
    {
        // Création des entités parentes nécessaires
        $depot = \App\Models\Depot::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create();

        $inventaire = Inventaire::factory()->create([
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
        ]);

        $data = [
            'quantite' => 20,
            'date_inventaire' => now()->addDay()->toDateString(),
        ];

        $response = $this->patchJson("/api/inventaires/{$inventaire->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_an_inventaire()
    {
        $inventaire = Inventaire::factory()->create();

        $response = $this->deleteJson("/api/inventaires/{$inventaire->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('inventaires', ['id' => $inventaire->id]);
    }
}
