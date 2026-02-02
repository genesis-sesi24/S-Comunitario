@extends('layouts.admin')

@section('title', 'Gestión de Patologías')

@section('content')
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900">Patologías de la Comunidad</h1>
            <p class="mt-2 text-sm text-slate-600">Gestiona los diferentes tipos de patologías y sus registros.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('patologias.tipos.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nuevo Tipo
            </a>
        </div>
    </div>

    @if($tipos->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
            <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay tipos de patologías configurados</h3>
            <p class="text-slate-500 mb-4">Los tipos predefinidos se cargarán con el seeder.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-data="{ deleteModalOpen: false, deleteUrl: '', deleteName: '' }">
            @foreach($tipos as $tipo)
            <div class="relative group">
                <a href="{{ route('patologias.index', $tipo->slug) }}" 
                   class="block bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition h-full">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4 flex-1">
                                <div class="flex-shrink-0 w-14 h-14 items-center justify-center bg-{{ $tipo->color }}-50 text-{{ $tipo->color }}-600 rounded-xl border border-{{ $tipo->color }}-100 shadow-sm flex group-hover:scale-110 transition-transform">
                                    <x-icon name="{{ $tipo->icono ?? 'clipboard-list' }}" class="w-7 h-7" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-{{ $tipo->color }}-600 transition">{{ $tipo->nombre }}</h3>
                                    <p class="text-sm text-slate-500 truncate">{{ $tipo->descripcion }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2 text-sm text-slate-600 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="font-semibold">{{ $tipo->registros_count }}</span> 
                            {{ Str::plural('Registro', $tipo->registros_count) }}
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-{{ $tipo->color }}-600 font-semibold group-hover:underline">
                                    Ver registros →
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                
                <!-- Delete Button -->
                <button @click.prevent="deleteModalOpen = true; deleteUrl = '{{ route('patologias.tipos.destroy', $tipo->id) }}'; deleteName = '{{ $tipo->nombre }}'"
                        class="absolute top-2 right-2 p-2 text-slate-400 hover:text-red-600 bg-white/80 hover:bg-red-50 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-200 z-10"
                        title="Eliminar Tipo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
            @endforeach

            <!-- Delete Modal -->
            <div x-show="deleteModalOpen" x-cloak class="fixed inset-0 bg-slate-900/50 flex items-center justify-center p-4 z-50">
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 animate-fade-in-up" @click.away="deleteModalOpen = false">
                    <h3 class="text-lg font-bold text-slate-900 mb-2">¿Eliminar Tipo de Patología?</h3>
                    <p class="text-slate-600 mb-4">
                        Estás a punto de eliminar <strong x-text="deleteName"></strong>. 
                        <br><br>
                        <span class="text-red-600 font-medium bg-red-50 p-2 rounded block text-sm border border-red-100">
                            ⚠️ ATENCIÓN: Esta acción eliminará permanentemente la tabla de datos y TODOS los registros asociados. No se puede deshacer.
                        </span>
                    </p>
                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button @click="deleteModalOpen = false" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">Cancelar</button>
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-sm transition">
                                Sí, Eliminar Todo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
@endsection
