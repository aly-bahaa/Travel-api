<?php

namespace Tests\Feature;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TravelListTest extends TestCase
{
   use RefreshDatabase;
    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        Travel::factory(16)->create(['is_public' => true,]);

        $response = $this->get('/api/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(15,'data');
        $response->assertJsonPath('meta.last_page',2);
    }
    public function test_travels_list_returns_public_travels_only(): void
    {
        $public = Travel::factory()->create(['is_public' => true]);
        $not_public = Travel::factory()->create(['is_public' => false]);
        $response = $this->get('/api/travels');

        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonPath('data.0.name',$public->name);
    }
}
