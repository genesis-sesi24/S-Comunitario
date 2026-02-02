@extends('layouts.admin')

@section('title', $tipo->nombre)

@section('content')
<div x-data="{ showAddField: false, showEditField: false, fieldType: 'text', editFieldType: 'text', editingField: null }">
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('patologias.tipos.index') }}" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-3xl font-display font-bold text-slate-900">{{ $tipo->nombre }}</h1>
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{ $tipo->color }}-100 text-{{ $tipo->color }}-700">{{ $tipo->slug }}</span>
        </div>
        <p class="text-sm text-slate-600 ml-8">{{ $tipo->descripcion }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Fields List -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Campos Personalizados</h2>
                        <p class="text-sm text-slate-500 mt-1">{{ $tipo->campos->count() }} campos configurados</p>
                    </div>
                    <button @click="showAddField = true" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Agregar Campo
                    </button>
                </div>

                @if($tipo->campos->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">No hay campos configurados</h3>
                        <p class="text-slate-500 mb-4">Agrega campos como Nombre, Cédula, Edad, etc.</p>
                        <button @click="showAddField = true" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Agregar Primer Campo
                        </button>
                    </div>
                @else
                    <div class="divide-y divide-slate-100">
                        @foreach($tipo->campos->sortBy('orden') as $campo)
                            <div class="p-4 hover:bg-slate-50 transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="font-semibold text-slate-900">{{ $campo->etiqueta }}</h4>
                                            @if($campo->requerido)
                                                <span class="px-2 py-0.5 text-xs font-medium bg-red-100 text-red-700 rounded">Requerido</span>
                                            @endif
                                            <span class="px-2 py-0.5 text-xs font-medium bg-slate-100 text-slate-600 rounded">{{ ucfirst($campo->tipo_campo) }}</span>
                                        </div>
                                        <p class="text-sm text-slate-500">Nombre del campo: <code class="bg-slate-100 px-1.5 py-0.5 rounded text-xs">{{ $campo->nombre }}</code></p>
                                        @if($campo->ayuda)
                                            <p class="text-xs text-slate-400 mt-1">{{ $campo->ayuda }}</p>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex items-center gap-2">
                                        <button @click="editingField = {{ $campo->id }}; editFieldType = '{{ $campo->tipo_campo }}'; showEditField = true"
                                                class="text-indigo-600 hover:text-indigo-700 p-2 rounded hover:bg-indigo-50 transition"
                                                title="Editar campo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form method="POST" action="{{ route('patologias.campos.destroy', $campo->id) }}" onsubmit="return confirm('¿Eliminar este campo? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 p-2 rounded hover:bg-red-50 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-slate-700 mb-4">Estadísticas</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Registros</span>
                        <span class="text-lg font-bold text-slate-900">{{ $tipo->registros_count }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Campos</span>
                        <span class="text-lg font-bold text-slate-900">{{ $tipo->campos->count() }}</span>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('patologias.index', $tipo->slug) }}" class="block w-full px-4 py-2 bg-{{ $tipo->color }}-600 text-white text-sm font-medium text-center rounded-lg hover:bg-{{ $tipo->color }}-700 transition">
                        Ver Registros
                    </a>
                </div>
            </div>

            <!-- Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Tabla de Base de Datos</p>
                        <p><code class="bg-blue-100 px-2 py-0.5 rounded text-xs">{{ $tipo->tabla_datos }}</code></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Field Modal (Redesigned) -->
    <div x-show="showAddField" 
         x-cloak 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all" 
             @click.away="showAddField = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
             
            <form method="POST" action="{{ route('patologias.campos.store', $tipo->id) }}">
                @csrf
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 rounded-t-2xl">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Nuevo Campo Personalizado</h3>
                        <p class="text-xs text-slate-500 mt-1">Configura qué información guardarás en este campo.</p>
                    </div>
                    <button type="button" @click="showAddField = false" class="text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    
                    <!-- Section: Datos Principales -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                             <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre Visible (Etiqueta) <span class="text-red-500">*</span></label>
                             <input type="text" name="etiqueta" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium placeholder:font-normal" placeholder="Ej: Historial Médico Familiar">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Identificador Interno <span class="text-red-500">*</span></label>
                            <input type="text" name="nombre" required class="w-full px-4 py-2.5 border border-slate-200 rounded-lg text-slate-600 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="ej: historial_familiar">
                            <p class="mt-1 text-[10px] text-slate-400">Sin espacios, solo letras minúsculas.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de Dato <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="tipo_campo" x-model="fieldType" required class="w-full px-4 py-2.5 border border-slate-200 rounded-lg appearance-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white">
                                    <optgroup label="Texto">
                                        <option value="text">Texto Corto (Una línea)</option>
                                        <option value="textarea">Texto Largo (Párrafos)</option>
                                    </optgroup>
                                    <optgroup label="Datos">
                                        <option value="number">Numérico</option>
                                        <option value="date">Fecha</option>
                                        <option value="email">Correo Electrónico</option>
                                        <option value="telefono">Teléfono</option>
                                        <option value="cedula">Cédula Venezolana (V/E/J...)</option>
                                    </optgroup>
                                    <optgroup label="Opciones">
                                        <option value="select">Selección de Lista</option>
                                        <option value="checkbox">Casilla (Sí/No)</option>
                                    </optgroup>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-500 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Options for Select -->
                    <div x-show="fieldType === 'select'" x-transition class="bg-indigo-50 border border-indigo-100 rounded-lg p-4">
                        <label class="block text-sm font-bold text-indigo-900 mb-2">Opciones de la Lista</label>
                        <input type="text" name="opciones[]" class="w-full px-4 py-2 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Ej: Opción 1, Opción 2, Opción 3 (Separadas por comas)">
                        <p class="mt-1 text-xs text-indigo-600">Escribe las opciones separadas por coma.</p>
                    </div>

                    <!-- Section: Detalles -->
                    <div class="border-t border-slate-100 pt-5">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Detalles y Ubicación</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Grupo / Sección</label>
                                <input type="text" name="grupo" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="Ej: Datos Médicos">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Ejemplo de Valor</label>
                                <input type="text" name="placeholder" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500" placeholder="Ej: Escribe aquí los antecedentes...">
                                <p class="mt-1 text-[10px] text-slate-400">Texto gris que aparece dentro del campo antes de escribir.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Checkbox -->
                    <div class="flex items-center p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <input type="checkbox" name="requerido" id="requerido" value="1" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 transition cursor-pointer">
                        <div class="ml-3">
                            <label for="requerido" class="text-sm font-bold text-slate-800 cursor-pointer">Campo Obligatorio</label>
                            <p class="text-xs text-slate-500">El usuario no podrá guardar el registro si deja este campo vacío.</p>
                        </div>
                    </div>

                </div>

                <div class="px-6 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-2xl">
                    <button type="button" @click="showAddField = false" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 transition shadow-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-md hover:shadow-lg transform active:scale-95 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Guardar Campo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Field Modal -->
    <div x-show="showEditField" 
         x-cloak 
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 transition-opacity"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all" 
             @click.away="showEditField = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
             
            @foreach($tipo->campos as $campo)
            <form x-show="editingField === {{ $campo->id }}" method="POST" action="{{ route('patologias.campos.update', $campo->id) }}">
                @csrf
                @method('PUT')
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50 rounded-t-2xl">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Editar Campo</h3>
                        <p class="text-xs text-slate-500 mt-1">Modifica la configuración del campo.</p>
                    </div>
                    <button type="button" @click="showEditField = false" class="text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    
                    <!-- Section: Datos Principales -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                             <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre Visible (Etiqueta) <span class="text-red-500">*</span></label>
                             <input type="text" name="etiqueta" value="{{ $campo->etiqueta }}" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Identificador Interno</label>
                            <input type="text" value="{{ $campo->nombre }}" disabled class="w-full px-4 py-2.5 border border-slate-200 rounded-lg bg-slate-100 text-slate-500 cursor-not-allowed">
                            <p class="mt-1 text-[10px] text-slate-400">No se puede modificar el nombre interno del campo.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de Dato</label>
                            <input type="text" value="{{ ucfirst($campo->tipo_campo) }}" disabled class="w-full px-4 py-2.5 border border-slate-200 rounded-lg bg-slate-100 text-slate-500 cursor-not-allowed">
                            <p class="mt-1 text-[10px] text-slate-400">No se puede cambiar el tipo de un campo existente.</p>
                        </div>
                    </div>

                    <!-- Dynamic Options for Select -->
                    @if($campo->tipo_campo === 'select')
                    <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4">
                        <label class="block text-sm font-bold text-indigo-900 mb-2">Opciones de la Lista</label>
                        <input type="text" name="opciones[]" value="{{ is_array($campo->opciones) ? implode(', ', $campo->opciones) : $campo->opciones }}" class="w-full px-4 py-2 border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Ej: Opción 1, Opción 2, Opción 3 (Separadas por comas)">
                        <p class="mt-1 text-xs text-indigo-600">Escribe las opciones separadas por coma.</p>
                    </div>
                    @endif

                    <!-- Section: Detalles -->
                    <div class="border-t border-slate-100 pt-5">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Detalles y Ubicación</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Grupo / Sección</label>
                                <input type="text" name="grupo" value="{{ $campo->grupo }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Ejemplo de Valor</label>
                                <input type="text" name="placeholder" value="{{ $campo->placeholder }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                <p class="mt-1 text-[10px] text-slate-400">Texto gris que aparece dentro del campo antes de escribir.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Validation Checkbox -->
                    <div class="flex items-center p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <input type="checkbox" name="requerido" id="requerido_edit_{{ $campo->id }}" value="1" {{ $campo->requerido ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 transition cursor-pointer">
                        <div class="ml-3">
                            <label for="requerido_edit_{{ $campo->id }}" class="text-sm font-bold text-slate-800 cursor-pointer">Campo Obligatorio</label>
                            <p class="text-xs text-slate-500">El usuario no podrá guardar el registro si deja este campo vacío.</p>
                        </div>
                    </div>

                </div>

                <div class="px-6 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-2xl">
                    <button type="button" @click="showEditField = false" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 hover:text-slate-900 transition shadow-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-md hover:shadow-lg transform active:scale-95 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
