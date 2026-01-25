@extends('layouts.admin')

@section('title', 'Ajustes del Sistema')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold text-slate-900">Configuración del Sistema</h1>
        <p class="mt-2 text-slate-600">Personalice la información general y apariencia de la aplicación.</p>
    </div>

    <form action="{{ route('admin.ajustes.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: General Info -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Información General
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nombre del Sistema</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $ajuste->nombre) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Descripción</label>
                            <textarea name="descripcion" rows="3" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">{{ old('descripcion', $ajuste->descripcion) }}</textarea>
                            @error('descripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Moneda Principal</label>
                            <input type="text" name="moneda" value="{{ old('moneda', $ajuste->moneda) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('moneda') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Contacto
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion', $ajuste->direccion) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('direccion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Teléfonos</label>
                            <input type="text" name="telefonos" value="{{ old('telefonos', $ajuste->telefonos) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('telefonos') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Correo Electrónico</label>
                            <input type="email" name="correo" value="{{ old('correo', $ajuste->correo) }}" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('correo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Sitio Web (Opcional)</label>
                            <input type="url" name="pagina_web" value="{{ old('pagina_web', $ajuste->pagina_web) }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent);">
                            @error('pagina_web') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Branding -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 sticky top-24">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Identidad Visual
                    </h3>

                    <!-- Main Logo -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-4">Logo Principal</label>
                        <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer relative" onclick="document.getElementById('logoInput').click()">
                            @if($ajuste->logo && $ajuste->logo != 'default-logo.png')
                                <img src="{{ asset('storage/' . $ajuste->logo) }}" class="h-20 object-contain mb-4" alt="Logo">
                            @else
                                <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <p class="text-sm text-slate-500 font-medium">Click para cambiar</p>
                            <p class="text-xs text-slate-400 mt-1">PNG, JPG (Max 2MB)</p>
                            <input type="file" name="logo" id="logoInput" class="hidden" accept="image/*">
                        </div>
                        @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Secondary Logo -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-4">Logo Secundario / Icono</label>
                        <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer relative" onclick="document.getElementById('logoCmInput').click()">
                            @if($ajuste->logo_Cm && $ajuste->logo_Cm != 'default-logo-sm.png')
                                <img src="{{ asset('storage/' . $ajuste->logo_Cm) }}" class="h-12 object-contain mb-4" alt="Logo CM">
                            @else
                                <div class="w-12 h-12 bg-slate-200 rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <p class="text-sm text-slate-500 font-medium">Click para cambiar</p>
                            <input type="file" name="logo_Cm" id="logoCmInput" class="hidden" accept="image/*">
                        </div>
                        @error('logo_Cm') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full px-6 py-4 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 theme-bg-gradient" 
                            style="background-color: var(--theme-color); box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color) 25%, transparent);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection