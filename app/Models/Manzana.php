<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manzana extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'manzanas';
    
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function familias(): HasMany
    {
        return $this->hasMany(Familia::class);
    }
}
