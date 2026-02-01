@extends('layouts.admin')

@section('title', 'Gestión de Manzanas')

@section('content')
    <div x-data="{ 
        createModalOpen: false, 
        deleteModalOpen: false,
        editModalOpen: false, 
        deleteUrl: '',
        editUrl: '',
        editingManzana: { nombre: '', descripcion: '' },
        confirmDelete(url) {
            this.deleteUrl = url;
            this.deleteModalOpen = true;
        },
        openEditModal(manzana, url) {
            this.editingManzana = manzana;
            this.editUrl = url;
            this.editModalOpen = true;
        }
    }">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900">Manzanas de la Comunidad</h1>
                <p class="mt-2 text-sm text-slate-600">Gestiona las manzanas donde residen las familias.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none flex items-center gap-4">
                {{-- Formulario de Búsqueda --}}
                <form action="{{ route('manzanas.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar manzana..." 
                           class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-lb-primary/50 focus:border-lb-primary transition-all w-64 shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>

                <button @click="createModalOpen = true" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-lb-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-lb-primary-dark transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Manzana
                </button>
            </div>
        </div>

        @if($manzanas->isEmpty())
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
                <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay manzanas registradas</h3>
                <p class="text-slate-500 mb-4">Comienza definiendo las manzanas de tu comunidad.</p>
                <button @click="createModalOpen = true" class="inline-flex items-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition">
                    Crear Primera Manzana
                </button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($manzanas as $manzana)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 w-12 h-12 items-center justify-center bg-blue-50 text-blue-600 rounded-xl border border-blue-100 shadow-sm flex">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $manzana->nombre }}</h3>
                                    <p class="text-sm text-slate-500">{{ $manzana->descripcion ?? 'Sin descripción' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2 text-sm text-slate-600 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                             <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                             <span class="font-semibold">{{ $manzana->familias_count }}</span> {{ Str::plural('Familia', $manzana->familias_count) }}
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-2 pt-4 border-t border-slate-100">
                             <button type="button" 
                                    @click="openEditModal({{ $manzana }}, '{{ route('manzanas.update', $manzana) }}')" 
                                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors border border-amber-200 w-full justify-center" 
                                    title="Editar manzana">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </button>
                            <button type="button" 
                                    @click="confirmDelete('{{ route('manzanas.destroy', $manzana) }}')" 
                                    class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-200 w-full justify-center" 
                                    title="Eliminar manzana">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        {{-- Modal de Creación --}}
        <div x-show="createModalOpen" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak
             style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div x-show="createModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                     @click="createModalOpen = false">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="createModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.stop
                     class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-display font-bold text-slate-900">Nueva Manzana</h3>
                            <button @click="createModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <form action="{{ route('manzanas.store') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nombre de la Manzana <span class="text-red-500">*</span></label>
                                    <input type="text" name="nombre" required placeholder="Ej: Manzana A, Manzana 12" 
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-lb-primary/50 focus:border-lb-primary transition-all text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Descripción (Opcional)</label>
                                    <textarea name="descripcion" rows="3" placeholder="Ubicación o características..." 
                                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-lb-primary/50 focus:border-lb-primary transition-all text-sm"></textarea>
                                </div>
                            </div>
                            <div class="mt-8 flex items-center justify-end gap-3">
                                <button type="button" @click="createModalOpen = false" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 transition-all text-sm">
                                    Cancelar
                                </button>
                                <button type="submit" class="px-6 py-2.5 bg-lb-primary text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-lb-primary-dark transition-all duration-300 flex items-center gap-2">
                                    Guardar Manzana
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal de Edición --}}
        <div x-show="editModalOpen" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak
             style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div x-show="editModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                     @click="editModalOpen = false">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="editModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.stop
                     class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-display font-bold text-slate-900">Editar Manzana</h3>
                            <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <form :action="editUrl" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nombre de la Manzana <span class="text-red-500">*</span></label>
                                    <input type="text" name="nombre" required x-model="editingManzana.nombre"
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Descripción (Opcional)</label>
                                    <textarea name="descripcion" rows="3" x-model="editingManzana.descripcion"
                                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all text-sm"></textarea>
                                </div>
                            </div>
                            <div class="mt-8 flex items-center justify-end gap-3">
                                <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 transition-all text-sm">
                                    Cancelar
                                </button>
                                <button type="submit" class="px-6 py-2.5 bg-amber-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-amber-600 transition-all duration-300 flex items-center gap-2">
                                    Actualizar Manzana
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal de Confirmación de Eliminación --}}
        <div x-show="deleteModalOpen" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak
             style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                <div x-show="deleteModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm"
                     @click="deleteModalOpen = false">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="deleteModalOpen"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.stop
                     class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-200">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.718-3L13.732 4c-.784-1.333-2.592-1.333-3.346 0L3.088 15.6c-.784 1.333.178 3 1.718 3z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-slate-900">¿Eliminar Manzana?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        ¿Estás seguro de que deseas eliminar esta manzana? Esto también eliminará <strong>todas las familias y fichas asociadas</strong>. Esta acción no se puede deshacer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-all antialiased">
                                Sí, eliminar permanentemente
                            </button>
                        </form>
                        <button type="button" 
                                @click="deleteModalOpen = false" 
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lb-primary sm:mt-0 sm:w-auto sm:text-sm transition-all">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
