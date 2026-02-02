<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatologiaCampo extends Model
{
    protected $fillable = [
        'tipo_patologia_id',
        'nombre',
        'etiqueta',
        'tipo_campo',
        'opciones',
        'requerido',
        'orden',
        'grupo',
        'placeholder',
        'ayuda',
        'validacion'
    ];

    protected $casts = [
        'opciones' => 'array',
        'validacion' => 'array',
        'requerido' => 'boolean'
    ];

    /**
     * Relación con el tipo de patología
     */
    public function tipoPatologia()
    {
        return $this->belongsTo(TipoPatologia::class);
    }

    /**
     * Obtiene las reglas de validación de Laravel para este campo
     */
    public function getValidationRule()
    {
        $rules = [];

        if ($this->requerido) {
            $rules[] = 'required';
        } else {
            $rules[] = 'nullable';
        }

        switch ($this->tipo_campo) {
            case 'text':
            case 'textarea':
                $rules[] = 'string';
                if (isset($this->validacion['max'])) {
                    $rules[] = 'max:' . $this->validacion['max'];
                }
                break;
            case 'number':
                $rules[] = 'numeric';
                if (isset($this->validacion['min'])) {
                    $rules[] = 'min:' . $this->validacion['min'];
                }
                if (isset($this->validacion['max'])) {
                    $rules[] = 'max:' . $this->validacion['max'];
                }
                break;
            case 'date':
                $rules[] = 'date';
                break;
            case 'select':
                if (!empty($this->opciones)) {
                    $rules[] = 'in:' . implode(',', array_keys($this->opciones));
                }
                break;
            case 'checkbox':
                $rules[] = 'boolean';
                break;
            case 'cedula':
                $rules[] = 'string';
                $rules[] = 'max:20';
                break;
        }

        return implode('|', $rules);
    }
}
