@extends('layouts.admin')

@section('title', 'Fichas Familiares - ' . $familia->apellidos)

@section('content')
    <div x-data="{ 
        previewFicha: null, 
        deleteModalOpen: false, 
        deleteUrl: '',
        confirmDelete(url) {
            this.deleteUrl = url;
            this.deleteModalOpen = true;
        }
    }">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <a href="{{ route('familias.index') }}" class="flex items-center text-sm text-slate-500 hover:text-lb-primary transition-colors mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Familias
            </a>
            <h1 class="text-3xl font-display font-bold text-slate-900">Fichas Familiares</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $familia->apellidos }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('familias.fichas.create', $familia) }}" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-lb-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-lb-primary-dark transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nueva Ficha Familiar
            </a>
        </div>
    </div>

    {{-- Filtro por Fecha --}}
    @if(isset($years) && $years->count() > 0)
        <div class="mb-6 bg-slate-50 p-4 rounded-xl border border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <form action="{{ route('familias.fichas.index', $familia) }}" method="GET" class="flex flex-wrap items-center gap-4">
                {{-- Filtro Año --}}
                <div class="flex items-center gap-2">
                    <label for="year" class="text-sm font-semibold text-slate-700 whitespace-nowrap">Año:</label>
                    <div class="relative min-w-[120px]">
                        <select name="year" id="year" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-300 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-8">
                            <option value="">Todos</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Filtro Mes --}}
                <div class="flex items-center gap-2">
                    <label for="month" class="text-sm font-semibold text-slate-700 whitespace-nowrap">Mes:</label>
                    <div class="relative min-w-[140px]">
                        <select name="month" id="month" onchange="this.form.submit()" class="appearance-none bg-white border border-slate-300 text-slate-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-8">
                            <option value="">Todos</option>
                            @foreach($months as $num => $name)
                                <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </form>
            
            @if(request('year') || request('month'))
                <div class="flex items-center gap-3 text-sm bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                    <span class="text-slate-600">
                        Filtrado por: 
                        @if(request('year')) <strong class="text-slate-900">{{ request('year') }}</strong> @endif
                        @if(request('year') && request('month')) - @endif
                        @if(request('month')) <strong class="text-slate-900">{{ $months[request('month')] }}</strong> @endif
                    </span>
                    <div class="h-4 w-px bg-slate-300"></div>
                    <a href="{{ route('familias.fichas.index', $familia) }}" class="text-red-600 hover:text-red-800 font-medium flex items-center transition-colors" title="Quitar todos los filtros">
                        Limpiar
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                </div>
            @endif
        </div>
    @endif

    @if($fichas->isEmpty())
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay fichas familiares registradas</h3>
            <p class="text-slate-500 mb-4">Comienza creando la primera ficha familiar para esta familia</p>
            <a href="{{ route('familias.fichas.create', $familia) }}" class="inline-flex items-center gap-2 bg-lb-primary hover:bg-lb-primary-dark text-white font-semibold px-5 py-2.5 rounded-lg transition">
                Crear Primera Ficha
            </a>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($fichas as $ficha)
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        {{-- Icono/Logo de la Ficha --}}
                        <div class="hidden md:flex flex-shrink-0 w-16 h-16 items-center justify-center bg-blue-50 text-blue-600 rounded-2xl border border-blue-100 shadow-sm">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                        <div class="flex-1 w-full text-center md:text-left">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900">Historia Clínica Familiar</h3>
                                    <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-2 text-sm">
                                        <div class="flex items-center justify-center md:justify-start gap-2">
                                            <span class="text-slate-500 font-medium">HC №:</span>
                                            <span class="font-bold text-slate-900 bg-slate-100 px-2 py-0.5 rounded">{{ $ficha->numero_hc ?? '---' }}</span>
                                        </div>
                                        <div class="flex items-center justify-center md:justify-start gap-2">
                                            <span class="text-slate-500 font-medium">Consultorio:</span>
                                            <span class="font-semibold text-slate-900">{{ $ficha->consultorio ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-center justify-center md:justify-start gap-2">
                                            <span class="text-slate-500 font-medium">Fecha:</span>
                                            <span class="font-semibold text-slate-900 italic">{{ $ficha->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center justify-center md:justify-start gap-2">
                                            <span class="text-slate-500 font-medium">Asic:</span>
                                            <span class="font-semibold text-slate-900">{{ $ficha->asic ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Botones de Acción con Etiquetas --}}
                                <div class="flex flex-wrap justify-center md:justify-end items-center gap-2 pt-4 md:pt-0 border-t md:border-t-0 border-slate-100">
                                    <button @click="previewFicha = '{{ $ficha->id }}'" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-200" title="Vista rápida">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Vista Previa
                                    </button>

                                    <a href="{{ route('familias.fichas.show', [$familia, $ficha]) }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors border border-emerald-200" title="Ver reporte completo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                        </svg>
                                        Reporte
                                    </a>

                                    <a href="{{ route('familias.fichas.edit', [$familia, $ficha]) }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors border border-amber-200" title="Editar datos">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </a>

                                    <button type="button" 
                                            @click.stop="confirmDelete('{{ route('familias.fichas.destroy', [$familia, $ficha]) }}')" 
                                            class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-200" 
                                            title="Eliminar ficha">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal/Panel de Vista Previa --}}
                <div x-show="previewFicha === '{{ $ficha->id }}'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="border-t border-slate-200 bg-slate-50 p-6 overflow-auto max-h-[80vh]"
                     style="display: none;">
                    
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-bold text-slate-900">Vista Previa - Ficha Médica</h4>
                        <button @click="previewFicha = null" class="text-slate-400 hover:text-slate-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Contenido de la ficha (versión compacta) --}}
                    <div class="bg-white border-2 border-slate-900 p-6">
                        @include('fichas.partials.preview', ['ficha' => $ficha, 'familia' => $familia])
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

        {{-- Modal de Confirmación de Eliminación --}}
        <div x-show="deleteModalOpen" 
             class="fixed inset-0 z-[100] overflow-y-auto" 
             x-cloak
             style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
                {{-- Fondo/Backdrop oscuro y difuminado --}}
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

                {{-- Spacer para centrado --}}
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Panel del Modal --}}
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
                                <h3 class="text-lg leading-6 font-bold text-slate-900">¿Eliminar Ficha Familiar?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        ¿Estás seguro de que deseas eliminar esta historia clínica? Esta acción no se puede deshacer y todos los datos asociados se perderán permanentemente.
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
