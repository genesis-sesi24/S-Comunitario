<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatologiaParkinson extends Model
{
    use SoftDeletes;

    protected $table = 'patologia_parkinson_registros';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'cedula_tipo',
        'edad',
        'sexo',
        'telefono',
        'tratamiento',
        'direccion'
    ];

    protected $casts = [
        'edad' => 'integer'
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
