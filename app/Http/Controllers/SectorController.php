<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Calle;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectores = Sector::with('calles')->withCount('calles')->orderBy('nombre')->get();
        return view('admin.sectores.index', compact('sectores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:sectores|max:255',
            'descripcion' => 'nullable|string'
        ]);

        Sector::create($validated);

        return redirect()->route('sectores.index')
            ->with('success', 'Sector creado exitosamente.');
    }

    public function storeCalle(Request $request, Sector $sector)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $sector->calles()->create($validated);

        return redirect()->route('sectores.index')
            ->with('success', 'Calle agregada exitosamente.');
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();
        return redirect()->route('sectores.index')
            ->with('success', 'Sector eliminado correctamente.');
    }
    
    public function destroyCalle(Calle $calle)
    {
        $calle->delete();
        return redirect()->back()
            ->with('success', 'Calle eliminada correctamente.');
    }
}
