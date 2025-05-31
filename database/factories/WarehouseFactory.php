<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'image' => $this->faker->imageUrl(640, 480, 'warehouse', true),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
