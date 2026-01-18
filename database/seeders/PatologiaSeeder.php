<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patologias = [
            ['nombre' => 'Hipertensión Arterial', 'tipo' => 'Crónica', 'descripcion' => 'Presión arterial elevada persistente.'],
            ['nombre' => 'Diabetes Mellitus', 'tipo' => 'Crónica', 'descripcion' => 'Niveles elevados de glucosa en sangre.'],
            ['nombre' => 'Asma Bronquial', 'tipo' => 'Crónica', 'descripcion' => 'Inflamación de las vías respiratorias.'],
            ['nombre' => 'Obesidad', 'tipo' => 'Crónica', 'descripcion' => 'Acumulación excesiva de grasa corporal.'],
            ['nombre' => 'Cardiopatía Isquémica', 'tipo' => 'Crónica', 'descripcion' => 'Reducción del flujo sanguíneo al corazón.'],
            ['nombre' => 'Artritis', 'tipo' => 'Crónica', 'descripcion' => 'Inflamación de las articulaciones.'],
            ['nombre' => 'EPOC', 'tipo' => 'Crónica', 'descripcion' => 'Enfermedad pulmonar obstructiva crónica.'],
        ];

        foreach ($patologias as $patologia) {
            \App\Models\Patologia::updateOrCreate(['nombre' => $patologia['nombre']], $patologia);
        }
    }
}
