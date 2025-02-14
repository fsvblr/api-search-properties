<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Property;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_properties()
    {
        Property::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/properties');

        $response->assertStatus(200);

        $response->assertJsonCount(5, 'data');
    }
}
