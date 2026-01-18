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
        Schema::create('integrantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_id')->constrained('familias')->onDelete('cascade');
            $table->string('name');
            $table->string('apellido')->nullable();
            $table->string('cedula')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo', 10)->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('parentesco')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrantes');
    }
};
