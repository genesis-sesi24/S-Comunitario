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
        Schema::create('patologia_musculoesqueletico_registros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('edad');
            $table->enum('sexo', ['M', 'F']);
            $table->string('cedula');
            $table->enum('cedula_tipo', ['F', 'N'])->default('N');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->text('diagnostico');
            $table->text('tratamiento')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('cedula');
            $table->index(['nombre', 'apellido']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patologia_musculoesqueletico_registros');
    }
};
