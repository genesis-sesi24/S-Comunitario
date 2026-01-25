<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Familia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vivienda_id',
        'apellidos',
        'numero_habitantes',
        'ingreso_mensual_aprox'
    ];

    public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }

    public function integrantes(): HasMany
    {
        return $this->hasMany(Integrante::class, 'familia_id');
    }

    public function fichaFamiliares(): HasMany
    {
        return $this->hasMany(FichaFamiliar::class);
    }
}
