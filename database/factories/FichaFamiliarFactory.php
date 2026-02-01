<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FichaFamiliar>
 */
class FichaFamiliarFactory extends Factory
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
            
            // Identificación
            'asic' => 'ASIC ' . $this->faker->randomElement(['Centro', 'Norte', 'Sur', 'Oeste', 'Este']),
            'consultorio' => 'CPT ' . $this->faker->city,
            'numero_hc' => $this->faker->unique()->numerify('HC-202X-####'),
            'direccion' => $this->faker->address,
            'estado' => $this->faker->state,
            'municipio' => $this->faker->city,
            'parroquia' => $this->faker->citySuffix,
            
            // Clasificación
            'numero_miembros' => $this->faker->randomElement(['pequena', 'mediana', 'grande']),
            'antecedentes_familia' => $this->faker->randomElement(['nuclear', 'extensa', 'ampliada']),
            'numero_generaciones' => $this->faker->randomElement(['unigeneracional', 'bigeneracional', 'trigeneracional', 'multigeneracional']),
            'etapa_desarrollo' => $this->faker->randomElement(['formacion', 'contraccion', 'extension', 'disolucion']),
            
            // Socioeconómicas
            'ingreso_percapita' => $this->faker->randomFloat(2, 10, 100),
            'numero_trabajadores' => $this->faker->numberBetween(0, 3),
            'cocina_gas' => $this->faker->boolean(80),
            'cocina_electrica' => $this->faker->boolean(30),
            'cocina_lena' => $this->faker->boolean(5),
            'tiene_refrigerador' => $this->faker->boolean(90),
            'tiene_televisor' => $this->faker->boolean(85),
            'tiene_ventilador' => $this->faker->boolean(70),
            
            // Estructurales
            'tipo_vivienda' => $this->faker->randomElement(['casa', 'apartamento', 'habitacion', 'rancho', 'palafito', 'otros']),
            'material_construccion' => $this->faker->randomElement(['bloque', 'madera', 'bahareque', 'carton', 'zinc', 'otros']),
            'tipo_techo' => $this->faker->randomElement(['placa', 'asbesto', 'acerolit', 'guano', 'zinc', 'otros']),
            'tipo_piso' => $this->faker->randomElement(['losas', 'cemento', 'tierra', 'madera', 'otros']),
            'estado_constructivo' => $this->faker->randomElement(['buena', 'regular', 'mala']),
            'hacinamiento' => $this->faker->boolean(20),
            'numero_habitantes' => $this->faker->numberBetween(1, 10),
            'numero_habitaciones' => $this->faker->numberBetween(1, 5),
            'servicio_electrico' => $this->faker->boolean(95),
            'abasto_agua' => $this->faker->randomElement(['pozos', 'acueducto', 'manantial', 'rio', 'otros']),
            'bano_sanitario' => $this->faker->randomElement(['bano', 'letrina', 'no_posee', 'otros']),
            'destino_residuales' => $this->faker->randomElement(['alcantarillado', 'pozos_septico', 'otros']),
            'destino_desechos' => $this->faker->randomElement(['recogida_local', 'vertederos', 'otros']),
            
            // Animales
            'tiene_perros' => $this->faker->boolean(40),
            'tiene_gatos' => $this->faker->boolean(30),
            
            'discusion_evaluacion' => $this->faker->paragraph,
        ];
    }
}
