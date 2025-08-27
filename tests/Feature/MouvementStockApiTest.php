<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MouvementStock;

class MouvementStockApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_mouvements_stock()
    {
        $response = $this->getJson('/api/mouvements-stock');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_mouvement_stock()
    {
        $mouvementStock = MouvementStock::factory()->create();

        $response = $this->getJson("/api/mouvements-stock/{$mouvementStock->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $mouvementStock->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_mouvement_stock()
    {
        $data = [
            // Add required fields for creation
        ];

        $response = $this->postJson('/api/mouvements-stock', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_mouvement_stock()
    {
        $mouvementStock = MouvementStock::factory()->create();

        $data = [
            // Add fields to update
        ];

        $response = $this->patchJson("/api/mouvements-stock/{$mouvementStock->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_mouvement_stock()
    {
        $mouvementStock = MouvementStock::factory()->create();

        $response = $this->deleteJson("/api/mouvements-stock/{$mouvementStock->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('mouvements_stock', ['id' => $mouvementStock->id]);
    }
}
