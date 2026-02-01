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
        Schema::create('ficha_familiars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_id')->constrained('familias')->cascadeOnDelete();
            
            // Datos de Identificación
            $table->string('asic')->nullable();
            $table->string('consultorio')->nullable();
            $table->string('numero_hc')->nullable();
            $table->text('direccion')->nullable();
            $table->string('estado')->nullable();
            $table->string('municipio')->nullable();
            $table->string('parroquia')->nullable();
            
            // Clasificación de la Familia
            $table->enum('numero_miembros', ['pequena', 'mediana', 'grande'])->nullable();
            $table->enum('antecedentes_familia', ['nuclear', 'extensa', 'ampliada'])->nullable();
            $table->enum('numero_generaciones', ['unigeneracional', 'bigeneracional', 'trigeneracional', 'multigeneracional'])->nullable();
            $table->enum('etapa_desarrollo', ['formacion', 'contraccion', 'extension', 'disolucion'])->nullable();
            
            // Condiciones Socioeconómicas
            $table->decimal('ingreso_percapita', 10, 2)->nullable();
            $table->integer('numero_trabajadores')->nullable();
            $table->boolean('cocina_gas')->default(false);
            $table->boolean('cocina_electrica')->default(false);
            $table->boolean('cocina_lena')->default(false);
            $table->string('cocina_otra')->nullable();
            $table->boolean('tiene_refrigerador')->default(false);
            $table->boolean('tiene_televisor')->default(false);
            $table->boolean('tiene_ventilador')->default(false);
            $table->string('otros_equipos')->nullable();
            
            // Condiciones Estructurales
            $table->enum('tipo_vivienda', ['casa', 'apartamento', 'habitacion', 'rancho', 'palafito', 'otros'])->nullable();
            $table->string('tipo_vivienda_otros')->nullable();
            $table->enum('material_construccion', ['bloque', 'madera', 'bahareque', 'carton', 'zinc', 'otros'])->nullable();
            $table->string('material_otros')->nullable();
            $table->enum('tipo_techo', ['placa', 'asbesto', 'acerolit', 'guano', 'zinc', 'otros'])->nullable();
            $table->string('techo_otros')->nullable();
            $table->enum('tipo_piso', ['losas', 'cemento', 'tierra', 'madera', 'otros'])->nullable();
            $table->string('piso_otros')->nullable();
            $table->enum('estado_constructivo', ['buena', 'regular', 'mala'])->nullable();
            $table->boolean('hacinamiento')->default(false);
            $table->integer('numero_habitantes')->nullable();
            $table->integer('numero_habitaciones')->nullable();
            $table->boolean('servicio_electrico')->default(false);
            $table->enum('abasto_agua', ['pozos', 'acueducto', 'manantial', 'rio', 'otros'])->nullable();
            $table->string('agua_otros')->nullable();
            $table->enum('bano_sanitario', ['bano', 'letrina', 'no_posee', 'otros'])->nullable();
            $table->string('bano_otros')->nullable();
            $table->enum('destino_residuales', ['alcantarillado', 'pozos_septico', 'otros'])->nullable();
            $table->string('residuales_otros')->nullable();
            $table->enum('destino_desechos', ['recogida_local', 'vertederos', 'otros'])->nullable();
            $table->string('desechos_otros')->nullable();
            $table->boolean('tiene_perros')->default(false);
            $table->boolean('tiene_gatos')->default(false);
            $table->string('otros_animales')->nullable();
            $table->string('vectores')->nullable();
            
            // Discusión y Evaluación
            $table->text('discusion_evaluacion')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_familiars');
    }
};
