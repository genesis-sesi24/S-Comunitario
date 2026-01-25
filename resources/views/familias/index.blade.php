@extends('layouts.admin')

@section('title', 'Gestión de Familias')

@section('content')
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900">Familias</h1>
            <p class="mt-2 text-sm text-slate-600">Gestión del registro familiar comunitario.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('familias.create') }}" class="inline-flex items-center justify-center px-6 py-3 theme-bg-gradient text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300" style="box-shadow: 0 10px 25px color-mix(in srgb, var(--theme-color) 20%, transparent);">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Familia
            </a>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-8">
        <form action="{{ route('familias.index') }}" method="GET" class="relative">
            <div class="flex items-center">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                        placeholder="Buscar por apellidos o número de casa...">
                </div>
                <button type="submit" class="ml-3 inline-flex items-center justify-center h-full px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition-colors">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Families Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        @forelse($familias as $familia)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col group overflow-hidden border-t-4 theme-border" style="border-top-color: var(--theme-color);">
                
                <!-- Header -->
                <div class="p-5 flex items-start justify-between border-b border-slate-50">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-white font-bold text-lg theme-bg transition-colors duration-300" style="background-color: var(--theme-color);">
                            {{ strtoupper(substr($familia->apellidos, 0, 2)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 leading-tight group-hover:text-blue-700 transition-colors">{{ $familia->apellidos }}</h3>
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Reg: {{ $familia->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-5 flex-1 space-y-4">
                    {{-- Ubicación --}}
                    <div class="flex items-start text-sm group/item">
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center mr-3 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            @if($familia->vivienda)
                                <span class="block font-semibold text-slate-700">Casa #{{ $familia->vivienda->numero_casa ?? 'S/N' }}</span>
                                <span class="text-slate-500 text-xs">{{ $familia->vivienda->calle->nombre ?? '' }} • {{ $familia->vivienda->calle->sector->nombre ?? 'Sin Sector' }}</span>
                            @else
                                <span class="text-slate-400 italic">Sin ubicación asignada</span>
                            @endif
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-slate-50 p-3 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-slate-700">{{ $familia->integrantes_count ?? 0 }}</span>
                            <span class="text-xs text-slate-500 font-medium uppercase">Personas</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg text-center">
                            <span class="block text-lg font-bold text-slate-700 mt-1">{{ number_format($familia->numero_habitantes ?? 0) }}</span>
                            <span class="text-xs text-slate-500 font-medium uppercase">Habitantes</span>
                        </div>
                    </div>
                    
                    {{-- Ingreso --}}
                    <div class="flex items-center justify-between text-sm pt-2 border-t border-slate-50">
                        <span class="text-slate-500">Ingreso Aprox.</span>
                        <span class="font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">
                            {{ $familia->ingreso_mensual_aprox ? '$'.number_format($familia->ingreso_mensual_aprox, 2) : 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-2 py-3 border-t border-slate-100 grid grid-cols-3 gap-1 bg-slate-50/50">
                    <a href="{{ route('familias.fichas.index', $familia) }}" class="inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-indigo-700 hover:bg-white hover:shadow-sm transition-all group/btn" title="Historia Clínica">
                        <svg class="w-5 h-5 mb-1 text-slate-400 group-hover/btn:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Fichas
                    </a>

                    <a href="{{ route('familias.edit', $familia) }}" class="inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 theme-text-hover hover:bg-white hover:shadow-sm transition-all group/btn" title="Editar Familia">
                        <svg class="w-5 h-5 mb-1 text-slate-400 theme-text-group-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Editar
                    </a>
                    
                    <button type="button" onclick="openModal('deleteModal-{{ $familia->id }}')" class="w-full inline-flex flex-col justify-center items-center py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-rose-700 hover:bg-white hover:shadow-sm transition-all group/btn" title="Eliminar Familia">
                        <svg class="w-5 h-5 mb-1 text-slate-400 group-hover/btn:text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Eliminar
                    </button>

                    <x-confirm-modal 
                        id="deleteModal-{{ $familia->id }}" 
                        title="¿Eliminar Familia?" 
                        message="Esta acción desactivará el registro de la familia {{ $familia->apellidos }}. Podrás reactivarla contactando al administrador." 
                        action="{{ route('familias.destroy', $familia) }}" 
                    />
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24 px-4 text-center">
                <div class="bg-slate-50 p-6 rounded-full mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">No se encontraron familias</h3>
                <p class="text-slate-500 text-sm mb-6">Intenta ajustar la búsqueda o agrega una nueva familia.</p>
                <a href="{{ route('familias.index') }}" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors text-sm">
                    Limpiar Filtros
                </a>
            </div>
        @endforelse
    </div>

    @if($familias->hasPages())
        <div class="mt-12">
            {{ $familias->links() }}
        </div>
    @endif


<style>
.theme-text-hover:hover { color: var(--theme-color); }
.theme-text-group-hover { transition: color 0.3s; }
.group\/btn:hover .theme-text-group-hover { color: var(--theme-color); }
</style>
@endsection
