@extends('layouts.admin')

@section('title', 'Nueva Familia')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('familias.index') }}" class="flex items-center text-sm text-slate-500 hover:text-slate-800 transition-colors mb-4 group w-fit">
            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mr-2 shadow-sm group-hover:border-slate-300 transition-all">
                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </div>
            <span class="font-medium">Volver al listado</span>
        </a>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-lg theme-bg-gradient" style="background-color: var(--theme-color);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900">Registrar Familia</h1>
                <p class="mt-1 text-slate-500">Complete la información para registrar un nuevo grupo familiar.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('familias.store') }}" method="POST">
            @csrf
            
            <div class="p-8 space-y-8">
                <!-- Sección: Información Principal -->
                <div>
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 rounded-full theme-bg" style="background-color: var(--theme-color);"></span>
                        Información General
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Apellidos -->
                        <div class="md:col-span-2">
                            <label for="apellidos" class="block text-sm font-bold text-slate-700 mb-2">Apellidos de la Familia <span class="text-red-500">*</span></label>
                            <input type="text" name="apellidos" id="apellidos" required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                onfocus="this.style.borderColor = 'var(--theme-color)'"
                                onblur="this.style.borderColor = 'transparent'"
                                placeholder="Ej. Familia Pérez Rodríguez" value="{{ old('apellidos') }}">
                            @error('apellidos')
                                <p class="mt-1 text-xs font-medium text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Número de Habitantes -->
                        <div>
                            <label for="numero_habitantes" class="block text-sm font-bold text-slate-700 mb-2">Número de Habitantes</label>
                            <div class="relative">
                                <input type="number" name="numero_habitantes" id="numero_habitantes" min="0"
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                    style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                    onfocus="this.style.borderColor = 'var(--theme-color)'"
                                    onblur="this.style.borderColor = 'transparent'"
                                    placeholder="Ej. 4" value="{{ old('numero_habitantes') }}">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                            </div>
                            @error('numero_habitantes')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ingresos -->
                        <div>
                            <label for="ingreso_mensual_aprox" class="block text-sm font-bold text-slate-700 mb-2">Ingreso Mensual Aprox.</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-bold">$</span>
                                </div>
                                <input type="number" name="ingreso_mensual_aprox" id="ingreso_mensual_aprox" min="0" step="0.01"
                                    class="w-full pl-8 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 transition-all text-sm"
                                    style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                                    onfocus="this.style.borderColor = 'var(--theme-color)'"
                                    onblur="this.style.borderColor = 'transparent'"
                                    placeholder="0.00" value="{{ old('ingreso_mensual_aprox') }}">
                            </div>
                            @error('ingreso_mensual_aprox')
                                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('familias.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-white hover:shadow-sm transition-all text-sm">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2.5 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 theme-bg-gradient" 
                        style="background-color: var(--theme-color); box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color) 25%, transparent);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Guardar Familia
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
