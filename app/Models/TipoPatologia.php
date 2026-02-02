<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoPatologia extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'color',
        'tabla_datos',
        'modelo',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    /**
     * Relación con los campos de este tipo de patología
     */
    public function campos()
    {
        return $this->hasMany(PatologiaCampo::class)->orderBy('orden');
    }

    /**
     * Obtiene el conteo de registros de este tipo de patología
     */
    public function registrosCount()
    {
        try {
            return DB::table($this->tabla_datos)->whereNull('deleted_at')->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Obtiene la instancia del modelo específico de esta patología
     */
    public function getModelInstance()
    {
        $modelClass = "App\\Models\\" . $this->modelo;
        if (class_exists($modelClass)) {
            return new $modelClass();
        }
        return null;
    }

    /**
     * Scope para tipos activos
     */
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }
}
