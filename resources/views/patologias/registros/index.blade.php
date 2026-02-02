@extends('layouts.admin')

@section('title', $tipo->nombre . ' - Registros')

@section('content')
    <div x-data="{ 
        view: 'table',
        deleteModalOpen: false,
        deleteUrl: '',
        confirmDelete(url) {
            this.deleteUrl = url;
            this.deleteModalOpen = true;
        }
    }">
        <!-- Breadcrumb -->
        <nav class="mb-4 text-sm">
            <ol class="flex items-center space-x-2 text-slate-600">
                <li>
                    <a href="{{ route('patologias.tipos.index') }}" class="hover:text-{{ $tipo->color }}-600 transition">Patologías</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </li>
                <li class="font-semibold text-{{ $tipo->color }}-600">{{ $tipo->nombre }}</li>
            </ol>
        </nav>

        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-{{ $tipo->color }}-50 text-{{ $tipo->color }}-600 rounded-xl flex items-center justify-center border border-{{ $tipo->color }}-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-display font-bold text-slate-900">{{ $tipo->nombre }}</h1>
                    <p class="mt-1 text-sm text-slate-600">{{ $tipo->descripcion }}</p>
                </div>
            </div>
            
            <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row items-end sm:items-center gap-4">
                
                <!-- View Toggle -->
                <div class="flex bg-slate-100 p-1 rounded-lg border border-slate-200">
                    <button @click="view = 'table'" 
                            :class="{ 'bg-white text-slate-800 shadow-sm': view === 'table', 'text-slate-500 hover:text-slate-700': view !== 'table' }"
                            class="px-3 py-1.5 rounded-md text-sm font-medium transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Tabla
                    </button>
                    <button @click="view = 'grid'" 
                            :class="{ 'bg-white text-slate-800 shadow-sm': view === 'grid', 'text-slate-500 hover:text-slate-700': view !== 'grid' }"
                            class="px-3 py-1.5 rounded-md text-sm font-medium transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Cuadrícula
                    </button>
                </div>

                <!-- Formulario de Búsqueda -->
                <form action="{{ route('patologias.index', $tipo->slug) }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar paciente..." 
                           class="pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-{{ $tipo->color }}-500/50 focus:border-{{ $tipo->color }}-500 transition-all w-64 shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>

                <a href="{{ route('patologias.export.excel', $tipo->slug) }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Excel
                </a>

                <a href="{{ route('patologias.tipos.show', $tipo->id) }}" 
                   class="inline-flex items-center justify-center px-4 py-2 border border-{{ $tipo->color }}-200 text-sm font-medium rounded-lg text-{{ $tipo->color }}-700 bg-{{ $tipo->color }}-50 hover:bg-{{ $tipo->color }}-100 shadow-sm transition-colors"
                   title="Configurar campos personalizados">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Campos
                </a>

                <a href="{{ route('patologias.create', $tipo->slug) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-{{ $tipo->color }}-600 hover:bg-{{ $tipo->color }}-700 shadow-sm hover:shadow-{{ $tipo->color }}-500/30 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Nuevo Paciente
                </a>
            </div>
        </div>

        @if($registros->isEmpty())
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-12 text-center">
                <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay registros</h3>
                <p class="text-slate-500 mb-4">Comienza registrando el primer paciente de {{ $tipo->nombre }}.</p>
                <a href="{{ route('patologias.create', $tipo->slug) }}" class="inline-flex items-center gap-2 bg-{{ $tipo->color }}-600 hover:bg-{{ $tipo->color }}-700 text-white font-semibold px-5 py-2.5 rounded-lg transition">
                    Crear Primer Registro
                </a>
            </div>
        @else
            <!-- TABLE VIEW -->
            <div x-show="view === 'table'" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" x-transition.opacity>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                @if($tipo->slug === 'cardiovascular')
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Nombre Completo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Cédula</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Edad</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Sexo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Municipio</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Centro Salud</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Condiciones</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Teléfono</th>
                                @else
                                    {{-- Dynamic Headers --}}
                                    @foreach($tipo->campos as $campo)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">
                                            {{ $campo->etiqueta }}
                                        </th>
                                    @endforeach
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Fecha Registro</th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach($registros as $registro)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    @if($tipo->slug === 'cardiovascular')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                            {{ $registro->nombre_completo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $registro->cedula_completa }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $registro->edad }} años
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $registro->sexo }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ Str::limit($registro->municipio, 15) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ Str::limit($registro->centro_salud, 15) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500">
                                            <div class="flex gap-1 flex-wrap w-32">
                                                @if($registro->hta) <span class="bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded">HTA</span> @endif
                                                @if($registro->iam) <span class="bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded">IAM</span> @endif
                                                @if($registro->erc) <span class="bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded">ERC</span> @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $registro->telefono ?? '-' }}
                                        </td>
                                    @else
                                        {{-- Dynamic Data --}}
                                        @foreach($tipo->campos as $campo)
                                            <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate" title="{{ $registro->{$campo->nombre} ?? '' }}">
                                                @if($campo->tipo_campo == 'select' && isset($campo->opciones[$registro->{$campo->nombre}]))
                                                    {{ $campo->opciones[$registro->{$campo->nombre}] }}
                                                @elseif($campo->tipo_campo == 'cedula')
                                                    {{ $registro->{$campo->nombre . '_tipo'} ?? '' }}-{{ $registro->{$campo->nombre} ?? '' }}
                                                @elseif($campo->tipo_campo == 'checkbox')
                                                    {{ $registro->{$campo->nombre} ? 'Sí' : 'No' }}
                                                @elseif($campo->tipo_campo == 'date' && $registro->{$campo->nombre})
                                                    {{ \Carbon\Carbon::parse($registro->{$campo->nombre})->format('d/m/Y') }}
                                                @else
                                                    {{ Str::limit($registro->{$campo->nombre} ?? '-', 30) }}
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                            {{ $registro->created_at->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('patologias.show', [$tipo->slug, $registro->id]) }}" class="text-blue-600 hover:text-blue-900 transition-colors p-1 rounded-md hover:bg-blue-50" title="Ver detalle">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('patologias.edit', [$tipo->slug, $registro->id]) }}" class="text-amber-600 hover:text-amber-900 transition-colors p-1 rounded-md hover:bg-amber-50" title="Editar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <button @click="confirmDelete('{{ route('patologias.destroy', [$tipo->slug, $registro->id]) }}')" class="text-red-600 hover:text-red-900 transition-colors p-1 rounded-md hover:bg-red-50" title="Eliminar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- GRID VIEW -->
            <div x-show="view === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-transition.opacity style="display: none;">
                @foreach($registros as $registro)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900">{{ $registro->nombre_completo }}</h3>
                                <div class="mt-1 flex flex-col gap-1 text-sm text-slate-500">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                        <span>{{ $registro->cedula_completa }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $registro->edad }} años</span>
                                    </div>
                                    @if($registro->telefono)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $registro->telefono }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-2 pt-4 border-t border-slate-100">
                            <a href="{{ route('patologias.show', [$tipo->slug, $registro->id]) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Ver
                            </a>
                            <a href="{{ route('patologias.edit', [$tipo->slug, $registro->id]) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors border border-amber-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                            <button type="button" 
                                    @click="confirmDelete('{{ route('patologias.destroy', [$tipo->slug, $registro->id]) }}')" 
                                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $registros->links() }}
            </div>
        @endif

        <!-- Modal de Confirmación de Eliminación -->
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
                                <h3 class="text-lg leading-6 font-bold text-slate-900">¿Eliminar Registro?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        ¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.
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
                                Sí, eliminar
                            </button>
                        </form>
                        <button type="button" 
                                @click="deleteModalOpen = false" 
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $tipo->color }}-500 sm:mt-0 sm:w-auto sm:text-sm transition-all">
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
