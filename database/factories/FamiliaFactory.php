<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Familia>
 */
class FamiliaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $apellidos = [
            'Rodríguez', 'González', 'Pérez', 'Hernández', 'García', 'Martínez', 'Sánchez', 
            'Ramírez', 'Díaz', 'Muñoz', 'Rojas', 'Romero', 'Mendoza', 'Flores', 'Castillo'
        ];

        $apellido1 = $this->faker->randomElement($apellidos);
        $apellido2 = $this->faker->randomElement($apellidos);

        return [
            'manzana_id' => \App\Models\Manzana::factory(),
            'apellidos' => "Familia $apellido1 $apellido2",
            'numero_casa' => $this->faker->bothify('Nro. ##-?'),
            'calle_transversal' => 'Calle ' . $this->faker->streetName,
            'numero_habitantes' => $this->faker->numberBetween(1, 8),

        ];
    }
}
