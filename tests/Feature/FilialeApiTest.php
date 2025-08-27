<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Filiale;

class FilialeApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_filiales()
    {
        $response = $this->getJson('/api/filiales');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_filiale()
    {
        $entreprise = \App\Models\Entreprise::factory()->create();
        $filiale = Filiale::factory()->create(['entreprise_id' => $entreprise->id]);

        $response = $this->getJson("/api/filiales/{$filiale->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $filiale->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_filiale()
    {
        $entreprise = \App\Models\Entreprise::factory()->create();

        $data = [
            'nom' => 'Filiale Test',
            'adresse' => '123 rue Filiale',
            'secteur_activite' => 'Secteur Test',
            'telephone' => '0123456789',
            'email' => 'filiale@test.com',
            'entreprise_id' => $entreprise->id,
        ];

        $response = $this->postJson('/api/filiales', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_filiale()
    {
        $entreprise = \App\Models\Entreprise::factory()->create();
        $filiale = Filiale::factory()->create(['entreprise_id' => $entreprise->id]);

        $data = [
            'nom' => 'Filiale Modifié',
        ];

        $response = $this->patchJson("/api/filiales/{$filiale->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_filiale()
    {
        $entreprise = \App\Models\Entreprise::factory()->create();
        $filiale = Filiale::factory()->create(['entreprise_id' => $entreprise->id]);

        $response = $this->deleteJson("/api/filiales/{$filiale->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('filiales', ['id' => $filiale->id]);
    }
}
