<?php

namespace App\Http\Controllers;

use App\Models\FichaFamiliar;
use App\Models\Familia;
use Illuminate\Http\Request;

class FichaFamiliarController extends Controller
{
    public function index(Familia $familia)
    {
        $fichas = $familia->fichaFamiliares()->latest()->get();
        return view('fichas.index', compact('familia', 'fichas'));
    }

    public function create(Familia $familia)
    {
        return view('fichas.create', compact('familia'));
    }

    public function store(Request $request, Familia $familia)
    {
        $validated = $request->validate([
            'asic' => 'nullable|string|max:255',
            'consultorio' => 'nullable|string|max:255',
            'numero_hc' => 'nullable|string|max:255',
            'direccion' => 'nullable|string',
            'estado' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'parroquia' => 'nullable|string|max:255',
            'numero_miembros' => 'nullable|in:pequena,mediana,grande',
            'antecedentes_familia' => 'nullable|in:nuclear,extensa,ampliada',
            'numero_generaciones' => 'nullable|in:unigeneracional,bigeneracional,trigeneracional,multigeneracional',
            'etapa_desarrollo' => 'nullable|in:formacion,contraccion,extension,disolucion',
            'ingreso_percapita' => 'nullable|numeric|min:0',
            'numero_trabajadores' => 'nullable|integer|min:0',
            'cocina_gas' => 'boolean',
            'cocina_electrica' => 'boolean',
            'cocina_lena' => 'boolean',
            'cocina_otra' => 'nullable|string|max:255',
            'tiene_refrigerador' => 'boolean',
            'tiene_televisor' => 'boolean',
            'tiene_ventilador' => 'boolean',
            'otros_equipos' => 'nullable|string|max:255',
            'tipo_vivienda' => 'nullable|in:casa,apartamento,habitacion,rancho,palafito,otros',
            'tipo_vivienda_otros' => 'nullable|string|max:255',
            'material_construccion' => 'nullable|in:bloque,madera,bahareque,carton,zinc,otros',
            'material_otros' => 'nullable|string|max:255',
            'tipo_techo' => 'nullable|in:placa,asbesto,acerolit,guano,zinc,otros',
            'techo_otros' => 'nullable|string|max:255',
            'tipo_piso' => 'nullable|in:losas,cemento,tierra,madera,otros',
            'piso_otros' => 'nullable|string|max:255',
            'estado_constructivo' => 'nullable|in:buena,regular,mala',
            'hacinamiento' => 'boolean',
            'numero_habitantes' => 'nullable|integer|min:0',
            'numero_habitaciones' => 'nullable|integer|min:0',
            'servicio_electrico' => 'boolean',
            'abasto_agua' => 'nullable|in:pozos,acueducto,manantial,rio,otros',
            'agua_otros' => 'nullable|string|max:255',
            'bano_sanitario' => 'nullable|in:bano,letrina,no_posee,otros',
            'bano_otros' => 'nullable|string|max:255',
            'destino_residuales' => 'nullable|in:alcantarillado,pozos_septico,otros',
            'residuales_otros' => 'nullable|string|max:255',
            'destino_desechos' => 'nullable|in:recogida_local,vertederos,otros',
            'desechos_otros' => 'nullable|string|max:255',
            'tiene_perros' => 'boolean',
            'tiene_gatos' => 'boolean',
            'otros_animales' => 'nullable|string|max:255',
            'vectores' => 'nullable|string|max:255',
            'discusion_evaluacion' => 'nullable|string',
        ]);

        $validated['familia_id'] = $familia->id;
        FichaFamiliar::create($validated);

        return redirect()->route('familias.fichas.index', $familia)
            ->with('success', 'Ficha familiar creada exitosamente.');
    }

    public function show(Familia $familia, FichaFamiliar $ficha)
    {
        return view('fichas.show', compact('familia', 'ficha'));
    }

    public function edit(Familia $familia, FichaFamiliar $ficha)
    {
        return view('fichas.edit', compact('familia', 'ficha'));
    }

    public function update(Request $request, Familia $familia, FichaFamiliar $ficha)
    {
        $validated = $request->validate([
            'asic' => 'nullable|string|max:255',
            'consultorio' => 'nullable|string|max:255',
            'numero_hc' => 'nullable|string|max:255',
            'direccion' => 'nullable|string',
            'estado' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'parroquia' => 'nullable|string|max:255',
            'numero_miembros' => 'nullable|in:pequena,mediana,grande',
            'antecedentes_familia' => 'nullable|in:nuclear,extensa,ampliada',
            'numero_generaciones' => 'nullable|in:unigeneracional,bigeneracional,trigeneracional,multigeneracional',
            'etapa_desarrollo' => 'nullable|in:formacion,contraccion,extension,disolucion',
            'ingreso_percapita' => 'nullable|numeric|min:0',
            'numero_trabajadores' => 'nullable|integer|min:0',
            'cocina_gas' => 'boolean',
            'cocina_electrica' => 'boolean',
            'cocina_lena' => 'boolean',
            'cocina_otra' => 'nullable|string|max:255',
            'tiene_refrigerador' => 'boolean',
            'tiene_televisor' => 'boolean',
            'tiene_ventilador' => 'boolean',
            'otros_equipos' => 'nullable|string|max:255',
            'tipo_vivienda' => 'nullable|in:casa,apartamento,habitacion,rancho,palafito,otros',
            'tipo_vivienda_otros' => 'nullable|string|max:255',
            'material_construccion' => 'nullable|in:bloque,madera,bahareque,carton,zinc,otros',
            'material_otros' => 'nullable|string|max:255

',
            'tipo_techo' => 'nullable|in:placa,asbesto,acerolit,guano,zinc,otros',
            'techo_otros' => 'nullable|string|max:255',
            'tipo_piso' => 'nullable|in:losas,cemento,tierra,madera,otros',
            'piso_otros' => 'nullable|string|max:255',
            'estado_constructivo' => 'nullable|in:buena,regular,mala',
            'hacinamiento' => 'boolean',
            'numero_habitantes' => 'nullable|integer|min:0',
            'numero_habitaciones' => 'nullable|integer|min:0',
            'servicio_electrico' => 'boolean',
            'abasto_agua' => 'nullable|in:pozos,acueducto,manantial,rio,otros',
            'agua_otros' => 'nullable|string|max:255',
            'bano_sanitario' => 'nullable|in:bano,letrina,no_posee,otros',
            'bano_otros' => 'nullable|string|max:255',
            'destino_residuales' => 'nullable|in:alcantarillado,pozos_septico,otros',
            'residuales_otros' => 'nullable|string|max:255',
            'destino_desechos' => 'nullable|in:recogida_local,vertederos,otros',
            'desechos_otros' => 'nullable|string|max:255',
            'tiene_perros' => 'boolean',
            'tiene_gatos' => 'boolean',
            'otros_animales' => 'nullable|string|max:255',
            'vectores' => 'nullable|string|max:255',
            'discusion_evaluacion' => 'nullable|string',
        ]);

        $ficha->update($validated);

        return redirect()->route('familias.fichas.index', $familia)
            ->with('success', 'Ficha familiar actualizada correctamente.');
    }

    public function destroy(Familia $familia, FichaFamiliar $ficha)
    {
        $ficha->delete();

        return redirect()->route('familias.fichas.index', $familia)
            ->with('success', 'Ficha familiar eliminada correctamente.');
    }
}
