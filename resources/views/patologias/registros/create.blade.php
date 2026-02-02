@extends('layouts.admin')

@section('title', isset($registro) ? 'Editar Registro' : 'Nuevo Registro' . ' - ' . $tipo->nombre)

@section('content')
    <!-- Breadcrumb -->
    <nav class="mb-4 text-xs">
        <ol class="flex items-center space-x-2 text-slate-500">
            <li>
                <a href="{{ route('patologias.tipos.index') }}" class="hover:text-{{ $tipo->color }}-600 transition">Patologías</a>
            </li>
            <li>/</li>
            <li>
                <a href="{{ route('patologias.index', $tipo->slug) }}" class="hover:text-{{ $tipo->color }}-600 transition">{{ $tipo->nombre }}</a>
            </li>
            <li>/</li>
            <li class="font-semibold text-{{ $tipo->color }}-600">{{ isset($registro) ? 'Editar' : 'Nuevo' }}</li>
        </ol>
    </nav>

    <div class="max-w-5xl">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-display font-bold text-slate-900">{{ isset($registro) ? 'Editar Registro' : 'Nuevo Paciente' }}</h1>
                <p class="text-xs text-slate-500">{{ $tipo->nombre }}</p>
            </div>
            <a href="{{ route('patologias.index', $tipo->slug) }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Volver
            </a>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden" x-data="formValidation()">
            <form action="{{ isset($registro) ? route('patologias.update', [$tipo->slug, $registro->id]) : route('patologias.store', $tipo->slug) }}" 
                  method="POST" 
                  @submit="if(hasErrors()) { $event.preventDefault(); return; }">
                @csrf
                @if(isset($registro))
                    @method('PUT')
                @endif
                
                <div class="p-6">
                    @foreach($camposPorGrupo as $grupo => $campos)
                        @if($grupo)
                            @if(!$loop->first) <hr class="my-5 border-slate-100"> @endif
                            <div class="mb-3">
                                <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider">{{ $grupo }}</h2>
                            </div>
                        @endif
    
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-4">
                            @foreach($campos as $campo)
                                @if($campo->tipo_campo === 'cedula')
                                    <!-- Campo especial de Cédula -->
                                    <div class="{{ $loop->iteration <= 2 ? 'lg:col-span-1' : '' }}">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                                            {{ $campo->etiqueta }} @if($campo->requerido) <span class="text-red-500">*</span> @endif
                                        </label>
                                        <div class="flex gap-2">
                                            @php
                                                $cedulaVal = old('cedula', isset($registro) ? $registro->cedula : '');
                                                $cedulaType = 'N';
                                                $cedulaNum = $cedulaVal;
                                                if (str_contains($cedulaVal, '-')) {
                                                    $parts = explode('-', $cedulaVal);
                                                    $cedulaType = $parts[0];
                                                    $cedulaNum = $parts[1];
                                                }
                                            @endphp
                                            <select name="cedula_tipo" required class="w-16 px-2 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500">
                                                <option value="N" {{ old('cedula_tipo', $cedulaType) == 'N' ? 'selected' : '' }}>N</option>
                                                <option value="J" {{ old('cedula_tipo', $cedulaType) == 'J' ? 'selected' : '' }}>J</option>
                                            </select>
                                            <input type="number" 
                                                   name="cedula" 
                                                   value="{{ $cedulaNum }}" 
                                                   {{ $campo->requerido ? 'required' : '' }}
                                                   @input="validateField('cedula', $event.target.value, true)"
                                                   @blur="touched.cedula = true; validateField('cedula', $event.target.value, true)"
                                                   placeholder="12345678" 
                                                   class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                                   :class="{'border-red-500 bg-red-50': errors.cedula && touched.cedula, 'border-green-500 bg-green-50': !errors.cedula && touched.cedula && $el.value}"
                                            >
                                        </div>
                                        <p x-show="errors.cedula && touched.cedula" x-text="errors.cedula" class="mt-0.5 text-xs text-red-600 transition-opacity duration-200" style="display: none;"></p>
                                        @error('cedula') <p class="mt-0.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
    
                                @elseif($campo->tipo_campo === 'text' || $campo->tipo_campo === 'number' || $campo->tipo_campo === 'date')
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                                            {{ $campo->etiqueta }} @if($campo->requerido) <span class="text-red-500">*</span> @endif
                                        </label>
                                        <input type="{{ $campo->tipo_campo }}" 
                                               name="{{ $campo->nombre }}" 
                                               value="{{ old($campo->nombre, isset($registro) ? $registro->{$campo->nombre} : '') }}" 
                                               {{ $campo->requerido ? 'required' : '' }}
                                               @if($campo->tipo_campo === 'date' && isset($registro) && $registro->{$campo->nombre}) 
                                                    value="{{ $registro->{$campo->nombre}->format('Y-m-d') }}"
                                               @endif
                                               @input="validateField('{{ $campo->nombre }}', $event.target.value, {{ $campo->requerido ? 'true' : 'false' }})"
                                               @blur="touched['{{ $campo->nombre }}'] = true; validateField('{{ $campo->nombre }}', $event.target.value, {{ $campo->requerido ? 'true' : 'false' }})"
                                               placeholder="{{ $campo->placeholder ?? '' }}" 
                                               class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                               :class="{'border-red-500 bg-red-50': errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'], 'border-green-500 bg-green-50': !errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'] && $el.value}"
                                        >
                                        <p x-show="errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}']" x-text="errors['{{ $campo->nombre }}']" class="mt-0.5 text-xs text-red-600" style="display: none;"></p>
                                        @error($campo->nombre) <p class="mt-0.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
    
                                @elseif($campo->tipo_campo === 'select')
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                                            {{ $campo->etiqueta }} @if($campo->requerido) <span class="text-red-500">*</span> @endif
                                        </label>
                                        <select name="{{ $campo->nombre }}" 
                                                {{ $campo->requerido ? 'required' : '' }}
                                                @change="validateField('{{ $campo->nombre }}', $event.target.value, {{ $campo->requerido ? 'true' : 'false' }})"
                                                @blur="touched['{{ $campo->nombre }}'] = true"
                                                class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                                :class="{'border-red-500 bg-red-50': errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'], 'border-green-500 bg-green-50': !errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'] && $el.value}"
                                        >
                                            <option value="">Seleccionar...</option>
                                            @if($campo->opciones)
                                                @foreach($campo->opciones as $valor => $etiqueta)
                                                    <option value="{{ $valor }}" {{ old($campo->nombre, isset($registro) ? $registro->{$campo->nombre} : '') == $valor ? 'selected' : '' }}>
                                                        {{ $etiqueta }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p x-show="errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}']" x-text="errors['{{ $campo->nombre }}']" class="mt-0.5 text-xs text-red-600" style="display: none;"></p>
                                        @error($campo->nombre) <p class="mt-0.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
    
                                @elseif($campo->tipo_campo === 'textarea')
                                    <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">
                                            {{ $campo->etiqueta }} @if($campo->requerido) <span class="text-red-500">*</span> @endif
                                        </label>
                                        <textarea name="{{ $campo->nombre }}" 
                                                  rows="2"
                                                  {{ $campo->requerido ? 'required' : '' }}
                                                  @input="validateField('{{ $campo->nombre }}', $event.target.value, {{ $campo->requerido ? 'true' : 'false' }})"
                                                  @blur="touched['{{ $campo->nombre }}'] = true"
                                                  placeholder="{{ $campo->placeholder ?? '' }}" 
                                                  class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                                  :class="{'border-red-500 bg-red-50': errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'], 'border-green-500 bg-green-50': !errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}'] && $el.value}"
                                        >{{ old($campo->nombre, isset($registro) ? $registro->{$campo->nombre} : '') }}</textarea>
                                        <p x-show="errors['{{ $campo->nombre }}'] && touched['{{ $campo->nombre }}']" x-text="errors['{{ $campo->nombre }}']" class="mt-0.5 text-xs text-red-600" style="display: none;"></p>
                                        @error($campo->nombre) <p class="mt-0.5 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('patologias.index', $tipo->slug) }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-all text-sm shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit" 
                                :disabled="hasErrors()"
                                class="px-4 py-2 bg-{{ $tipo->color }}-600 text-white font-medium rounded-lg shadow-sm transition-colors text-sm flex items-center gap-2"
                                :class="{'opacity-50 cursor-not-allowed': hasErrors(), 'hover:bg-{{ $tipo->color }}-700': !hasErrors()}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ isset($registro) ? 'Actualizar Registro' : 'Guardar Registro' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function formValidation() {
        return {
            errors: {},
            touched: {},
            
            validateField(field, value, required) {
                // Limpiar error previo
                delete this.errors[field];
                
                // Validación de requerido
                if (required && (!value || value.trim() === '')) {
                    this.errors[field] = 'Campo obligatorio';
                    return;
                }

                // Validación específica para cédula (solo números)
                if (field === 'cedula') {
                    if (value.length < 5) {
                        this.errors[field] = 'Mínimo 5 dígitos';
                    } else if (!/^\d+$/.test(value)) {
                        this.errors[field] = 'Solo números';
                    }
                }

                // Validación para edad (positivo)
                if (field === 'edad') {
                    if (value < 0 || value > 120) {
                        this.errors[field] = 'Edad inválida';
                    }
                }
            },

            hasErrors() {
                // Verificar si hay errores en el objeto errors
                return Object.keys(this.errors).length > 0;
            }
        }
    }
</script>
@endsection
