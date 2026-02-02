<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatologiaMental extends Model
{
    use SoftDeletes;

    protected $table = 'patologia_mental_registros';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'cedula_tipo',
        'edad',
        'sexo',
        'diagnostico',
        'tratamiento',
        'direccion',
        'telefono',
        'observaciones'
    ];

    protected $casts = [
        'edad' => 'integer'
    ];

    /**
     * Obtiene el nombre completo del paciente
     */
    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    /**
     * Obtiene la cédula con tipo
     */
    public function getCedulaCompletaAttribute()
    {
        return $this->cedula_tipo . '-' . $this->cedula;
    }
}
