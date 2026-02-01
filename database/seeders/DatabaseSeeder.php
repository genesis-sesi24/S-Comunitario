<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Asegúrate de establecer contraseña
                'role' => 'admin', // Asumo rol admin
            ]
        );

        // Llamar algar seeder de patologías
        $this->call([
            SecurityQuestionsSeeder::class,
            PatologiaSeeder::class,
            ManzanaSeeder::class,
        ]);
    }
}
