<?php

namespace App\Http\Controllers;

use App\Models\Manzana;
use Illuminate\Http\Request;

class ManzanaController extends Controller
{
    public function index(Request $request)
    {
        $query = Manzana::withCount('familias');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
        }

        $manzanas = $query->orderBy('nombre')->get();
        return view('admin.manzanas.index', compact('manzanas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:manzanas|max:255',
            'descripcion' => 'nullable|string'
        ]);

        Manzana::create($validated);

        return redirect()->route('manzanas.index')
            ->with('success', 'Manzana creada exitosamente.');
    }

    public function update(Request $request, Manzana $manzana)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:manzanas,nombre,' . $manzana->id,
            'descripcion' => 'nullable|string'
        ]);

        $manzana->update($validated);

        return redirect()->route('manzanas.index')
            ->with('success', 'Manzana actualizada correctamente.');
    }

    public function destroy(Manzana $manzana)
    {
        $manzana->delete();
        return redirect()->route('manzanas.index')
            ->with('success', 'Manzana eliminada correctamente.');
    }
}
