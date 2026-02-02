<?php

namespace App\Http\Controllers;

use App\Models\TipoPatologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PatologiaRegistroController extends Controller
{
    /**
     * Display a listing of records for a specific pathology type.
     */
    public function index(Request $request, $tipoSlug)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $query = $model->newQuery();
        
        // Búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search, $tipo) {
                if ($tipo->slug === 'cardiovascular') {
                    $q->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%")
                      ->orWhere('cedula', 'like', "%{$search}%");
                } else {
                    // Búsqueda dinámica en los campos configurados
                    foreach ($tipo->campos as $campo) {
                        if (in_array($campo->tipo_campo, ['text', 'textarea', 'cedula', 'email', 'telefono'])) {
                            $q->orWhere($campo->nombre, 'like', "%{$search}%");
                        }
                    }
                }
            });
        }
        
        $registros = $query->orderBy('created_at', 'desc')->paginate(12);
        
        return view('patologias.registros.index', compact('tipo', 'registros'));
    }

    /**
     * Show the form for creating a new record.
     */
    public function create($tipoSlug)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        
        // Para tipos simples (Mental, Parkinson, Asma, Musculoes.), usar campos dinámicos
        // Para Cardiovascular, usar vista especializada
        if ($tipoSlug === 'cardiovascular') {
            return view('patologias.registros.form-cardiovascular', compact('tipo'));
        }
        
        $camposPorGrupo = $tipo->campos->groupBy('grupo');
        
        return view('patologias.registros.create', compact('tipo', 'camposPorGrupo'));
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request, $tipoSlug)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        // Construir reglas de validación dinámicas
        $rules = $this->buildValidationRules($tipo, $tipoSlug);
        $validated = $request->validate($rules);
        
        // Para el campo cedula, combinar cedula y cedula_tipo
        if (isset($validated['cedula']) && isset($validated['cedula_tipo'])) {
            // Ya están separados, no hacer nada
        }
        
        $registro = $model->create($validated);

        return redirect()->route('patologias.index', $tipoSlug)
                         ->with('success', 'Registro creado exitosamente.');
    }

    /**
     * Display the specified record.
     */
    public function show($tipoSlug, $id)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $registro = $model->findOrFail($id);
        
        if ($tipoSlug === 'cardiovascular') {
            return view('patologias.registros.show-cardiovascular', compact('tipo', 'registro'));
        }
        
        return view('patologias.registros.show', compact('tipo', 'registro'));
    }

    /**
     * Show the form for editing the specified record.
     */
    public function edit($tipoSlug, $id)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $registro = $model->findOrFail($id);
        
        if ($tipoSlug === 'cardiovascular') {
            return view('patologias.registros.form-cardiovascular', compact('tipo', 'registro'));
        }
        
        $camposPorGrupo = $tipo->campos->groupBy('grupo');
        
        return view('patologias.registros.edit', compact('tipo', 'registro', 'camposPorGrupo'));
    }

    /**
     * Update the specified record in storage.
     */
    public function update(Request $request, $tipoSlug, $id)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $registro = $model->findOrFail($id);
        
        // Construir reglas de validación dinámicas
        $rules = $this->buildValidationRules($tipo, $tipoSlug);
        $validated = $request->validate($rules);
        
        $registro->update($validated);

        return redirect()->route('patologias.index', $tipoSlug)
                         ->with('success', 'Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified record from storage.
     */
    public function destroy($tipoSlug, $id)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $registro = $model->findOrFail($id);
        $registro->delete();

        return redirect()->route('patologias.index', $tipoSlug)
                         ->with('success', 'Registro eliminado exitosamente.');
    }

    /**
     * Export record to PDF.
     */
    public function exportPdf($tipoSlug, $id)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $registro = $model->findOrFail($id);
        
        // Get system settings for PDF header
        $settings = \App\Models\Ajuste::first();
        
        // Generate PDF
        $viewName = $tipoSlug === 'cardiovascular' ? 'patologias.registros.pdf-cardiovascular' : 'patologias.registros.pdf';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($viewName, compact('tipo', 'registro', 'settings'));
        
        // Set paper and orientation
        $pdf->setPaper('letter', 'portrait');
        
        // Set options for better rendering
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);
        
        // Generate filename
        $filename = 'patologia_' . $tipoSlug . '_' . $registro->cedula . '_' . date('Ymd') . '.pdf';
        
        // Download PDF
        return $pdf->download($filename);
    }

    /**
     * Export records to Excel (CSV).
     */
    public function exportExcel($tipoSlug)
    {
        $tipo = TipoPatologia::where('slug', $tipoSlug)->with('campos')->firstOrFail();
        $model = $this->getModelClass($tipo);
        
        $filename = 'patologias_' . $tipoSlug . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        
        $columns = [];
        
        if ($tipoSlug === 'cardiovascular') {
            $columns = [
                'Nombre', 'Apellido', 'Cédula', 'Edad', 'Sexo', 'Teléfono', 'Dirección',
                'HTA', 'ERC', 'IAM', 'ACV', 'Dislipidemia', 'Fumador',
                'Medicamentos', 'Municipio', 'Centro Salud', 'Observaciones'
            ];
        } else {
            // Dynamic columns
            foreach ($tipo->campos as $campo) {
                $columns[] = $campo->etiqueta;
            }
            // Add timestamp
            $columns[] = 'Fecha Registro';
        }
        
        $callback = function() use ($model, $columns, $tipoSlug, $tipo) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel compatibility with UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns, ';');
            
            $query = $model->newQuery()->orderBy('created_at', 'desc');
            
            // Use cursor to minimize memory usage
            foreach ($query->cursor() as $registro) {
                $row = [];
                
                if ($tipoSlug === 'cardiovascular') {
                    $row = [
                        $registro->nombre,
                        $registro->apellido,
                        $registro->cedula_completa, // Accessor N-123456
                        $registro->edad,
                        $registro->sexo,
                        $registro->telefono,
                        $registro->direccion,
                        $registro->hta ? 'SI' : 'NO',
                        $registro->erc ? 'SI' : 'NO',
                        $registro->iam ? 'SI' : 'NO',
                        $registro->acv ? 'SI' : 'NO',
                        $registro->dislipidemia ? 'SI' : 'NO',
                        $registro->fumador ? 'SI' : 'NO',
                        implode(', ', $registro->medicamentos_activos ?? []),
                        $registro->municipio,
                        $registro->centro_salud,
                        $registro->observaciones
                    ];
                } else {
                    foreach ($tipo->campos as $campo) {
                        $val = $registro->{$campo->nombre} ?? '';
                        
                        if ($campo->tipo_campo === 'cedula') {
                             $val = ($registro->cedula_tipo ?? '') . '-' . ($registro->cedula ?? '');
                        } elseif ($campo->tipo_campo === 'checkbox' || is_bool($val)) {
                            $val = $val ? 'SI' : 'NO';
                        } elseif ($campo->tipo_campo === 'select' && isset($campo->opciones) && is_array($campo->opciones)) {
                            // Map key/index to label
                            if (isset($campo->opciones[$val])) {
                                $val = $campo->opciones[$val];
                            }
                        }
                        
                        $row[] = $val;
                    }
                    $row[] = $registro->created_at->format('d/m/Y H:i');
                }
                
                fputcsv($file, $row, ';');
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get the model class for a specific pathology type.
     */
    protected function getModelClass(TipoPatologia $tipo)
    {
        // Check if it's a dynamic pathology
        if ($tipo->modelo === 'App\Models\DynamicPatologia') {
            $model = new \App\Models\DynamicPatologia();
            $model->setTableName($tipo->tabla_datos);
            return $model;
        }
        
        // For specific models (like PatologiaMental, etc.)
        $modelClass = "App\\Models\\" . $tipo->modelo;
        
        if (!class_exists($modelClass)) {
            abort(500, "Modelo {$tipo->modelo} no encontrado.");
        }
        
        return new $modelClass();
    }

    /**
     * Build validation rules dynamically based on pathology type.
     */
    protected function buildValidationRules(TipoPatologia $tipo, $tipoSlug)
    {
        $rules = [];
        
        // Para tipos con campos dinámicos
        if ($tipoSlug !== 'cardiovascular') {
            foreach ($tipo->campos as $campo) {
                $fieldRules = [];
                
                if ($campo->requerido) {
                    $fieldRules[] = 'required';
                } else {
                    $fieldRules[] = 'nullable';
                }
                
                switch ($campo->tipo_campo) {
                    case 'text':
                    case 'textarea':
                        $fieldRules[] = 'string';
                        $fieldRules[] = 'max:500';
                        break;
                    case 'number':
                        $fieldRules[] = 'integer';
                        $fieldRules[] = 'min:0';
                        break;
                    case 'date':
                        $fieldRules[] = 'date';
                        break;
                    case 'select':
                        if (!empty($campo->opciones)) {
                            $fieldRules[] = 'in:' . implode(',', array_keys($campo->opciones));
                        }
                        break;
                    case 'cedula':
                        // cedula es el número, cedula_tipo es F o N
                        $rules['cedula'] = 'required|string|max:20';
                        $rules['cedula_tipo'] = 'required|in:N,J';
                        continue 2;
                }
                
                $rules[$campo->nombre] = implode('|', $fieldRules);
            }
        } else {
            // Reglas específicas para Cardiovascular
            $rules = [
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'cedula' => 'required|string|max:20',
                'cedula_tipo' => 'required|in:N,J',
                'edad' => 'required|integer|min:0|max:150',
                'sexo' => 'required|in:M,F',
                'direccion' => 'nullable|string|max:500',
                'telefono' => 'nullable|string|max:20',
                
                // Condiciones
                'hta' => 'boolean',
                'erc' => 'boolean',
                'iam' => 'boolean',
                'acv' => 'boolean',
                'dislipidemia' => 'boolean',
                'fumador' => 'boolean',
                
                // Medicamentos
                'aspirina' => 'boolean',
                'alfa_metildopa' => 'boolean',
                'amiodarona' => 'boolean',
                'amlodipino' => 'boolean',
                'amlodipino_dosis' => 'nullable|in:5mg,10mg',
                'atenolol' => 'boolean',
                'atenolol_dosis' => 'nullable|in:50mg,100mg',
                'atorvastatina' => 'boolean',
                'atorvastatina_dosis' => 'nullable|in:20mg,40mg',
                'captopril' => 'boolean',
                'captopril_dosis' => 'nullable|in:25mg,50mg',
                'carvedilol' => 'boolean',
                'carvedilol_dosis' => 'nullable|in:6.25mg,12.5mg',
                'clopidogrel' => 'boolean',
                'clopidogrel_dosis' => 'nullable|string',
                'dinitrato_isosorbide' => 'boolean',
                'enalapril' => 'boolean',
                'enalapril_dosis' => 'nullable|in:10mg,20mg',
                'digoxina' => 'boolean',
                'furosemida' => 'boolean',
                'losartan' => 'boolean',
                'losartan_dosis' => 'nullable|in:50mg,100mg',
                'sinvastatina' => 'boolean',
                'sinvastatina_dosis' => 'nullable|string',
                'verapamilo' => 'boolean',
                'otros_medicamentos' => 'nullable|string',
                
                // Ubicación
                'municipio' => 'nullable|string|max:255',
                'distrito' => 'nullable|string|max:255',
                'centro_salud' => 'nullable|string|max:255',
                'observaciones' => 'nullable|string'
            ];
        }
        
        return $rules;
    }
}
