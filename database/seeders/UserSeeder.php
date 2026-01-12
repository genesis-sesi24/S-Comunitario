<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@labatalla.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'is_active' => true,
        ]);

        // Médico
        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'medico@labatalla.com',
            'password' => Hash::make('password'),
            'role' => 'medico',
            'phone' => '1234567891',
            'is_active' => true,
        ]);

        // Secretaria
        User::create([
            'name' => 'María García',
            'email' => 'secretaria@labatalla.com',
            'password' => Hash::make('password'),
            'role' => 'secretaria',
            'phone' => '1234567892',
            'is_active' => true,
        ]);

        // Paciente
        User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'paciente@labatalla.com',
            'password' => Hash::make('password'),
            'role' => 'paciente',
            'phone' => '1234567893',
            'is_active' => true,
        ]);
    }
}
