<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Permission;

class PermissionApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_permissions()
    {
        $response = $this->getJson('/api/permissions');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_permission()
    {
        $permission = Permission::factory()->create();

        $response = $this->getJson("/api/permissions/{$permission->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $permission->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_permission()
    {
        $data = [
            'nom' => 'Permission Test',
        ];

        $response = $this->postJson('/api/permissions', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_permission()
    {
        $permission = Permission::factory()->create();

        $data = [
            'nom' => 'Permission Modifié',
        ];

        $response = $this->patchJson("/api/permissions/{$permission->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_permission()
    {
        $permission = Permission::factory()->create();

        $response = $this->deleteJson("/api/permissions/{$permission->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('permissions', ['id' => $permission->id]);
    }
}
