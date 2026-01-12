<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = 'ajustes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'telefonos',
        'logo',
        'logo_Cm',
        'moneda',
        'correo',
        'pagina_web',
    ];

}
