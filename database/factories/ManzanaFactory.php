<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manzana>
 */
class ManzanaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => 'Manzana ' . $this->faker->unique()->numberBetween(1, 99),
            'descripcion' => $this->faker->optional(0.7)->sentence(10),
        ];
    }
}
