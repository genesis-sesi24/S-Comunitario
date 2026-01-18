<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Integrante extends Model
{
    protected $fillable = [
        'familia_id',
        'name',
        'apellido',
        'cedula',
        'fecha_nacimiento',
        'sexo',
        'escolaridad',
        'parentesco',
        'grupo_dispensarial',
        'patologias'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function familia(): BelongsTo
    {
        return $this->belongsTo(Familia::class);
    }
}
