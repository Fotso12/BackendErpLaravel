<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Utilisateur;
use App\Models\Role;

class UtilisateurApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_utilisateurs()
    {
        $response = $this->getJson('/api/utilisateurs');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_an_utilisateur()
    {
        $role = Role::factory()->create();
        $utilisateur = Utilisateur::factory()->create(['role_id' => $role->id]);

        $response = $this->getJson("/api/utilisateurs/{$utilisateur->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $utilisateur->id,
            ]);
    }

    /** @test */
    public function it_can_create_an_utilisateur()
    {
        $role = Role::factory()->create();

        $data = [
            'nom' => 'Utilisateur Test',
            'prenom' => 'Test',
            'email' => 'utilisateur@test.com',
            'mot_de_passe' => 'password',
            'role_id' => $role->id,
        ];

        $response = $this->postJson('/api/utilisateurs', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_an_utilisateur()
    {
        $role = Role::factory()->create();
        $utilisateur = Utilisateur::factory()->create(['role_id' => $role->id]);

        $data = [
            'nom' => 'Utilisateur Modifié',
        ];

        $response = $this->patchJson("/api/utilisateurs/{$utilisateur->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_an_utilisateur()
    {
        $role = Role::factory()->create();
        $utilisateur = Utilisateur::factory()->create(['role_id' => $role->id]);

        $response = $this->deleteJson("/api/utilisateurs/{$utilisateur->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('utilisateurs', ['id' => $utilisateur->id]);
    }
}
