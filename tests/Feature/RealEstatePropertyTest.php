<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\RealEstateProperty;


class RealEstatePropertyTest extends TestCase
{
    /**
     * A basic test example.
     */
    private $property;


    public function test_store_new_real_estate_property()
    {
        $property = RealEstateProperty::factory()->make();
        $parameters = [
            'type' => $property->type,
            'address' => $property->address,
            'size' => $property->size,
            'bedrooms' => $property->bedrooms,
            'price' => $property->price,
            'latitude' => $property->latitude,
            'longitude' => $property->longitude,
        ];
        $response = $this->postJson(route('real-estate.store'), $parameters)
            ->assertCreated()
            ->json();
        
        $this->assertEquals($property->address, $response['address']);
        $this->assertEquals($property->size, $response['size']);
        $this->assertEquals($property->bedrooms, $response['bedrooms']);
        $this->assertEquals($property->price, $response['price']);
        $this->assertEquals($property->latitude, $response['latitude']);
        $this->assertEquals($property->longitude, $response['longitude']);
        $this->assertDatabaseHas('real_estate_properties', ['id' => $response['id']]);
    }

    public function test_store_throw_error_type_missing()
    {
        $response = $this->postJson(route('real-estate.store'), )
            ->assertStatus(422)
            ->assertJsonStructure(['errors'=>['type']])
            ->json();
    }

    public function test_store_throw_error_address_missing()
    {
        $response = $this->postJson(route('real-estate.store'), )
            ->assertStatus(422)
            ->assertJsonStructure(['errors'=>['address']])
            ->json();
    }

    public function test_store_throw_error_size_missing()
    {
        $response = $this->postJson(route('real-estate.store'), )
            ->assertStatus(422)
            ->assertJsonStructure(['errors'=>['size']])
            ->json();
    }

    public function test_store_throw_error_bedrooms_missing()
    {
        $response = $this->postJson(route('real-estate.store'), )
            ->assertStatus(422)
            ->assertJsonStructure(['errors'=>['bedrooms']])
            ->json();
    }

    public function test_store_throw_error_price_missing()
    {
        $response = $this->postJson(route('real-estate.store'), )
            ->assertStatus(422)
            ->assertJsonStructure(['errors'=>['price']])
            ->json();
    }
}
