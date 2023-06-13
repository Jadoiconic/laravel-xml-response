<?php

namespace Tests\Unit;

use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');

    }

    public function testShow()
    {
        $response = $this->get('/api/categories/1');

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');

    }


    public function testUpdate()
    {
        // Create a category using factory or manually insert data

        $data = [
            'name' => 'Updated Category',
        ];

        $response = $this->put('/api/categories/1', $data);

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');

        // Add additional assertions to check the XML response content
    }

    public function testDestroy()
    {
        $response = $this->delete('/api/categories/1');

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');
    }



}
