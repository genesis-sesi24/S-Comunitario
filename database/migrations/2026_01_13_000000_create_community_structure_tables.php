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
        // Sectores o Veredas de la comunidad
        Schema::create('sectores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Ej: Sector 1, Vereda 5
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Calles dentro de los sectores (opcional, si aplica)
        Schema::create('calles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('sectores')->cascadeOnDelete();
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calles');
        Schema::dropIfExists('sectores');
    }
};
