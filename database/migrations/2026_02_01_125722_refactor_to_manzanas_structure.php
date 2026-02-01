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
        // 1. Renombrar tabla 'sectores' a 'manzanas'
        Schema::rename('sectores', 'manzanas');
        
        // 2. Agregar columna temporal manzana_id a familias (nullable primero)
        Schema::table('familias', function (Blueprint $table) {
            $table->unsignedBigInteger('manzana_id')->nullable()->after('id');
        });
        
        // 3. Migrar datos: Asignar manzana_id basándose en vivienda->calle->sector
        DB::statement('
            UPDATE familias f
            INNER JOIN viviendas v ON f.vivienda_id = v.id
            INNER JOIN calles c ON v.calle_id = c.id
            SET f.manzana_id = c.sector_id
        ');
        
        // 4. Hacer manzana_id obligatorio y agregar foreign key
        Schema::table('familias', function (Blueprint $table) {
            $table->unsignedBigInteger('manzana_id')->nullable(false)->change();
            $table->foreign('manzana_id')->references('id')->on('manzanas')->cascadeOnDelete();
        });
        
        // 5. Eliminar la relación con viviendas y la columna
        Schema::table('familias', function (Blueprint $table) {
            $table->dropForeign(['vivienda_id']);
            $table->dropColumn('vivienda_id');
            
            // Agregar campos de ubicación que antes estaban en vivienda
            $table->string('numero_casa')->nullable()->after('manzana_id');
            $table->string('calle_transversal')->nullable()->after('numero_casa');
        });
        
        // 6. Eliminar tabla 'viviendas' (ya no se necesita)
        Schema::dropIfExists('viviendas');
        
        // 7. Eliminar tabla 'calles' (ya no se necesita)
        Schema::dropIfExists('calles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir en orden inverso
        
        // 1. Recrear tabla 'calles'
        Schema::create('calles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('manzanas')->cascadeOnDelete();
            $table->string('nombre');
            $table->timestamps();
        });
        
        // 2. Recrear tabla 'viviendas'
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calle_id')->constrained('calles')->cascadeOnDelete();
            $table->string('numero_casa')->nullable();
            $table->enum('tipo_techo', ['platabanda', 'zinc', 'asbesto', 'teja', 'otro'])->nullable();
            $table->enum('tipo_piso', ['granito', 'ceramica', 'cemento', 'tierra', 'otro'])->nullable();
            $table->enum('tipo_pared', ['bloque_friso', 'bloque_sin_friso', 'adobe', 'zinc', 'madera', 'otro'])->nullable();
            $table->boolean('agua_potable')->default(false);
            $table->boolean('aguas_servidas')->default(false);
            $table->boolean('gas_directo')->default(false);
            $table->boolean('insectos_roedores')->default(false);
            $table->boolean('animales_domesticos')->default(false);
            $table->boolean('hacinamiento')->default(false);
            $table->timestamps();
        });
        
        // 3. Modificar tabla 'familias' para restaurar relación con viviendas
        Schema::table('familias', function (Blueprint $table) {
            $table->unsignedBigInteger('vivienda_id')->nullable()->after('id');
        });
        
        // 4. Eliminar columnas de manzana
        Schema::table('familias', function (Blueprint $table) {
            $table->dropForeign(['manzana_id']);
            $table->dropColumn(['manzana_id', 'numero_casa', 'calle_transversal']);
        });
        
        // 5. Renombrar 'manzanas' de vuelta a 'sectores'
        Schema::rename('manzanas', 'sectores');
    }
};
