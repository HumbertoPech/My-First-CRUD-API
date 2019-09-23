<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_client_can_create_a_product()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        
        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
    }
    
    public function test_client_can_get_a_product()
    {
        // Given
        //There is a product with id = 1 in the application

        // When
        $response = $this->json('GET', '/api/products/1'); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(200);
        
        // Assert the response has the correct structure
        /*$response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);*/

        // Assert the product was returned
        // with the correct data
        /*$response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);*/
        
        //$body = $response->decodeResponseJson();

        // Assert product is on the database
        /*$this->assertDatabaseHas(
            'products',
            [
                'id' => 1,
                'name' => 'Super Product',
                'price' => 23.30
            ]
        );*/
    }

    public function test_client_can_update_a_product()
    {
        // Given
        $productData = [
            'name' => 'Tacos',
            'price' => '200'
        ];
        //And there is a product with id = 1 in the application

        // When
        $response = $this->json('PUT', '/api/products/1', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(200);
        
    }

    public function test_client_can_delete_a_product()
    {
        // Given
        //There is a product with id = 1 in the application

        // When
        $response = $this->json('DELETE', '/api/products/1'); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(200);
        
    }
}
