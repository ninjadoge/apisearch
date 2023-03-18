<?php

namespace Database\Factories;

use App\Models\RealEstateProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealEstateProperty>
 */
class RealEstatePropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = RealEstateProperty::class;
    
    public function definition(): array
    {
       
        return [
            'type' => fake()->randomElement(['house','apartment']),
            'address' => fake()->address(),
            'size' => fake()->numberBetween(20, 1000),
            'bedrooms' => fake()->numberBetween(1, 30),
            'price' => fake()->numberBetween(0, 1000000),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
        ];
    }
}
