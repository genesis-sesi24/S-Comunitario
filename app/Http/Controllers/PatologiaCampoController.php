<?php

namespace App\Http\Controllers;

use App\Models\TipoPatologia;
use App\Models\PatologiaCampo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class PatologiaCampoController extends Controller
{
    /**
     * Add a new field to a pathology type.
     */
    public function store(Request $request, TipoPatologia $tipo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'etiqueta' => 'required|string|max:255',
            'tipo_campo' => 'required|string|in:text,number,select,checkbox,date,textarea,cedula,email,telefono',
            'opciones' => 'nullable|array',
            'requerido' => 'boolean',
            'grupo' => 'nullable|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'ayuda' => 'nullable|string',
            'validacion' => 'nullable|array',
        ]);

        // Generate column name from field name
        $columnName = \Str::snake($validated['nombre']);
        
        // Check if field already exists
        if ($tipo->campos()->where('nombre', $columnName)->exists()) {
            return back()->withErrors(['nombre' => 'Ya existe un campo con este nombre.']);
        }

        try {
            // Add column to the dynamic table
            Schema::table($tipo->tabla_datos, function (Blueprint $table) use ($validated, $columnName) {
                switch ($validated['tipo_campo']) {
                    case 'text':
                    case 'email':
                    case 'telefono':
                        $table->string($columnName)->nullable();
                        break;
                    case 'number':
                        $table->integer($columnName)->nullable();
                        break;
                    case 'textarea':
                        $table->text($columnName)->nullable();
                        break;
                    case 'date':
                        $table->date($columnName)->nullable();
                        break;
                    case 'checkbox':
                        $table->boolean($columnName)->default(false);
                        break;
                    case 'select':
                        $table->string($columnName)->nullable();
                        break;
                    case 'cedula':
                        // For cedula, create two columns: cedula and cedula_tipo
                        $table->string($columnName)->nullable();
                        $table->enum($columnName . '_tipo', ['N', 'J', 'E', 'F'])->default('N');
                        break;
                }
            });

            // Get the current maximum orden value
            $maxOrden = $tipo->campos()->max('orden') ?? 0;

            // Process options if they exist (split by comma)
            $opciones = null;
            if (!empty($validated['opciones']) && is_array($validated['opciones'])) {
                // If it's an array with one element containing commas, split it
                if (count($validated['opciones']) === 1 && strpos($validated['opciones'][0], ',') !== false) {
                    $opciones = array_map('trim', explode(',', $validated['opciones'][0]));
                } else {
                    $opciones = $validated['opciones'];
                }
            }

            // Create the PatologiaCampo record
            $campo = $tipo->campos()->create([
                'nombre' => $columnName,
                'etiqueta' => $validated['etiqueta'],
                'tipo_campo' => $validated['tipo_campo'],
                'opciones' => $opciones,
                'requerido' => $validated['requerido'] ?? false,
                'orden' => $maxOrden + 1,
                'grupo' => $validated['grupo'] ?? 'General',
                'placeholder' => $validated['placeholder'] ?? null,
                'ayuda' => $validated['ayuda'] ?? null,
                'validacion' => $validated['validacion'] ?? null,
            ]);

            return back()->with('success', 'Campo agregado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al agregar el campo: ' . $e->getMessage()]);
        }
    }

    /**
     * Update an existing field.
     */
    public function update(Request $request, PatologiaCampo $campo)
    {
        $validated = $request->validate([
            'etiqueta' => 'required|string|max:255',
            'opciones' => 'nullable|array',
            'requerido' => 'boolean',
            'grupo' => 'nullable|string|max:255',
            'placeholder' => 'nullable|string|max:255',
            'ayuda' => 'nullable|string',
            'validacion' => 'nullable|array',
            'orden' => 'nullable|integer',
        ]);

        // Process options if they exist (split by comma)
        if (isset($validated['opciones'])) {
            if (is_array($validated['opciones']) && count($validated['opciones']) === 1 && strpos($validated['opciones'][0], ',') !== false) {
                $validated['opciones'] = array_map('trim', explode(',', $validated['opciones'][0]));
            }
        }

        $campo->update($validated);

        return back()->with('success', 'Campo actualizado exitosamente.');
    }

    /**
     * Delete a field from a pathology type.
     */
    public function destroy(PatologiaCampo $campo)
    {
        $tipo = $campo->tipoPatologia;
        $columnName = $campo->nombre;

        try {
            $tableName = $tipo->tabla_datos;
            
            // Drop the column from the table
            Schema::table($tableName, function (Blueprint $table) use ($columnName, $campo, $tableName) {
                if ($campo->tipo_campo === 'cedula') {
                    // Drop both cedula columns
                    if (Schema::hasColumn($tableName, $columnName)) {
                        $table->dropColumn($columnName);
                    }
                    if (Schema::hasColumn($tableName, $columnName . '_tipo')) {
                        $table->dropColumn($columnName . '_tipo');
                    }
                } else {
                    if (Schema::hasColumn($tableName, $columnName)) {
                        $table->dropColumn($columnName);
                    }
                }
            });

            // Delete the campo record
            $campo->delete();

            return back()->with('success', 'Campo eliminado exitosamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el campo: ' . $e->getMessage()]);
        }
    }
}
