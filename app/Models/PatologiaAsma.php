<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatologiaAsma extends Model
{
    use SoftDeletes;

    protected $table = 'patologia_asma_registros';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'cedula_tipo',
        'edad',
        'sexo',
        'fecha_nacimiento',
        'inicio_asma',
        'fumador',
        'tratamiento',
        'direccion',
        'telefono'
    ];

    protected $casts = [
        'edad' => 'integer',
        'fecha_nacimiento' => 'date',
        'fumador' => 'boolean'
    ];

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    public function getCedulaCompletaAttribute()
    {
        return $this->cedula_tipo . '-' . $this->cedula;
    }
}
