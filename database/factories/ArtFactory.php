<?php

namespace Database\Factories;

use App\Models\Art;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Art>
 */
class ArtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(12),
            'price' => $this->faker->randomFloat(2, 100, 50000),
            'image' => rand(1, 20) . '.jpg',
            'duration' => rand(20, 400),
            'date' => $this->faker->date
        ];
    }
}
