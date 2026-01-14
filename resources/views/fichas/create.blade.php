@extends('layouts.admin')

@section('title', 'Nueva Ficha Familiar')

@section('content')
    <div class="mb-8">
        <a href="{{ route('familias.fichas.index', $familia) }}" class="flex items-center text-sm text-slate-500 hover:text-lb-primary transition-colors mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a fichas
        </a>
        <h1 class="text-3xl font-display font-bold text-slate-900">Historia Clínica Familiar</h1>
        <p class="mt-2 text-sm text-slate-600">{{ $familia->apellidos }}</p>
    </div>

    <form action="{{ route('familias.fichas.store', $familia) }}" method="POST" class="max-w-6xl">
        @csrf
        
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 space-y-8">
            
            {{-- Encabezado Institucional --}}
            <div class="text-center border-b border-slate-200 pb-6">
                <p class="text-xs text-slate-600">Gobierno Bolivariano de Venezuela | Ministerio del Poder Popular para La Salud</p>
                <p class="text-xs text-slate-600 mt-1">República Bolivariana de Venezuela</p>
                <p class="text-xs text-slate-600">Misión Médica Cubana</p>
                <p class="text-xs text-slate-600">Fundación Misión Barrio Adentro</p>
                <h2 class="text-xl font-bold text-slate-900 mt-4">HISTORIA CLÍNICA FAMILIAR</h2>
            </div>

            {{-- DATOS DE IDENTIFICACIÓN --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">DATOS DE IDENTIFICACIÓN</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">ASIC</label>
                        <input type="text" name="asic" value="{{ old('asic') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('asic')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">CONSULTORIO</label>
                        <input type="text" name="consultorio" value="{{ old('consultorio') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('consultorio')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">№ HC</label>
                        <input type="text" name="numero_hc" value="{{ old('numero_hc') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('numero_hc')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">DIRECCIÓN</label>
                    <textarea name="direccion" rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">{{ old('direccion') }}</textarea>
                    @error('direccion')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">ESTADO</label>
                        <input type="text" name="estado" value="{{ old('estado') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('estado')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">MUNICIPIO</label>
                        <input type="text" name="municipio" value="{{ old('municipio') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('municipio')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">PARROQUIA</label>
                        <input type="text" name="parroquia" value="{{ old('parroquia') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        @error('parroquia')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            </div>

            {{-- SECCIÓN 1: INTEGRANTES DE LA FAMILIA --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">1 - INTEGRANTES DE LA FAMILIA</h3>
                
                <div class="overflow-x-auto border border-slate-200 rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nº</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nombres y Apellidos</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Fecha Nac.</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Edad</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sexo</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Cédula</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach($familia->integrantes as $index => $integrante)
                            <tr>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-900">{{ $index + 1 }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-900">{{ $integrante->name }} {{ $integrante->apellido }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-500">{{ $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->format('d/m/Y') : '-' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-500">{{ $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->age : '-' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-500">{{ $integrante->sexo ?? '-' }}</td>
                                <td class="px-3 py-2 whitespace-nowrap text-sm text-slate-500">{{ $integrante->cedula }}</td>
                            </tr>
                            @endforeach
                            @if($familia->integrantes->isEmpty())
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-sm text-gray-500">No hay integrantes registrados en esta familia.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <p class="mt-2 text-xs text-slate-500">Nota: Los integrantes se gestionan desde el módulo de Familias.</p>
            </div>

            {{-- SECCIÓN 2: CLASIFICACIÓN DE LA FAMILIA --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">2 - CLASIFICACIÓN DE LA FAMILIA</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Según Número de Miembros</label>
                        <select name="numero_miembros" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            <option value="">Seleccionar...</option>
                            <option value="pequena" {{ old('numero_miembros') == 'pequena' ? 'selected' : '' }}>Pequeña</option>
                            <option value="mediana" {{ old('numero_miembros') == 'mediana' ? 'selected' : '' }}>Mediana</option>
                            <option value="grande" {{ old('numero_miembros') == 'grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Antecedentes de la Familia</label>
                        <select name="antecedentes_familia" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            <option value="">Seleccionar...</option>
                            <option value="nuclear" {{ old('antecedentes_familia') == 'nuclear' ? 'selected' : '' }}>Nuclear</option>
                            <option value="extensa" {{ old('antecedentes_familia') == 'extensa' ? 'selected' : '' }}>Extensa</option>
                            <option value="ampliada" {{ old('antecedentes_familia') == 'ampliada' ? 'selected' : '' }}>Ampliada</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Número de Generaciones</label>
                        <select name="numero_generaciones" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            <option value="">Seleccionar...</option>
                            <option value="unigeneracional" {{ old('numero_generaciones') == 'unigeneracional' ? 'selected' : '' }}>Unigeneracional</option>
                            <option value="bigeneracional" {{ old('numero_generaciones') == 'bigeneracional' ? 'selected' : '' }}>Bigeneracional</option>
                            <option value="trigeneracional" {{ old('numero_generaciones') == 'trigeneracional' ? 'selected' : '' }}>Trigeneracional</option>
                            <option value="multigeneracional" {{ old('numero_generaciones') == 'multigeneracional' ? 'selected' : '' }}>Multigeneracional</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Etapas de Desarrollo</label>
                        <select name="etapa_desarrollo" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            <option value="">Seleccionar...</option>
                            <option value="formacion" {{ old('etapa_desarrollo') == 'formacion' ? 'selected' : '' }}>Formación</option>
                            <option value="contraccion" {{ old('etapa_desarrollo') == 'contraccion' ? 'selected' : '' }}>Contracción</option>
                            <option value="extension" {{ old('etapa_desarrollo') == 'extension' ? 'selected' : '' }}>Extensión</option>
                            <option value="disolucion" {{ old('etapa_desarrollo') == 'disolucion' ? 'selected' : '' }}>Disolución</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN 4: CONDICIONES SOCIOECONÓMICAS --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">4 - CONDICIONES SOCIOECONÓMICAS</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ingreso Percápita</label>
                        <input type="number" name="ingreso_percapita" value="{{ old('ingreso_percapita') }}" step="0.01" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">№ Trabajadores</label>
                        <input type="number" name="numero_trabajadores" value="{{ old('numero_trabajadores') }}" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cocina</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="cocina_gas" value="1" {{ old('cocina_gas') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Gas</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="cocina_electrica" value="1" {{ old('cocina_electrica') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Eléctrica</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="cocina_lena" value="1" {{ old('cocina_lena') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Leña</span>
                        </label>
                        <div>
                            <input type="text" name="cocina_otra" value="{{ old('cocina_otra') }}" placeholder="Otra..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Equipos Electrodomésticos</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="tiene_refrigerador" value="1" {{ old('tiene_refrigerador') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Refrigerador</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="tiene_televisor" value="1" {{ old('tiene_televisor') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Televisor</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="tiene_ventilador" value="1" {{ old('tiene_ventilador') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm text-slate-700">Ventilador</span>
                        </label>
                        <div>
                            <input type="text" name="otros_equipos" value="{{ old('otros_equipos') }}" placeholder="Otro..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN 5: CONDICIONES ESTRUCTURALES --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">5 - CONDICIONES ESTRUCTURALES DE LA VIVIENDA</h3>
                
                <div class="space-y-4">
                    {{-- Tipo de Vivienda --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tipo de Vivienda</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['casa' => 'Casa', 'apartamento' => 'Apartamento', 'habitacion' => 'Habitación', 'rancho' => 'Rancho', 'palafito' => 'Palafito'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="tipo_vivienda" value="{{ $val }}" {{ old('tipo_vivienda') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="tipo_vivienda_otros" value="{{ old('tipo_vivienda_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Material de Construcción --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Material de Construcción</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['bloque' => 'Bloque', 'madera' => 'Madera', 'bahareque' => 'Bahareque', 'carton' => 'Cartón', 'zinc' => 'Zinc'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="material_construccion" value="{{ $val }}" {{ old('material_construccion') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="material_otros" value="{{ old('material_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Techos --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Techos</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['placa' => 'Placa', 'asbesto' => 'Asbesto', 'acerolit' => 'Acerolit', 'guano' => 'Guano', 'zinc' => 'Zinc'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="tipo_techo" value="{{ $val }}" {{ old('tipo_techo') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="techo_otros" value="{{ old('techo_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Pisos --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Pisos</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['losas' => 'Losas', 'cemento' => 'Cemento', 'tierra' => 'Tierra', 'madera' => 'Madera'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="tipo_piso" value="{{ $val }}" {{ old('tipo_piso') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="piso_otros" value="{{ old('piso_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Estado Constructivo --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Estado Constructivo</label>
                        <div class="flex gap-4">
                            @foreach(['buena' => 'Buena', 'regular' => 'Regular', 'mala' => 'Mala'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="estado_constructivo" value="{{ $val }}" {{ old('estado_constructivo') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Hacinamiento --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="hacinamiento" value="1" {{ old('hacinamiento') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm font-medium text-slate-700">Hacinamiento</span>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">№ Habitantes</label>
                            <input type="number" name="numero_habitantes" value="{{ old('numero_habitantes') }}" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">№ Habitaciones</label>
                            <input type="number" name="numero_habitaciones" value="{{ old('numero_habitaciones') }}" min="0" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                        </div>
                    </div>

                    {{-- Servicio Eléctrico --}}
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="servicio_electrico" value="1" {{ old('servicio_electrico') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                            <span class="ml-2 text-sm font-medium text-slate-700">Servicio Eléctrico</span>
                        </label>
                    </div>

                    {{-- Abasto de Agua --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Abasto de Agua</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach(['pozos' => 'Pozos', 'acueducto' => 'Acueducto', 'manantial' => 'Manantial', 'rio' => 'Río'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="abasto_agua" value="{{ $val }}" {{ old('abasto_agua') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="agua_otros" value="{{ old('agua_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Baño Sanitario --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Baño Sanitario</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach(['bano' => 'Baño', 'letrina' => 'Letrina', 'no_posee' => 'No posee'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="bano_sanitario" value="{{ $val }}" {{ old('bano_sanitario') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="bano_otros" value="{{ old('bano_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Destino Residuales Líquidos --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Destino Final Residuales Líquidos</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach(['alcantarillado' => 'Alcantarillado', 'pozos_septico' => 'Pozos Séptico'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="destino_residuales" value="{{ $val }}" {{ old('destino_residuales') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="residuales_otros" value="{{ old('residuales_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Destino Desechos Sólidos --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Destino Final Desechos Sólidos</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach(['recogida_local' => 'Recogida Local', 'vertederos' => 'Vertederos'] as $val => $label)
                            <label class="flex items-center">
                                <input type="radio" name="destino_desechos" value="{{ $val }}" {{ old('destino_desechos') == $val ? 'checked' : '' }} class="border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">{{ $label }}</span>
                            </label>
                            @endforeach
                            <div>
                                <input type="text" name="desechos_otros" value="{{ old('desechos_otros') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Animales Domésticos --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Animales Domésticos</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="tiene_perros" value="1" {{ old('tiene_perros') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">Perros</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="tiene_gatos" value="1" {{ old('tiene_gatos') ? 'checked' : '' }} class="rounded border-slate-300 text-lb-primary focus:ring-lb-primary">
                                <span class="ml-2 text-sm text-slate-700">Gatos</span>
                            </label>
                            <div>
                                <input type="text" name="otros_animales" value="{{ old('otros_animales') }}" placeholder="Otros..." class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Vectores --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Vectores</label>
                        <input type="text" name="vectores" value="{{ old('vectores') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm" placeholder="Especificar vectores presentes...">
                    </div>
                </div>
            </div>

            {{-- SECCIÓN 6: DISCUSIÓN Y EVALUACIÓN --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-900 border-b border-slate-200 pb-2 mb-4">6 - DISCUSIÓN Y EVALUACIÓN FAMILIAR</h3>
                <textarea name="discusion_evaluacion" rows="10" class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-lb-primary focus:border-lb-primary text-sm" placeholder="Espacio para narrativa de evaluación familiar...">{{ old('discusion_evaluacion') }}</textarea>
                @error('discusion_evaluacion')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Botones de Acción --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('familias.fichas.index', $familia) }}" class="py-2 px-4 border border-slate-300 rounded-md shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-lb-primary hover:bg-lb-primary-dark transition-colors">
                    Guardar Ficha Familiar
                </button>
            </div>
        </div>
    </form>
@endsection
