<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Generic model for dynamically-created pathology tables.
 * Sets its table name at runtime based on TipoPatologia configuration.
 */
class DynamicPatologia extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Set the table associated with the model at runtime.
     *
     * @param  string  $table
     * @return $this
     */
    public function setTableName($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Get the cedula completa (tipo-numero).
     *
     * @return string
     */
    public function getCedulaCompletaAttribute()
    {
        if (isset($this->attributes['cedula_tipo']) && isset($this->attributes['cedula'])) {
            return $this->attributes['cedula_tipo'] . '-' . $this->attributes['cedula'];
        }
        return $this->attributes['cedula'] ?? '';
    }
}
