<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatologiaMusculoesqueletico extends Model
{
    use SoftDeletes;

    protected $table = 'patologia_musculoesqueletico_registros';

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'sexo',
        'cedula',
        'cedula_tipo',
        'direccion',
        'telefono',
        'diagnostico',
        'tratamiento'
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
