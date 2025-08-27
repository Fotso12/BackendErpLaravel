<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\EntreeStock;

class EntreeStockApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_entrees_stock()
    {
        $response = $this->getJson('/api/entrees-stock');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_an_entree_stock()
    {
        // Création des entités parentes nécessaires
        $entreprise = \App\Models\Entreprise::factory()->create();
        $depot = \App\Models\Depot::factory()->create(['entreprise_id' => $entreprise->id]);
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $entreeStock = EntreeStock::factory()->create([
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
        ]);

        $response = $this->getJson("/api/entrees-stock/{$entreeStock->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $entreeStock->id,
            ]);
    }

    /** @test */
    public function it_can_create_an_entree_stock()
    {
        // Création des entités parentes nécessaires
        $entreprise = \App\Models\Entreprise::factory()->create();
        $depot = \App\Models\Depot::factory()->create(['entreprise_id' => $entreprise->id]);
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $data = [
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
            'quantite' => 5,
            'date_entree' => now()->toDateString(),
        ];

        $response = $this->postJson('/api/entrees-stock', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_an_entree_stock()
    {
        // Création des entités parentes nécessaires
        $entreprise = \App\Models\Entreprise::factory()->create();
        $depot = \App\Models\Depot::factory()->create(['entreprise_id' => $entreprise->id]);
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $entreeStock = EntreeStock::factory()->create([
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
        ]);

        $data = [
            'quantite' => 10,
            'date_entree' => now()->addDay()->toDateString(),
        ];

        $response = $this->patchJson("/api/entrees-stock/{$entreeStock->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_an_entree_stock()
    {
        // Création des entités parentes nécessaires
        $entreprise = \App\Models\Entreprise::factory()->create();
        $depot = \App\Models\Depot::factory()->create(['entreprise_id' => $entreprise->id]);
        $fournisseur = \App\Models\Fournisseur::factory()->create();
        $equipement = \App\Models\Equipement::factory()->create(['fournisseur_id' => $fournisseur->id]);

        $entreeStock = EntreeStock::factory()->create([
            'depot_id' => $depot->id,
            'equipement_id' => $equipement->id,
        ]);

        $response = $this->deleteJson("/api/entrees-stock/{$entreeStock->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('entrees_stock', ['id' => $entreeStock->id]);
    }
}
