<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToursListTest extends TestCase
{
    use RefreshDatabase;
    public function test_tours_list_returns_paginated_data_correctly(): void
    {
        $travel =  Travel::factory()->create(['is_public' => true,]);
        $tour = Tour::factory(16)->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(15,'data');
        $response->assertJsonPath('meta.last_page',2);
    }
     public function test_tours_list_returns_price_correctly(): void
    {
        $travel =  Travel::factory()->create(['is_public' => true,]);
        $tour = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 123.45
    ]);

        $response = $this->get('/api/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonPath('data.0.price','123.45');
    }
}
