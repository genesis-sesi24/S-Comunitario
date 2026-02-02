@extends('layouts.admin')

@section('title', 'Registro de ' . $tipo->nombre)

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

    <div class="max-w-5xl" x-data="formValidation()">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-display font-bold text-slate-900">{{ isset($registro) ? 'Editar Paciente' : 'Nuevo Paciente' }}</h1>
                <p class="text-xs text-slate-500">{{ $tipo->nombre }}</p>
            </div>
            <a href="{{ route('patologias.index', $tipo->slug) }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Volver
            </a>
        </div>

        <form action="{{ isset($registro) ? route('patologias.update', [$tipo->slug, $registro->id]) : route('patologias.store', $tipo->slug) }}" 
              method="POST" 
              class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden"
              @submit="if(hasErrors()) { $event.preventDefault(); return; }">
            
            @csrf
            @if(isset($registro))
                @method('PUT')
            @endif

            <div class="p-6 space-y-6">
                <!-- 1. Datos Personales -->
                <div>
                    <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 rounded bg-slate-100 flex items-center justify-center text-slate-500 text-[10px]">1</span>
                        Datos Personales
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nombre <span class="text-red-500">*</span></label>
                            <input type="text" name="nombre" value="{{ old('nombre', $registro->nombre ?? '') }}" required
                                   @input="validateField('nombre', $event.target.value, true)"
                                   @blur="touched.nombre = true"
                                   class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                   :class="{'border-red-500 bg-red-50': errors.nombre && touched.nombre, 'border-green-500 bg-green-50': !errors.nombre && touched.nombre && $el.value}">
                            <p x-show="errors.nombre && touched.nombre" x-text="errors.nombre" class="mt-0.5 text-[10px] text-red-600" style="display: none;"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Apellido <span class="text-red-500">*</span></label>
                            <input type="text" name="apellido" value="{{ old('apellido', $registro->apellido ?? '') }}" required
                                   @input="validateField('apellido', $event.target.value, true)"
                                   @blur="touched.apellido = true"
                                   class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 focus:border-{{ $tipo->color }}-500 transition-colors"
                                   :class="{'border-red-500 bg-red-50': errors.apellido && touched.apellido, 'border-green-500 bg-green-50': !errors.apellido && touched.apellido && $el.value}">
                            <p x-show="errors.apellido && touched.apellido" x-text="errors.apellido" class="mt-0.5 text-[10px] text-red-600" style="display: none;"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Cédula <span class="text-red-500">*</span></label>
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
                                <select name="cedula_tipo" class="w-16 px-2 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">
                                    <option value="N" {{ old('cedula_tipo', $cedulaType) == 'N' ? 'selected' : '' }}>N</option>
                                    <option value="J" {{ old('cedula_tipo', $cedulaType) == 'J' ? 'selected' : '' }}>J</option>
                                </select>
                                <input type="number" name="cedula" value="{{ $cedulaNum }}" required
                                       @input="validateField('cedula', $event.target.value, true)"
                                       @blur="touched.cedula = true"
                                       class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 transition-colors"
                                       :class="{'border-red-500 bg-red-50': errors.cedula && touched.cedula, 'border-green-500 bg-green-50': !errors.cedula && touched.cedula && $el.value}">
                            </div>
                            <p x-show="errors.cedula && touched.cedula" x-text="errors.cedula" class="mt-0.5 text-[10px] text-red-600" style="display: none;"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Edad <span class="text-red-500">*</span></label>
                            <input type="number" name="edad" value="{{ old('edad', $registro->edad ?? '') }}" required
                                   @input="validateField('edad', $event.target.value, true)"
                                   @blur="touched.edad = true"
                                   class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 transition-colors"
                                   :class="{'border-red-500 bg-red-50': errors.edad && touched.edad, 'border-green-500 bg-green-50': !errors.edad && touched.edad && $el.value}">
                            <p x-show="errors.edad && touched.edad" x-text="errors.edad" class="mt-0.5 text-[10px] text-red-600" style="display: none;"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sexo <span class="text-red-500">*</span></label>
                            <select name="sexo" required
                                    @change="validateField('sexo', $event.target.value, true)"
                                    @blur="touched.sexo = true"
                                    class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500 transition-colors"
                                    :class="{'border-red-500 bg-red-50': errors.sexo && touched.sexo, 'border-green-500 bg-green-50': !errors.sexo && touched.sexo && $el.value}">
                                <option value="">Seleccionar...</option>
                                <option value="M" {{ old('sexo', $registro->sexo ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $registro->sexo ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            <p x-show="errors.sexo && touched.sexo" x-text="errors.sexo" class="mt-0.5 text-[10px] text-red-600" style="display: none;"></p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $registro->telefono ?? '') }}"
                                   class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Dirección Completa</label>
                        <textarea name="direccion" rows="1" 
                                  class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">{{ old('direccion', $registro->direccion ?? '') }}</textarea>
                    </div>
                </div>

                <hr class="border-slate-100">

                <!-- 2. Condiciones y Hábitos -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <span class="w-5 h-5 rounded bg-red-50 flex items-center justify-center text-red-500 text-[10px]">2</span>
                            Condiciones Médicas
                        </h2>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach(['hta' => 'HTA (Hipertensión)', 'erc' => 'Enf. Renal Crónica', 'iam' => 'Infarto (IAM)', 'acv' => 'ACV (Cerebrovascular)', 'dislipidemia' => 'Dislipidemia', 'fumador' => 'Fumador'] as $key => $label)
                            <label class="flex items-center p-2 border border-slate-100 rounded-lg hover:bg-slate-50 cursor-pointer transition-colors">
                                <input type="checkbox" name="{{ $key }}" value="1" {{ old($key, $registro->{$key} ?? 0) ? 'checked' : '' }} 
                                       class="w-4 h-4 text-red-600 rounded focus:ring-red-500 border-gray-300">
                                <span class="ml-2 text-xs text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <span class="w-5 h-5 rounded bg-blue-50 flex items-center justify-center text-blue-500 text-[10px]">3</span>
                            Ubicación y Centro
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Municipio</label>
                                <input type="text" name="municipio" value="{{ old('municipio', $registro->municipio ?? '') }}"
                                       class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Centro de Salud</label>
                                <input type="text" name="centro_salud" value="{{ old('centro_salud', $registro->centro_salud ?? '') }}"
                                       class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                <!-- 3. Tratamiento -->
                <div>
                    <h2 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <span class="w-5 h-5 rounded bg-blue-50 flex items-center justify-center text-blue-500 text-[10px]">4</span>
                        Tratamiento Farmacológico
                    </h2>
                    
                    @php
                        $meds = [
                            ['key' => 'amlodipino', 'label' => 'Amlodipino', 'doses' => ['5mg', '10mg']],
                            ['key' => 'atenolol', 'label' => 'Atenolol', 'doses' => ['50mg', '100mg']],
                            ['key' => 'atorvastatina', 'label' => 'Atorvastatina', 'doses' => ['20mg', '40mg']],
                            ['key' => 'captopril', 'label' => 'Captopril', 'doses' => ['25mg', '50mg']],
                            ['key' => 'carvedilol', 'label' => 'Carvedilol', 'doses' => ['6.25mg', '12.5mg']],
                            ['key' => 'clopidogrel', 'label' => 'Clopidogrel', 'doses' => []], 
                            ['key' => 'enalapril', 'label' => 'Enalapril', 'doses' => ['10mg', '20mg']],
                            ['key' => 'losartan', 'label' => 'Losartán', 'doses' => ['50mg', '100mg']],
                            ['key' => 'sinvastatina', 'label' => 'Sinvastatina', 'doses' => []],
                            ['key' => 'aspirina', 'label' => 'Aspirina 81mg', 'doses' => []],
                            ['key' => 'dinitrato_isosorbide', 'label' => 'Dinitrato Iso.', 'doses' => []],
                            ['key' => 'digoxina', 'label' => 'Digoxina', 'doses' => []],
                            ['key' => 'furosemida', 'label' => 'Furosemida', 'doses' => []],
                            ['key' => 'verapamilo', 'label' => 'Verapamilo', 'doses' => []],
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        @foreach($meds as $med)
                            <div class="p-2 border border-slate-100 rounded-lg hover:bg-slate-50 transition-colors flex flex-col justify-between">
                                <label class="flex items-center cursor-pointer mb-2">
                                    <input type="checkbox" name="{{ $med['key'] }}" value="1" 
                                           {{ old($med['key'], $registro->{$med['key']} ?? 0) ? 'checked' : '' }} 
                                           class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-[11px] font-medium text-slate-700 truncate">{{ $med['label'] }}</span>
                                </label>
                                
                                @if(!empty($med['doses']))
                                    <select name="{{ $med['key'] }}_dosis" class="text-[10px] w-full border-gray-200 rounded bg-white py-0.5">
                                        <option value="">Dosis...</option>
                                        @foreach($med['doses'] as $dose)
                                            <option value="{{ $dose }}" {{ old($med['key'].'_dosis', $registro->{$med['key'].'_dosis'} ?? '') == $dose ? 'selected' : '' }}>
                                                {{ $dose }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Observaciones / Otros Medicamentos</label>
                    <textarea name="observaciones" rows="2" 
                              class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-{{ $tipo->color }}-500">{{ old('observaciones', $registro->observaciones ?? '') }}</textarea>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('patologias.index', $tipo->slug) }}" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-all text-sm shadow-sm">
                    Cancelar
                </a>
                <button type="submit" 
                        :disabled="hasErrors()"
                        class="px-5 py-2 bg-{{ $tipo->color }}-600 text-white font-bold rounded-lg shadow-sm transition-all text-sm flex items-center gap-2"
                        :class="{'opacity-50 cursor-not-allowed': hasErrors(), 'hover:bg-{{ $tipo->color }}-700': !hasErrors()}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ isset($registro) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function formValidation() {
        return {
            errors: {},
            touched: {},
            
            validateField(field, value, required) {
                delete this.errors[field];
                if (required && (!value || value.trim() === '')) {
                    this.errors[field] = 'Obligatorio';
                    return;
                }
                if (field === 'cedula') {
                    if (value.length < 5) this.errors[field] = 'Mínimo 5';
                    else if (!/^\d+$/.test(value)) this.errors[field] = 'Solo números';
                }
                if (field === 'edad') {
                    if (value < 0 || value > 120) this.errors[field] = 'Inválido';
                }
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            }
        }
    }
</script>
@endsection
