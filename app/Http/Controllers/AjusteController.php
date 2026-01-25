<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;

class AjusteController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $ajuste = Ajuste::firstOrNew([], [
            'nombre' => 'Sistema Comunitario',
            'moneda' => 'USD',
            'descripcion' => 'Sistema de gestión para consejos comunales.',
            'direccion' => 'Dirección Principal',
            'telefonos' => '0000-0000000',
            'correo' => 'admin@sistema.com',
            'logo' => 'default-logo.png',
            'logo_Cm' => 'default-logo-sm.png',
        ]);

        return view('admin.ajustes.index', compact('ajuste')); 
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'direccion' => 'required|string',
            'telefonos' => 'required|string',
            'correo' => 'required|email',
            'moneda' => 'required|string|max:10',
            'pagina_web' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_Cm' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $ajuste = Ajuste::first();
        if (!$ajuste) {
            $ajuste = new Ajuste();
            // Set defaults for required fields if creating for first time and not in request (though validation handles required)
            $ajuste->logo = 'default-logo.png';
            $ajuste->logo_Cm = 'default-logo-sm.png';
        }

        $data = $request->except(['logo', 'logo_Cm']);

        // Handle Main Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old if not default
            if ($ajuste->logo && $ajuste->logo !== 'default-logo.png' && file_exists(public_path('storage/' . $ajuste->logo))) {
                unlink(public_path('storage/' . $ajuste->logo));
            }
            $filename = 'logo_' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('storage/uploads/settings'), $filename);
            $ajuste->logo = 'uploads/settings/' . $filename;
        }

        // Handle Secondary Logo Upload
        if ($request->hasFile('logo_Cm')) {
            if ($ajuste->logo_Cm && $ajuste->logo_Cm !== 'default-logo-sm.png' && file_exists(public_path('storage/' . $ajuste->logo_Cm))) {
                unlink(public_path('storage/' . $ajuste->logo_Cm));
            }
            $filename_cm = 'logo_sm_' . time() . '.' . $request->logo_Cm->getClientOriginalExtension();
            $request->logo_Cm->move(public_path('storage/uploads/settings'), $filename_cm);
            $ajuste->logo_Cm = 'uploads/settings/' . $filename_cm;
        }

        $ajuste->fill($data);
        $ajuste->save();

        return redirect()->route('admin.ajustes')->with('success', 'Configuración del sistema actualizada correctamente.');
    }
}
