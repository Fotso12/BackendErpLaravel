<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contact;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_contacts()
    {
        $response = $this->getJson('/api/contacts');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->getJson("/api/contacts/{$contact->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $contact->id,
            ]);
    }

    /** @test */
    public function it_can_create_a_contact()
    {
        $data = [
            // Add required fields for creation
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_a_contact()
    {
        $contact = Contact::factory()->create();

        $data = [
            // Add fields to update
        ];

        $response = $this->patchJson("/api/contacts/{$contact->id}", $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_a_contact()
    {
        $contact = Contact::factory()->create();

        $response = $this->deleteJson("/api/contacts/{$contact->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
