<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Familia extends Model
{
    protected $fillable = [
        'vivienda_id',
        'apellidos',
        'ingreso_mensual_aprox'
    ];

    public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }

    public function integrantes(): HasMany
    {
        return $this->hasMany(User::class, 'familia_id');
    }

    public function fichaFamiliares(): HasMany
    {
        return $this->hasMany(FichaFamiliar::class);
    }
}
