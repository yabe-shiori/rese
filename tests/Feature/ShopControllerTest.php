<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;




class ShopControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testIndex()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);

    }

    public function testDetail()
    {
        $response = $this->get(route('detail', ['shop_id' => 1]));

        $response->assertStatus(404);
    }

    public function testSearch()
    {
        $response = $this->get(route('search'));

        $response->assertStatus(200);
    }
}
