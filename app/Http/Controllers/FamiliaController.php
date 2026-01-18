<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Vivienda;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Familia::with('vivienda.calle.sector');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('apellidos', 'like', "%{$search}%")
                  ->orWhereHas('vivienda', function($q) use ($search) {
                      $q->where('numero_casa', 'like', "%{$search}%");
                  });
        }

        $familias = $query->latest()->paginate(10);

        return view('familias.index', compact('familias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // En un caso real, probablemente filtrarías viviendas sin familia asignada o permitirías múltiples
        $viviendas = Vivienda::with('calle.sector')->get(); 
        return view('familias.create', compact('viviendas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apellidos' => 'required|string|max:255',
            'vivienda_id' => 'nullable|exists:viviendas,id',
            'numero_habitantes' => 'nullable|integer|min:0',
            'ingreso_mensual_aprox' => 'nullable|numeric|min:0',
        ]);

        Familia::create($validated);

        return redirect()->route('familias.index')
            ->with('success', 'Familia registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Familia $familia)
    {
        return view('familias.show', compact('familia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Familia $familia)
    {
        $viviendas = Vivienda::with('calle.sector')->get();
        return view('familias.edit', compact('familia', 'viviendas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Familia $familia)
    {
        $validated = $request->validate([
            'apellidos' => 'required|string|max:255',
            'vivienda_id' => 'nullable|exists:viviendas,id',
            'numero_habitantes' => 'nullable|integer|min:0',
            'ingreso_mensual_aprox' => 'nullable|numeric|min:0',
        ]);

        $familia->update($validated);

        return redirect()->route('familias.index')
            ->with('success', 'Datos de la familia actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Familia $familia)
    {
        $familia->delete();

        return redirect()->route('familias.index')
            ->with('success', 'Familia eliminada correctamente.');
    }
}
