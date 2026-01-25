@extends('layouts.admin')

@section('title', 'Gestión de Sectores')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <h1 class="text-3xl font-display font-bold text-slate-800">Organización Territorial</h1>
        <p class="text-slate-500 mt-2 text-lg text-balance">Administra los sectores y calles que conforman tu comunidad.</p>
    </div>
    <button type="button" onclick="openModal('createSectorModal')" class="inline-flex items-center justify-center px-6 py-3 theme-bg-gradient text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300" style="box-shadow: 0 10px 25px color-mix(in srgb, var(--theme-color) 20%, transparent); background-color: var(--theme-color);">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Nuevo Sector
    </button>
</div>

@if($sectores->isEmpty())
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-16 text-center max-w-2xl mx-auto">
        <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">No hay sectores registrados</h3>
        <p class="text-slate-500 mb-8 leading-relaxed">Comienza definiendo la estructura geográfica de tu comunidad para poder registrar familias y realizar censos.</p>
        <button type="button" onclick="openModal('createSectorModal')" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
            Crear Primer Sector
        </button>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($sectores as $sector)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group overflow-hidden border-t-4" style="border-top-color: var(--theme-color);">
            
            <!-- Sector Header -->
            <div class="p-6 flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $sector->nombre }}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-500 border border-slate-200/50">
                            {{ $sector->calles_count }} {{ $sector->calles_count == 1 ? 'Calle' : 'Calles' }}
                        </span>
                    </div>
                </div>
                
                <div class="relative group/menu">
                    <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-slate-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 z-10 opacity-0 invisible group-hover/menu:opacity-100 group-hover/menu:visible transition-all scale-95 group-hover/menu:scale-100 origin-top-right">
                        <div class="p-1.5">
                            <button type="button" onclick="openModal('deleteSectorModal-{{ $sector->id }}')" class="w-full text-left px-4 py-2 text-sm text-red-600 font-semibold hover:bg-red-50 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Eliminar Sector
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Banner -->
            @if($sector->descripcion)
                <div class="px-6 py-3 bg-slate-50/80 border-y border-slate-100">
                    <p class="text-xs text-slate-500 font-medium line-clamp-2 leading-relaxed italic">{{ $sector->descripcion }}</p>
                </div>
            @endif

            <!-- Streets List Section -->
            <div class="p-6 flex-1 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Listado de Calles</h4>
                    <span class="w-8 h-[1px] bg-slate-100"></span>
                </div>

                <div class="flex-1 overflow-y-auto pr-1 custom-scrollbar mb-6" style="max-height: 220px;">
                    <ul class="space-y-2">
                        @forelse($sector->calles as $calle)
                            <li class="flex items-center justify-between py-2 px-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-all group/item">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full theme-bg group-hover/item:scale-125 transition-transform"></div>
                                    <span class="text-sm font-semibold text-slate-700">{{ $calle->nombre }}</span>
                                </div>
                                <button type="button" onclick="openModal('deleteCalleModal-{{ $calle->id }}')" class="opacity-0 group-hover/item:opacity-100 p-1.5 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Eliminar calle">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                
                                <x-confirm-modal 
                                    id="deleteCalleModal-{{ $calle->id }}" 
                                    title="¿Eliminar Calle?" 
                                    message="¿Estás seguro de eliminar la calle '{{ $calle->nombre }}'? Esto afectará la ubicación de las familias asociadas." 
                                    action="{{ route('calles.destroy', $calle) }}" 
                                    confirmText="Sí, Eliminar"
                                />
                            </li>
                        @empty
                            <li class="flex flex-col items-center justify-center py-6 px-4 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                                <svg class="w-8 h-8 text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.487V6a2 2 0 011.106-1.789l5.447-2.724a2 2 0 011.894 0l5.447 2.724A2 2 0 0118 5.487V15a2 2 0 01-1.106 1.789L11.447 19.513a2 2 0 01-1.894 0z"/></svg>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest text-center italic">Sin calles para mostrar</span>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Add Street Form -->
                <form action="{{ route('sectores.calles.store', $sector) }}" method="POST" class="mt-auto pt-4 border-t border-slate-50">
                    @csrf
                    <div class="relative group/input">
                        <input type="text" name="nombre" placeholder="Añadir nueva calle..." required 
                               class="w-full pl-4 pr-12 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:outline-none focus:ring-2 focus:bg-white transition-all placeholder-slate-400"
                               style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                               onfocus="this.style.borderColor = 'var(--theme-color)'"
                               onblur="this.style.borderColor = 'transparent'">
                        <button type="submit" class="absolute right-1.5 top-1.5 w-8 h-8 rounded-lg bg-white border border-slate-100 shadow-sm flex items-center justify-center theme-text hover:bg-slate-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Modals specific to this sector -->
            <x-confirm-modal 
                id="deleteSectorModal-{{ $sector->id }}" 
                title="¿Eliminar Sector?" 
                message="Esta acción es irreversible y eliminará el sector '{{ $sector->nombre }}' junto con todas sus calles y registros asociados. ¿Deseas continuar?" 
                action="{{ route('sectores.destroy', $sector) }}" 
                confirmText="Sí, Eliminar Sector"
            />
        </div>
        @endforeach
    </div>
@endif

<!-- Modal Create Sector -->
<x-modal id="createSectorModal" title="Nuevo Sector Comunitario">
    <form action="{{ route('sectores.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nombre del Sector <span class="text-red-500">*</span></label>
                <input type="text" name="nombre" required placeholder="Ej: Sector Las Flores" 
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:bg-white transition-all text-sm"
                       style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                       onfocus="this.style.borderColor = 'var(--theme-color)'"
                       onblur="this.style.borderColor = 'transparent'">
                <p class="mt-2 text-[10px] text-slate-400 font-medium uppercase tracking-wide">Debe ser un nombre único dentro de la comunidad.</p>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Descripción (Opcional)</label>
                <textarea name="descripcion" rows="3" placeholder="Define los linderos o características del sector..." 
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:bg-white transition-all text-sm"
                          style="--tw-ring-color: color-mix(in srgb, var(--theme-color) 20%, transparent); border-color: transparent;"
                          onfocus="this.style.borderColor = 'var(--theme-color)'"
                          onblur="this.style.borderColor = 'transparent'"></textarea>
            </div>
        </div>
        <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-slate-50">
            <button type="button" onclick="closeModal('createSectorModal')" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 transition-all text-sm">
                Cancelar
            </button>
            <button type="submit" class="px-6 py-2.5 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 theme-bg-gradient" 
                    style="background-color: var(--theme-color); box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color) 25%, transparent);">
                Guardar Sector
            </button>
        </div>
    </form>
</x-modal>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>
@endsection
