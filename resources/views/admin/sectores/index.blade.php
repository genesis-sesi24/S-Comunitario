@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-display font-bold text-slate-900">Gestión de Comunidad</h1>
    <p class="text-slate-600 mt-1">Organización territorial de la comunidad</p>
</div>

<div class="mb-6">
    <button type="button" class="inline-flex items-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition shadow-sm" data-bs-toggle="modal" data-bs-target="#createSectorModal">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nuevo Sector
    </button>
</div>

@if($sectores->isEmpty())
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay sectores registrados</h3>
        <p class="text-slate-500 mb-4">Comienza creando el primer sector de la comunidad</p>
        <button type="button" class="inline-flex items-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition" data-bs-toggle="modal" data-bs-target="#createSectorModal">
            Crear Primer Sector
        </button>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sectores as $sector)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-slate-900">{{ $sector->nombre }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $sector->calles_count }} {{ $sector->calles_count == 1 ? 'calle' : 'calles' }}</p>
                </div>
                <div class="relative">
                    <button class="text-slate-400 hover:text-slate-600 p-1" onclick="document.getElementById('menu-{{ $sector->id }}').classList.toggle('hidden')">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                    <div id="menu-{{ $sector->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 z-10">
                        <form action="{{ route('sectores.destroy', $sector) }}" method="POST" onsubmit="return confirm('¿Estás seguro? Se eliminarán todas las calles y viviendas asociadas.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                                Eliminar Sector
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($sector->descripcion)
                <div class="px-6 py-3 bg-slate-50 border-b border-slate-200">
                    <p class="text-xs text-slate-600">{{ $sector->descripcion }}</p>
                </div>
            @endif

            <!-- Streets List -->
            <div class="px-6 py-4">
                <h4 class="text-xs font-semibold text-slate-700 uppercase tracking-wide mb-3">Calles</h4>
                <ul class="space-y-2 mb-4" style="max-height: 200px; overflow-y: auto;">
                    @forelse($sector->calles as $calle)
                        <li class="flex items-center justify-between py-1.5 px-2 rounded hover:bg-slate-50 group">
                            <span class="text-sm text-slate-700">{{ $calle->nombre }}</span>
                            <form action="{{ route('calles.destroy', $calle) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="opacity-0 group-hover:opacity-100 text-red-500 hover:text-red-700 transition" onclick="return confirm('¿Eliminar calle?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </li>
                    @empty
                        <li class="text-xs text-slate-400 italic py-2">Sin calles registradas</li>
                    @endforelse
                </ul>

                <!-- Add Street Form -->
                <form action="{{ route('sectores.calles.store', $sector) }}" method="POST">
                    @csrf
                    <div class="flex gap-2">
                        <input type="text" name="nombre" placeholder="Nueva calle..." required class="flex-1 px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-lb-primary focus:border-transparent">
                        <button type="submit" class="px-4 py-2 bg-lb-primary hover:bg-lb-primary-dark text-white text-sm font-medium rounded-lg transition">
                            +
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

<!-- Modal Create Sector -->
<div class="modal fade" id="createSectorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-xl border-0 shadow-lg">
            <div class="modal-header border-b border-slate-200 px-6 py-4">
                <h5 class="modal-title font-semibold text-slate-900">Nuevo Sector</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('sectores.store') }}" method="POST">
                @csrf
                <div class="modal-body px-6 py-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nombre del Sector *</label>
                        <input type="text" name="nombre" required placeholder="Ej: Sector Las Flores" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-lb-primary focus:border-transparent">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3" placeholder="Descripción opcional del sector..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-lb-primary focus:border-transparent"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-t border-slate-200 px-6 py-4">
                    <button type="button" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-lg transition" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-medium rounded-lg transition">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
