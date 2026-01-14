<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FichaFamiliar extends Model
{
    protected $fillable = [
        'familia_id',
        // Datos de Identificación
        'asic',
        'consultorio',
        'numero_hc',
        'direccion',
        'estado',
        'municipio',
        'parroquia',
        // Clasificación
        'numero_miembros',
        'antecedentes_familia',
        'numero_generaciones',
        'etapa_desarrollo',
        // Socioeconómicas
        'ingreso_percapita',
        'numero_trabajadores',
        'cocina_gas',
        'cocina_electrica',
        'cocina_lena',
        'cocina_otra',
        'tiene_refrigerador',
        'tiene_televisor',
        'tiene_ventilador',
        'otros_equipos',
        // Estructurales
        'tipo_vivienda',
        'tipo_vivienda_otros',
        'material_construccion',
        'material_otros',
        'tipo_techo',
        'techo_otros',
        'tipo_piso',
        'piso_otros',
        'estado_constructivo',
        'hacinamiento',
        'numero_habitantes',
        'numero_habitaciones',
        'servicio_electrico',
        'abasto_agua',
        'agua_otros',
        'bano_sanitario',
        'bano_otros',
        'destino_residuales',
        'residuales_otros',
        'destino_desechos',
        'desechos_otros',
        'tiene_perros',
        'tiene_gatos',
        'otros_animales',
        'vectores',
        // Evaluación
        'discusion_evaluacion',
    ];

    protected $casts = [
        'ingreso_percapita' => 'decimal:2',
        'numero_trabajadores' => 'integer',
        'numero_habitantes' => 'integer',
        'numero_habitaciones' => 'integer',
        'cocina_gas' => 'boolean',
        'cocina_electrica' => 'boolean',
        'cocina_lena' => 'boolean',
        'tiene_refrigerador' => 'boolean',
        'tiene_televisor' => 'boolean',
        'tiene_ventilador' => 'boolean',
        'hacinamiento' => 'boolean',
        'servicio_electrico' => 'boolean',
        'tiene_perros' => 'boolean',
        'tiene_gatos' => 'boolean',
    ];

    public function familia(): BelongsTo
    {
        return $this->belongsTo(Familia::class);
    }
}
