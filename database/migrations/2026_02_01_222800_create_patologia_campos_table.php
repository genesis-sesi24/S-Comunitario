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
        Schema::create('patologia_campos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_patologia_id')->constrained('tipo_patologias')->onDelete('cascade');
            $table->string('nombre'); // Nombre del campo en la BD, ej: "nombre", "cedula", "edad"
            $table->string('etiqueta'); // Etiqueta visible, ej: "Nombre del Paciente"
            $table->string('tipo_campo'); // text, number, select, checkbox, date, textarea, cedula, medication
            $table->text('opciones')->nullable(); // JSON para selects/checkboxes/medications
            $table->boolean('requerido')->default(false);
            $table->integer('orden')->default(0);
            $table->string('grupo')->nullable(); // Para agrupar campos en secciones
            $table->string('placeholder')->nullable();
            $table->text('ayuda')->nullable(); // Texto de ayuda
            $table->text('validacion')->nullable(); // JSON: min, max, regex, etc.
            $table->timestamps();
            
            $table->index(['tipo_patologia_id', 'orden']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patologia_campos');
    }
};
