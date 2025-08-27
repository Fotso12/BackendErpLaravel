<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Client;
use App\Models\Entreprise;

class ClientApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_clients()
    {
        $response = $this->getJson('/api/clients');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_client()
    {
        $entreprise = Entreprise::factory()->create();
        $client = Client::factory()->create(['entreprise_id' => $entreprise->id]);

        $response = $this->getJson("/api/clients/{$client->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $client->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_client()
    {
        $entreprise = Entreprise::factory()->create();

        $data = [
            'nom' => 'Client Test',
            'adresse' => '123 rue de Test',
            'telephone' => '0123456789',
            'email' => 'client@test.com',
            'entreprise_id' => $entreprise->id,
        ];

        $response = $this->postJson('/api/clients', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_client()
    {
        $entreprise = Entreprise::factory()->create();
        $client = Client::factory()->create(['entreprise_id' => $entreprise->id]);

        $data = [
            'nom' => 'Client Modifié',
        ];

        $response = $this->patchJson("/api/clients/{$client->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_client()
    {
        $entreprise = Entreprise::factory()->create();
        $client = Client::factory()->create(['entreprise_id' => $entreprise->id]);

        $response = $this->deleteJson("/api/clients/{$client->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }
}
