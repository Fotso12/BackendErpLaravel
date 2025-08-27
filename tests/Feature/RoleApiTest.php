<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;

class RoleApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_roles()
    {
        $response = $this->getJson('/api/roles');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_role()
    {
        $role = Role::factory()->create();

        $response = $this->getJson("/api/roles/{$role->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $role->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_role()
    {
        $data = [
            'nom' => 'Role Test',
        ];

        $response = $this->postJson('/api/roles', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_role()
    {
        $role = Role::factory()->create();

        $data = [
            'nom' => 'Role Modifié',
        ];

        $response = $this->patchJson("/api/roles/{$role->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_role()
    {
        $role = Role::factory()->create();

        $response = $this->deleteJson("/api/roles/{$role->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
