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
        Schema::create('patologia_cardiovascular_registros', function (Blueprint $table) {
            $table->id();
            
            // Datos Personales
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->enum('cedula_tipo', ['F', 'N'])->default('N');
            $table->integer('edad');
            $table->enum('sexo', ['M', 'F']);
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            
            // Condiciones
            $table->boolean('hta')->default(false); // Hipertensión Arterial
            $table->boolean('erc')->default(false); // Enfermedades Reumáticas Crónicas
            $table->boolean('iam')->default(false); // Infarto Agudo de Miocardio
            $table->boolean('acv')->default(false); // Accidente Cerebro Vascular
            $table->boolean('dislipidemia')->default(false);
            
            // Hábitos
            $table->boolean('fumador')->default(false);
            
            // Medicamentos (boolean + dosificación donde aplique)
            $table->boolean('aspirina')->default(false);
            $table->boolean('alfa_metildopa')->default(false);
            $table->boolean('amiodarona')->default(false);
            
            $table->boolean('amlodipino')->default(false);
            $table->enum('amlodipino_dosis', ['5mg', '10mg'])->nullable();
            
            $table->boolean('atenolol')->default(false);
            $table->enum('atenolol_dosis', ['50mg', '100mg'])->nullable();
            
            $table->boolean('atorvastatina')->default(false);
            $table->enum('atorvastatina_dosis', ['20mg', '40mg'])->nullable();
            
            $table->boolean('captopril')->default(false);
            $table->enum('captopril_dosis', ['25mg', '50mg'])->nullable();
            
            $table->boolean('carvedilol')->default(false);
            $table->enum('carvedilol_dosis', ['6.25mg', '12.5mg'])->nullable();
            
            $table->boolean('clopidogrel')->default(false);
            $table->string('clopidogrel_dosis')->default('75mg')->nullable();
            
            $table->boolean('dinitrato_isosorbide')->default(false);
            
            $table->boolean('enalapril')->default(false);
            $table->enum('enalapril_dosis', ['10mg', '20mg'])->nullable();
            
            $table->boolean('digoxina')->default(false);
            $table->boolean('furosemida')->default(false);
            
            $table->boolean('losartan')->default(false);
            $table->enum('losartan_dosis', ['50mg', '100mg'])->nullable();
            
            $table->boolean('sinvastatina')->default(false);
            $table->string('sinvastatina_dosis')->default('40mg')->nullable();
            
            $table->boolean('verapamilo')->default(false);
            
            $table->text('otros_medicamentos')->nullable();
            
            // Ubicación
            $table->string('municipio')->nullable();
            $table->string('distrito')->nullable();
            $table->string('centro_salud')->nullable();
            
            // Otros
            $table->text('observaciones')->nullable();
            
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
        Schema::dropIfExists('patologia_cardiovascular_registros');
    }
};
