<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManzanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 10 Manzanas
        \App\Models\Manzana::factory(10)->create()->each(function ($manzana) {
            
            // Cada manzana tiene entre 3 y 8 familias
            $familias = \App\Models\Familia::factory(rand(3, 8))->make();
            $manzana->familias()->saveMany($familias);

            // Para cada familia creada...
            $familias->each(function ($familia) {
                
                // 1. Crear Ficha Familiar
                \App\Models\FichaFamiliar::factory()->create([
                    'familia_id' => $familia->id
                ]);

                // 2. Crear Integrantes (entre 2 y 6)
                \App\Models\Integrante::factory(rand(2, 6))->create([
                    'familia_id' => $familia->id
                ]);

                // 3. Crear 1 Usuario Jefe de Familia vinculado
                \App\Models\User::factory()->create([
                    'familia_id' => $familia->id,
                    'name' => $familia->apellidos,
                    'email' => 'familia' . $familia->id . '@sistema.com',
                    'role' => 'paciente',
                    'password' => bcrypt('password'), // Contraseña por defecto
                ]);
            });
        });
    }
}
