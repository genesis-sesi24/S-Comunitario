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
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('direccion');
            $table->string('telefonos');
            $table->string('logo');
            $table->string('logo_Cm');
            $table->string('moneda');
            $table->string('correo');
            $table->string('pagina_web')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajustes');
    }
};
