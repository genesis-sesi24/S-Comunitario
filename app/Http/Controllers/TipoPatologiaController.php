<?php

namespace App\Http\Controllers;

use App\Models\TipoPatologia;
use Illuminate\Http\Request;

class TipoPatologiaController extends Controller
{
    /**
     * Display a listing of all pathology types.
     */
    public function index()
    {
        $tipos = TipoPatologia::with('campos')->activo()->get();
        
        // Agregar el conteo de registros a cada tipo
        foreach ($tipos as $tipo) {
            $tipo->registros_count = $tipo->registrosCount();
        }
        
        return view('patologias.tipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new pathology type.
     */
    public function create()
    {
        return view('patologias.tipos.create');
    }

    /**
     * Store a newly created pathology type in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_patologias',
            'descripcion' => 'nullable|string',
            'color' => 'required|string|in:red,blue,green,purple,orange,indigo,pink,yellow',
            'icono' => 'nullable|string',
        ]);

        // Generate slug from nombre
        $slug = \Str::slug($validated['nombre']);
        
        // Check if slug already exists
        if (TipoPatologia::where('slug', $slug)->exists()) {
            return back()->withErrors(['nombre' => 'Ya existe un tipo de patología con este nombre.'])->withInput();
        }

        // Generate table name
        $tableName = 'patologia_' . $slug;
        
        // Check if table already exists
        if (\Schema::hasTable($tableName)) {
            return back()->withErrors(['nombre' => 'La tabla para este tipo ya existe en la base de datos.'])->withInput();
        }

        try {
            // Create the dynamic table
            \Schema::create($tableName, function ($table) {
                $table->id();
                $table->timestamps();
                $table->softDeletes();
            });

            // Create the TipoPatologia record
            $tipo = TipoPatologia::create([
                'nombre' => $validated['nombre'],
                'slug' => $slug,
                'descripcion' => $validated['descripcion'],
                'color' => $validated['color'],
                'icono' => $validated['icono'] ?? 'clipboard-list',
                'tabla_datos' => $tableName,
                'modelo' => 'App\\Models\\DynamicPatologia',
                'activo' => true,
            ]);

            return redirect()->route('patologias.tipos.show', $tipo->id)
                             ->with('success', 'Tipo de patología creado exitosamente. Ahora puedes agregar campos personalizados.');
        } catch (\Exception $e) {
            // Rollback table creation if TipoPatologia creation fails
            if (\Schema::hasTable($tableName)) {
                \Schema::dropIfExists($tableName);
            }
            
            return back()->withErrors(['error' => 'Error al crear el tipo de patología: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified pathology type.
     */
    public function show(TipoPatologia $tipo)
    {
        $tipo->load('campos');
        $tipo->registros_count = $tipo->registrosCount();
        
        return view('patologias.tipos.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified pathology type.
     */
    public function edit(TipoPatologia $tipo)
    {
        $tipo->load('campos');
        return view('patologias.tipos.edit', compact('tipo'));
    }

    /**
     * Update the specified pathology type in storage.
     */
    public function update(Request $request, TipoPatologia $tipo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:tipo_patologias,nombre,' . $tipo->id,
            'slug' => 'required|string|max:255|unique:tipo_patologias,slug,' . $tipo->id,
            'descripcion' => 'nullable|string',
            'icono' => 'nullable|string',
            'color' => 'required|string',
            'tabla_datos' => 'required|string',
            'modelo' => 'required|string',
            'activo' => 'boolean'
        ]);

        $tipo->update($validated);

        return redirect()->route('patologias.tipos.index')
                         ->with('success', 'Tipo de patología actualizado exitosamente.');
    }

    /**
     * Remove the specified pathology type from storage.
     */
    public function destroy(TipoPatologia $tipo)
    {
        try {
            // 1. Eliminar la tabla de datos asociada
            if (\Schema::hasTable($tipo->tabla_datos)) {
                \Schema::drop($tipo->tabla_datos);
            }

            // 2. Eliminar el registro del tipo
            $tipo->delete();

            return redirect()->route('patologias.tipos.index')
                             ->with('success', 'Tipo de patología y todos sus datos eliminados correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el tipo de patología: ' . $e->getMessage());
        }
    }
}
