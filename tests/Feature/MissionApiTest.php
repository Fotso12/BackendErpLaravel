<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Mission;

class MissionApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_missions()
    {
        $response = $this->getJson('/api/missions');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_mission()
    {
        $mission = Mission::factory()->create();

        $response = $this->getJson("/api/missions/{$mission->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $mission->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_mission()
    {
        $data = [
            // Add required fields for creation
        ];

        $response = $this->postJson('/api/missions', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_mission()
    {
        $mission = Mission::factory()->create();

        $data = [
            // Add fields to update
        ];

        $response = $this->patchJson("/api/missions/{$mission->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_mission()
    {
        $mission = Mission::factory()->create();

        $response = $this->deleteJson("/api/missions/{$mission->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('missions', ['id' => $mission->id]);
    }
}
