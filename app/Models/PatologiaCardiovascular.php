<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatologiaCardiovascular extends Model
{
    use SoftDeletes;

    protected $table = 'patologia_cardiovascular_registros';

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'cedula_tipo',
        'edad',
        'sexo',
        'direccion',
        'telefono',
        // Condiciones
        'hta',
        'erc',
        'iam',
        'acv',
        'dislipidemia',
        // Hábitos
        'fumador',
        // Medicamentos
        'aspirina',
        'alfa_metildopa',
        'amiodarona',
        'amlodipino',
        'amlodipino_dosis',
        'atenolol',
        'atenolol_dosis',
        'atorvastatina',
        'atorvastatina_dosis',
        'captopril',
        'captopril_dosis',
        'carvedilol',
        'carvedilol_dosis',
        'clopidogrel',
        'clopidogrel_dosis',
        'dinitrato_isosorbide',
        'enalapril',
        'enalapril_dosis',
        'digoxina',
        'furosemida',
        'losartan',
        'losartan_dosis',
        'sinvastatina',
        'sinvastatina_dosis',
        'verapamilo',
        'otros_medicamentos',
        // Ubicación
        'municipio',
        'distrito',
        'centro_salud',
        // Otros
        'observaciones'
    ];

    protected $casts = [
        'edad' => 'integer',
        'hta' => 'boolean',
        'erc' => 'boolean',
        'iam' => 'boolean',
        'acv' => 'boolean',
        'dislipidemia' => 'boolean',
        'fumador' => 'boolean',
        'aspirina' => 'boolean',
        'alfa_metildopa' => 'boolean',
        'amiodarona' => 'boolean',
        'amlodipino' => 'boolean',
        'atenolol' => 'boolean',
        'atorvastatina' => 'boolean',
        'captopril' => 'boolean',
        'carvedilol' => 'boolean',
        'clopidogrel' => 'boolean',
        'dinitrato_isosorbide' => 'boolean',
        'enalapril' => 'boolean',
        'digoxina' => 'boolean',
        'furosemida' => 'boolean',
        'losartan' => 'boolean',
        'sinvastatina' => 'boolean',
        'verapamilo' => 'boolean'
    ];

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    public function getCedulaCompletaAttribute()
    {
        return $this->cedula_tipo . '-' . $this->cedula;
    }

    /**
     * Obtiene todas las condiciones activas del paciente
     */
    public function getCondicionesActivasAttribute()
    {
        $condiciones = [];
        if ($this->hta) $condiciones[] = 'HTA';
        if ($this->erc) $condiciones[] = 'ERC';
        if ($this->iam) $condiciones[] = 'IAM';
        if ($this->acv) $condiciones[] = 'ACV';
        if ($this->dislipidemia) $condiciones[] = 'Dislipidemia';
        return $condiciones;
    }

    /**
     * Obtiene todos los medicamentos activos del paciente
     */
    public function getMedicamentosActivosAttribute()
    {
        $medicamentos = [];
        
        if ($this->aspirina) $medicamentos[] = 'Aspirina';
        if ($this->alfa_metildopa) $medicamentos[] = 'Alfa-metildopa';
        if ($this->amiodarona) $medicamentos[] = 'Amiodarona';
        if ($this->amlodipino) $medicamentos[] = 'Amlodipino ' . ($this->amlodipino_dosis ?? '');
        if ($this->atenolol) $medicamentos[] = 'Atenolol ' . ($this->atenolol_dosis ?? '');
        if ($this->atorvastatina) $medicamentos[] = 'Atorvastatina ' . ($this->atorvastatina_dosis ?? '');
        if ($this->captopril) $medicamentos[] = 'Captopril ' . ($this->captopril_dosis ?? '');
        if ($this->carvedilol) $medicamentos[] = 'Carvedilol ' . ($this->carvedilol_dosis ?? '');
        if ($this->clopidogrel) $medicamentos[] = 'Clopidogrel ' . ($this->clopidogrel_dosis ?? '');
        if ($this->dinitrato_isosorbide) $medicamentos[] = 'Dinitrato de Isosorbide';
        if ($this->enalapril) $medicamentos[] = 'Enalapril ' . ($this->enalapril_dosis ?? '');
        if ($this->digoxina) $medicamentos[] = 'Digoxina';
        if ($this->furosemida) $medicamentos[] = 'Furosemida';
        if ($this->losartan) $medicamentos[] = 'Losartán ' . ($this->losartan_dosis ?? '');
        if ($this->sinvastatina) $medicamentos[] = 'Sinvastatina ' . ($this->sinvastatina_dosis ?? '');
        if ($this->verapamilo) $medicamentos[] = 'Verapamilo';
        
        return $medicamentos;
    }
}
