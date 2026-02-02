<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoPatologia;

class TipoPatologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedPatologiaMental();
        $this->seedPatologiaParkinson();
        $this->seedPatologiaAsma();
        $this->seedPatologiaMusculoesqueletico();
        $this->seedPatologiaCardiovascular();
    }

    private function seedPatologiaMental()
    {
        $tipo = TipoPatologia::create([
            'nombre' => 'Patología Mental',
            'slug' => 'mental',
            'descripcion' => 'Registro de pacientes con condiciones de salud mental',
            'tabla_datos' => 'patologia_mental_registros',
            'modelo' => 'PatologiaMental',
            'color' => 'purple',
            'icono' => 'brain',
            'activo' => true
        ]);

        $campos = [
            ['nombre' => 'nombre', 'etiqueta' => 'Nombre', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 1, 'grupo' => 'Datos Personales'],
            ['nombre' => 'apellido', 'etiqueta' => 'Apellido', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 2, 'grupo' => 'Datos Personales'],
            ['nombre' => 'cedula', 'etiqueta' => 'Cédula', 'tipo_campo' => 'cedula', 'requerido' => true, 'orden' => 3, 'grupo' => 'Datos Personales'],
            ['nombre' => 'edad', 'etiqueta' => 'Edad', 'tipo_campo' => 'number', 'requerido' => true, 'orden' => 4, 'grupo' => 'Datos Personales'],
            ['nombre' => 'sexo', 'etiqueta' => 'Sexo', 'tipo_campo' => 'select', 'opciones' => ['M' => 'Masculino', 'F' => 'Femenino'], 'requerido' => true, 'orden' => 5, 'grupo' => 'Datos Personales'],
            ['nombre' => 'diagnostico', 'etiqueta' => 'Diagnóstico', 'tipo_campo' => 'textarea', 'requerido' => true, 'orden' => 6, 'grupo' => 'Información Médica'],
            ['nombre' => 'tratamiento', 'etiqueta' => 'Tratamiento', 'tipo_campo' => 'textarea', 'requerido' => false, 'orden' => 7, 'grupo' => 'Información Médica'],
            ['nombre' => 'direccion', 'etiqueta' => 'Dirección', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 8, 'grupo' => 'Contacto'],
            ['nombre' => 'telefono', 'etiqueta' => 'Teléfono', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 9, 'grupo' => 'Contacto'],
            ['nombre' => 'observaciones', 'etiqueta' => 'Observaciones', 'tipo_campo' => 'textarea', 'requerido' => false, 'orden' => 10, 'grupo' => 'Otros'],
        ];

        foreach ($campos as $campo) {
            $tipo->campos()->create($campo);
        }
    }

    private function seedPatologiaParkinson()
    {
        $tipo = TipoPatologia::create([
            'nombre' => 'Parkinson',
            'slug' => 'parkinson',
            'descripcion' => 'Registro de pacientes con enfermedad de Parkinson',
            'tabla_datos' => 'patologia_parkinson_registros',
            'modelo' => 'PatologiaParkinson',
            'color' => 'blue',
            'icono' => 'hand-back-fist',
            'activo' => true
        ]);

        $campos = [
            ['nombre' => 'nombre', 'etiqueta' => 'Nombre', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 1, 'grupo' => 'Datos Personales'],
            ['nombre' => 'apellido', 'etiqueta' => 'Apellido', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 2, 'grupo' => 'Datos Personales'],
            ['nombre' => 'cedula', 'etiqueta' => 'Cédula', 'tipo_campo' => 'cedula', 'requerido' => true, 'orden' => 3, 'grupo' => 'Datos Personales'],
            ['nombre' => 'edad', 'etiqueta' => 'Edad', 'tipo_campo' => 'number', 'requerido' => true, 'orden' => 4, 'grupo' => 'Datos Personales'],
            ['nombre' => 'sexo', 'etiqueta' => 'Sexo', 'tipo_campo' => 'select', 'opciones' => ['M' => 'Masculino', 'F' => 'Femenino'], 'requerido' => true, 'orden' => 5, 'grupo' => 'Datos Personales'],
            ['nombre' => 'telefono', 'etiqueta' => 'Teléfono', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 6, 'grupo' => 'Contacto'],
            ['nombre' => 'tratamiento', 'etiqueta' => 'Tratamiento', 'tipo_campo' => 'textarea', 'requerido' => false, 'orden' => 7, 'grupo' => 'Información Médica'],
            ['nombre' => 'direccion', 'etiqueta' => 'Dirección', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 8, 'grupo' => 'Contacto'],
        ];

        foreach ($campos as $campo) {
            $tipo->campos()->create($campo);
        }
    }

    private function seedPatologiaAsma()
    {
        $tipo = TipoPatologia::create([
            'nombre' => 'Asma Bronquial',
            'slug' => 'asma',
            'descripcion' => 'Registro de pacientes con asma bronquial',
            'tabla_datos' => 'patologia_asma_registros',
            'modelo' => 'PatologiaAsma',
            'color' => 'cyan',
            'icono' => 'lungs',
            'activo' => true
        ]);

        $campos = [
            ['nombre' => 'nombre', 'etiqueta' => 'Nombre', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 1, 'grupo' => 'Datos Personales'],
            ['nombre' => 'apellido', 'etiqueta' => 'Apellido', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 2, 'grupo' => 'Datos Personales'],
            ['nombre' => 'cedula', 'etiqueta' => 'Cédula', 'tipo_campo' => 'cedula', 'requerido' => true, 'orden' => 3, 'grupo' => 'Datos Personales'],
            ['nombre' => 'edad', 'etiqueta' => 'Edad', 'tipo_campo' => 'number', 'requerido' => true, 'orden' => 4, 'grupo' => 'Datos Personales'],
            ['nombre' => 'sexo', 'etiqueta' => 'Sexo', 'tipo_campo' => 'select', 'opciones' => ['M' => 'Masculino', 'F' => 'Femenino'], 'requerido' => true, 'orden' => 5, 'grupo' => 'Datos Personales'],
            ['nombre' => 'fecha_nacimiento', 'etiqueta' => 'Fecha de Nacimiento', 'tipo_campo' => 'date', 'requerido' => true, 'orden' => 6, 'grupo' => 'Datos Personales'],
            ['nombre' => 'inicio_asma', 'etiqueta' => 'Inicio del Asma', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 7, 'grupo' => 'Información Médica', 'placeholder' => 'Ej: Desde hace 5 años'],
            ['nombre' => 'fumador', 'etiqueta' => 'Fumador', 'tipo_campo' => 'select', 'opciones' => ['0' => 'No', '1' => 'Sí'], 'requerido' => true, 'orden' => 8, 'grupo' => 'Información Médica'],
            ['nombre' => 'tratamiento', 'etiqueta' => 'Tratamiento', 'tipo_campo' => 'textarea', 'requerido' => false, 'orden' => 9, 'grupo' => 'Información Médica'],
            ['nombre' => 'direccion', 'etiqueta' => 'Dirección', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 10, 'grupo' => 'Contacto'],
            ['nombre' => 'telefono', 'etiqueta' => 'Teléfono', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 11, 'grupo' => 'Contacto'],
        ];

        foreach ($campos as $campo) {
            $tipo->campos()->create($campo);
        }
    }

    private function seedPatologiaMusculoesqueletico()
    {
        $tipo = TipoPatologia::create([
            'nombre' => 'Musculoesquelético',
            'slug' => 'musculoesqueletico',
            'descripcion' => 'Registro de pacientes con afecciones musculoesqueléticas',
            'tabla_datos' => 'patologia_musculoesqueletico_registros',
            'modelo' => 'PatologiaMusculoesqueletico',
            'color' => 'amber',
            'icono' => 'bone',
            'activo' => true
        ]);

        $campos = [
            ['nombre' => 'nombre', 'etiqueta' => 'Nombre', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 1, 'grupo' => 'Datos Personales'],
            ['nombre' => 'apellido', 'etiqueta' => 'Apellido', 'tipo_campo' => 'text', 'requerido' => true, 'orden' => 2, 'grupo' => 'Datos Personales'],
            ['nombre' => 'edad', 'etiqueta' => 'Edad', 'tipo_campo' => 'number', 'requerido' => true, 'orden' => 3, 'grupo' => 'Datos Personales'],
            ['nombre' => 'sexo', 'etiqueta' => 'Sexo', 'tipo_campo' => 'select', 'opciones' => ['M' => 'Masculino', 'F' => 'Femenino'], 'requerido' => true, 'orden' => 4, 'grupo' => 'Datos Personales'],
            ['nombre' => 'cedula', 'etiqueta' => 'Cédula', 'tipo_campo' => 'cedula', 'requerido' => true, 'orden' => 5, 'grupo' => 'Datos Personales'],
            ['nombre' => 'direccion', 'etiqueta' => 'Dirección', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 6, 'grupo' => 'Contacto'],
            ['nombre' => 'telefono', 'etiqueta' => 'Teléfono', 'tipo_campo' => 'text', 'requerido' => false, 'orden' => 7, 'grupo' => 'Contacto'],
            ['nombre' => 'diagnostico', 'etiqueta' => 'Diagnóstico', 'tipo_campo' => 'textarea', 'requerido' => true, 'orden' => 8, 'grupo' => 'Información Médica'],
            ['nombre' => 'tratamiento', 'etiqueta' => 'Tratamiento', 'tipo_campo' => 'textarea', 'requerido' => false, 'orden' => 9, 'grupo' => 'Información Médica'],
        ];

        foreach ($campos as $campo) {
            $tipo->campos()->create($campo);
        }
    }

    private function seedPatologiaCardiovascular()
    {
        $tipo = TipoPatologia::create([
            'nombre' => 'Cardiovascular',
            'slug' => 'cardiovascular',
            'descripcion' => 'Registro de pacientes con enfermedades cardiovasculares',
            'tabla_datos' => 'patologia_cardiovascular_registros',
            'modelo' => 'PatologiaCardiovascular',
            'color' => 'red',
            'icono' => 'heart-pulse',
            'activo' => true
        ]);

        // Este tipo tiene muchos campos, especialmente medicamentos
        // Por simplicidad en el seeder, no crearemos todos los campos dinámicos
        // porque la tabla ya tiene todas las columnas definidas
        // Los campos se manejarán directamente en el formulario
        
        $this->command->info('Tipo Cardiovascular creado. Los campos se manejarán directamente en el controlador debido a su complejidad.');
    }
}
