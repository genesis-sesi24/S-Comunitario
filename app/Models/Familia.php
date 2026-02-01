<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Familia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'manzana_id',
        'numero_casa',
        'calle_transversal',
        'apellidos',
        'numero_habitantes',
        'numero_habitantes'
    ];

    public function manzana(): BelongsTo
    {
        return $this->belongsTo(Manzana::class);
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
