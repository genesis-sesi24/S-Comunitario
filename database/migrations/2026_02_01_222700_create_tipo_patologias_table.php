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
        Schema::create('tipo_patologias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // "Patología Mental", "Parkinson"
            $table->string('slug')->unique(); // "mental", "parkinson"
            $table->text('descripcion')->nullable();
            $table->string('icono')->nullable(); // CSS class or icon name
            $table->string('color')->default('blue'); // Color para UI
            $table->string('tabla_datos'); // Nombre de la tabla de datos, ej: "patologia_mental_registros"
            $table->string('modelo'); // Nombre del modelo, ej: "PatologiaMental"
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_patologias');
    }
};
