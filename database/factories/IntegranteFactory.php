<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Integrante>
 */
class IntegranteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'familia_id' => \App\Models\Familia::factory(),
            'name' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'cedula' => $this->faker->unique()->numberBetween(1000000, 30000000),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2010-01-01'),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'escolaridad' => $this->faker->randomElement(['Primaria', 'Secundaria', 'Universitario', 'Ninguno']),
            'parentesco' => $this->faker->randomElement(['Jefe/a de Familia', 'Esposo/a', 'Hijo/a', 'Nieto/a']),
            'grupo_dispensarial' => $this->faker->randomElement(['Sano', 'Enfermo', 'Riesgo', 'Discapacidad']),
            'patologias' => $this->faker->optional(0.3)->randomElement(['Hipertensión', 'Diabetes', 'Asma', 'Alergias']),
        ];
    }
}
