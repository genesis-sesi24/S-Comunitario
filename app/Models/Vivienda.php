<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vivienda extends Model
{
    protected $fillable = [
        'calle_id',
        'numero_casa',
        'tipo_techo',
        'tipo_piso',
        'tipo_pared',
        'agua_potable',
        'aguas_servidas',
        'gas_directo',
        'insectos_roedores',
        'animales_domesticos',
        'hacinamiento'
    ];

    protected $casts = [
        'agua_potable' => 'boolean',
        'aguas_servidas' => 'boolean',
        'gas_directo' => 'boolean',
        'insectos_roedores' => 'boolean',
        'animales_domesticos' => 'boolean',
        'hacinamiento' => 'boolean',
    ];

    public function calle(): BelongsTo
    {
        return $this->belongsTo(Calle::class);
    }

    public function familias(): HasMany
    {
        return $this->hasMany(Familia::class);
    }
}
