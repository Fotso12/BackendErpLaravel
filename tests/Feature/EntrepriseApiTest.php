<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Entreprise;

class EntrepriseApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Optionally seed the database or create necessary data here
    }

    /** @test */
    public function it_can_list_entreprises()
    {
        Entreprise::factory()->count(3)->create();

        $response = $this->getJson('/api/entreprises');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_show_an_entreprise()
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->getJson("/api/entreprises/{$entreprise->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $entreprise->id,
                'nom' => $entreprise->nom,
                // Add other fields as needed
            ]);
    }

    /** @test */
    public function it_can_create_an_entreprise()
    {
        $data = [
            'nom' => 'Nouvelle Entreprise',
            'adresse' => '123 rue Exemple',
            'secteur_activite' => 'Informatique',
            'telephone' => '0123456789',
            'email' => 'contact@exemple.com',
        ];

        $response = $this->postJson('/api/entreprises', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['nom' => 'Nouvelle Entreprise']);

        $this->assertDatabaseHas('entreprises', ['nom' => 'Nouvelle Entreprise']);
    }

    /** @test */
    public function it_can_update_an_entreprise()
    {
        $entreprise = Entreprise::factory()->create();

        $data = [
            'nom' => 'Entreprise Modifiée',
            'adresse' => '456 rue Modifiée',
            'secteur_activite' => 'Services',
            'telephone' => '0987654321',
            'email' => 'modifie@exemple.com',
        ];

        $response = $this->patchJson("/api/entreprises/{$entreprise->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['nom' => 'Entreprise Modifiée']);

        $this->assertDatabaseHas('entreprises', ['id' => $entreprise->id, 'nom' => 'Entreprise Modifiée']);
    }

    /** @test */
    public function it_can_delete_an_entreprise()
    {
        $entreprise = Entreprise::factory()->create();

        $response = $this->deleteJson("/api/entreprises/{$entreprise->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('entreprises', ['id' => $entreprise->id]);
    }
}
