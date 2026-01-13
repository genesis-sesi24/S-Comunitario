<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Viviendas: Datos físicos y ambientales
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calle_id')->constrained('calles')->cascadeOnDelete();
            $table->string('numero_casa')->nullable();
            
            // Condiciones de infraestructura
            $table->enum('tipo_techo', ['platabanda', 'zinc', 'asbesto', 'teja', 'otro'])->nullable();
            $table->enum('tipo_piso', ['granito', 'ceramica', 'cemento', 'tierra', 'otro'])->nullable();
            $table->enum('tipo_pared', ['bloque_friso', 'bloque_sin_friso', 'adobe', 'zinc', 'madera', 'otro'])->nullable();
            
            // Servicios Básicos
            $table->boolean('agua_potable')->default(false);
            $table->boolean('aguas_servidas')->default(false); // Cloacas/Pozo séptico
            $table->boolean('gas_directo')->default(false);
            
            // Factores de Riesgo
            $table->boolean('insectos_roedores')->default(false);
            $table->boolean('animales_domesticos')->default(false);
            $table->boolean('hacinamiento')->default(false);
            
            $table->timestamps();
        });

        // Familias: Grupo social que habita la vivienda
        Schema::create('familias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vivienda_id')->constrained('viviendas')->cascadeOnDelete();
            $table->string('apellidos'); // Ej: "Familia Pérez Rodríguez"
            
            // Socio-económico
            $table->decimal('ingreso_mensual_aprox', 10, 2)->nullable();
            $table->timestamps();
        });
        
        // Relación de integrantes (Usuarios/Pacientes) con Familias
        // Agregamos la columna familia_id a la tabla users existente
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('familia_id')->nullable()->after('id')->constrained('familias')->nullOnDelete();
                $table->string('parentesco')->nullable()->after('familia_id'); // Jefe, Pareja, Hijo, etc.
                $table->date('fecha_nacimiento')->nullable()->after('name');
                $table->string('cedula', 20)->nullable()->unique()->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['familia_id']);
                $table->dropColumn(['familia_id', 'parentesco', 'fecha_nacimiento', 'cedula']);
            });
        }
        Schema::dropIfExists('familias');
        Schema::dropIfExists('viviendas');
    }
};
