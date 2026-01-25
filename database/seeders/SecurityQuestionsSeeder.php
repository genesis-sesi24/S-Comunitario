<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SecurityQuestion;

class SecurityQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            '¿Cuál es el nombre de tu primera mascota?',
            '¿En qué ciudad naciste?',
            '¿Cuál es el apellido de soltera de tu madre?',
            '¿Cuál es el nombre de tu mejor amigo de la infancia?',
            '¿Cuál fue el nombre de tu primera escuela?',
            '¿Cuál es tu color favorito?',
            '¿Cuál es el nombre de tu película favorita?',
            '¿Cuál es tu comida favorita?',
        ];

        foreach ($questions as $question) {
            SecurityQuestion::create(['question' => $question]);
        }
    }
}
