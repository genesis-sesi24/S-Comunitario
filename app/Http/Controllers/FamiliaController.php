<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Manzana;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Familia::with('manzana');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('apellidos', 'like', "%{$search}%")
                  ->orWhere('numero_casa', 'like', "%{$search}%")
                  ->orWhereHas('manzana', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
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
        $manzanas = Manzana::orderBy('nombre')->get();
        return view('familias.create', compact('manzanas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apellidos' => 'required|string|max:255',
            'manzana_id' => 'required|exists:manzanas,id',
            'numero_casa' => 'nullable|string|max:255',
            'calle_transversal' => 'nullable|string|max:255',
            'numero_habitantes' => 'nullable|integer|min:0',
            'numero_habitantes' => 'nullable|integer|min:0',
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
        $manzanas = Manzana::orderBy('nombre')->get();
        return view('familias.edit', compact('familia', 'manzanas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Familia $familia)
    {
        $validated = $request->validate([
            'apellidos' => 'required|string|max:255',
            'manzana_id' => 'required|exists:manzanas,id',
            'numero_casa' => 'nullable|string|max:255',
            'calle_transversal' => 'nullable|string|max:255',
            'numero_habitantes' => 'nullable|integer|min:0',
            'numero_habitantes' => 'nullable|integer|min:0',
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
