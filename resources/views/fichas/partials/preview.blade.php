{{-- Vista Previa Completa de Ficha Médica --}}
<div class="space-y-3">
    
    {{-- Encabezado con Logos Superior --}}
    <div class="flex justify-between items-end mb-2 px-1">
        <div class="flex items-center">
            {{-- Logo Gobierno "Un poquis más y más largo" --}}
            <img src="{{ asset('images/logos/gobierno-salud.png') }}" alt="Gobierno Bolivariano" class="h-24 w-auto object-contain" style="height: 6rem;">
        </div>
        <div>
            <img src="{{ asset('images/logos/barrio-adentro.jpg') }}" alt="Barrio Adentro" class="h-16 object-contain">
        </div>
    </div>

    {{-- Línea Separadora Visible --}}
    <div class="w-full my-2" style="border-bottom: 2px solid #000;"></div>

    {{-- Sección Inferior: Títulos y Logo Circular --}}
    <div class="flex justify-between items-start mb-4 relative min-h-[6.5rem]">
        <div class="w-full text-center text-xs leading-tight pt-2">
            <p class="font-bold">República Bolivariana de Venezuela</p>
            <p class="font-bold">Misión Médica Cubana</p>
            <p class="font-bold">Fundación Misión Barrio Adentro</p>
            <h2 class="text-base font-bold mt-2">HISTORIA CLÍNICA FAMILIAR</h2>
        </div>

        {{-- Logo Circular más grande --}}
        <div class="absolute top-0 right-0 flex flex-col items-center">
            <span class="text-[7px] font-bold mb-0.5">MODELO 18-02</span>
            <img src="{{ asset('images/logos/mision-medica.jpg') }}" alt="Misión Médica Cubana" class="h-24 w-24 object-contain rounded-full" style="height: 6rem; width: 6rem;">
        </div>
    </div>

    {{-- Datos de Identificación --}}
    <div class="text-xs space-y-1">
        <div class="grid grid-cols-3 gap-2">
            <div><span class="font-bold">ASIC:</span> {{ $ficha->asic ?? '' }}</div>
            <div><span class="font-bold">CONSULTORIO:</span> {{ $ficha->consultorio ?? '' }}</div>
            <div><span class="font-bold">Nº HC:</span> {{ $ficha->numero_hc ?? '' }}</div>
        </div>
        <div><span class="font-bold">FAMILIA:</span> {{ $familia->apellidos }}</div>
        <div><span class="font-bold">DIRECCIÓN:</span> {{ $ficha->direccion ?? '' }}</div>
        <div class="grid grid-cols-3 gap-2">
            <div><span class="font-bold">ESTADO:</span> {{ $ficha->estado ?? '' }}</div>
            <div><span class="font-bold">MUNICIPIO:</span> {{ $ficha->municipio ?? '' }}</div>
            <div><span class="font-bold">PARROQUIA:</span> {{ $ficha->parroquia ?? '' }}</div>
        </div>
    </div>

    {{-- Tabla de TODOS los Integrantes --}}
    <div>
        <h3 class="font-bold text-sm mb-1">1 - INTEGRANTES DE LA FAMILIA</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-slate-900 p-1 w-6">Nº</th>
                        <th class="border border-slate-900 p-1 text-left">NOMBRES Y APELLIDOS</th>
                        <th class="border border-slate-900 p-1">F. NAC.</th>
                        <th class="border border-slate-900 p-1 w-8">EDAD</th>
                        <th class="border border-slate-900 p-1 w-8">SEXO</th>
                        <th class="border border-slate-900 p-1">CÉDULA</th>
                        <th class="border border-slate-900 p-1">ESCOLARIDAD</th>
                        <th class="border border-slate-900 p-1 w-8">G.D.</th>
                        <th class="border border-slate-900 p-1">PATOLOGÍAS</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $integrantes = $familia->integrantes;
                        $totalFilas = max(12, $integrantes->count());
                    @endphp
                    
                    @for($i = 0; $i < $totalFilas; $i++)
                        @php
                            $integrante = $integrantes[$i] ?? null;
                        @endphp
                        <tr>
                            <td class="border border-slate-900 p-1 text-center">{{ $i + 1 }}</td>
                            <td class="border border-slate-900 p-1">{{ $integrante ? ($integrante->name . ' ' . $integrante->apellido) : '' }}</td>
                            <td class="border border-slate-900 p-1 text-center">{{ $integrante && $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->format('d/m/Y') : '' }}</td>
                            <td class="border border-slate-900 p-1 text-center">{{ $integrante && $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->age : '' }}</td>
                            <td class="border border-slate-900 p-1 text-center">{{ $integrante ? strtoupper(substr($integrante->sexo ?? '', 0, 1)) : '' }}</td>
                            <td class="border border-slate-900 p-1 text-center">{{ $integrante->cedula ?? '' }}</td>
                            <td class="border border-slate-900 p-1 text-left px-1">{{ $integrante->escolaridad ?? '' }}</td>
                            <td class="border border-slate-900 p-1 text-center">{{ $integrante->grupo_dispensarial ?? '' }}</td>
                            <td class="border border-slate-900 p-1 text-left px-1">{{ $integrante->patologias ?? '' }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <p class="text-[6px] mt-1 italic">G.D.: Grupo Dispensarial</p>
    </div>

    {{-- Clasificación de la Familia COMPLETA --}}
    <div>
        <h3 class="font-bold text-sm mb-1">2 - CLASIFICACIÓN DE LA FAMILIA</h3>
        <div class="text-xs space-y-1 ml-2">
            {{-- Según número de miembros --}}
            <p>
                <span class="font-bold">Según Número de Miembros:</span>
                Pequeña {{ $ficha->numero_miembros == 'pequena' ? '☑' : '☐' }} | 
                Mediana {{ $ficha->numero_miembros == 'mediana' ? '☑' : '☐' }} | 
                Grande {{ $ficha->numero_miembros == 'grande' ? '☑' : '☐' }}
            </p>
            {{-- Según Tipos de la Familia --}}
            <p>
                <span class="font-bold">Según Tipos de la Familia:</span>
                Nuclear {{ $ficha->antecedentes_familia == 'nuclear' ? '☑' : '☐' }} | 
                Extensa {{ $ficha->antecedentes_familia == 'extensa' ? '☑' : '☐' }} | 
                Ampliada {{ $ficha->antecedentes_familia == 'ampliada' ? '☑' : '☐' }}
            </p>
            {{-- Número de generaciones --}}
            <p>
                <span class="font-bold">Número de generaciones:</span>
                Unigeneracional {{ $ficha->numero_generaciones == 'unigeneracional' ? '☑' : '☐' }} | 
                Bigeneracional {{ $ficha->numero_generaciones == 'bigeneracional' ? '☑' : '☐' }} | 
                Trigeneracional {{ $ficha->numero_generaciones == 'trigeneracional' ? '☑' : '☐' }} | 
                Multigeneracional {{ $ficha->numero_generaciones == 'multigeneracional' ? '☑' : '☐' }}
            </p>
            {{-- Etapas de desarrollo --}}
            <p>
                <span class="font-bold">Etapa de Desarrollo:</span>
                Formación {{ $ficha->etapa_desarrollo == 'formacion' ? '☑' : '☐' }} | 
                Contracción {{ $ficha->etapa_desarrollo == 'contraccion' ? '☑' : '☐' }} | 
                Extensión {{ $ficha->etapa_desarrollo == 'extension' ? '☑' : '☐' }} | 
                Disolución {{ $ficha->etapa_desarrollo == 'disolucion' ? '☑' : '☐' }}
            </p>
        </div>
    </div>

    {{-- Familiograma --}}
    <div>
        <h3 class="font-bold text-sm mb-1">3 - FAMILIOGRAMA</h3>
        <div class="border border-slate-900 h-32 bg-gray-50"></div>
    </div>

    {{-- Condiciones Socioeconómicas COMPLETAS --}}
    <div>
        <h3 class="font-bold text-sm mb-1">4 - CONDICIONES SOCIOECONÓMICAS</h3>
        <div class="text-xs space-y-1 ml-2">
            <p>
                <span class="font-bold">Ingreso Percápita:</span> {{ $ficha->ingreso_percapita ?? '' }} | 
                <span class="font-bold">N° Trabajadores:</span> {{ $ficha->numero_trabajadores ?? '' }}
            </p>
            <p>
                <span class="font-bold">Cocina:</span>
                Gas {{ $ficha->cocina_gas ? '☑' : '☐' }} | 
                Eléctrica {{ $ficha->cocina_electrica ? '☑' : '☐' }} | 
                Leña {{ $ficha->cocina_lena ? '☑' : '☐' }} | 
                Otra: {{ $ficha->cocina_otra ?? '' }}
            </p>
            <p>
                <span class="font-bold">Equipos electrodomésticos:</span>
                Refrigerador {{ $ficha->tiene_refrigerador ? '☑' : '☐' }} | 
                Televisor {{ $ficha->tiene_televisor ? '☑' : '☐' }} | 
                Ventilador {{ $ficha->tiene_ventilador ? '☑' : '☐' }} | 
                Otro: {{ $ficha->otros_equipos ?? '' }}
            </p>
        </div>
    </div>

    {{-- Condiciones Estructurales COMPLETAS --}}
    <div>
        <h3 class="font-bold text-sm mb-1">5 - CONDICIONES ESTRUCTURALES DE LA VIVIENDA</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-[11px]">
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100 w-24">Tipo de vivienda</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Casa {{ $ficha->tipo_vivienda == 'casa' ? '☑' : '☐' }} | 
                        Apartamento {{ $ficha->tipo_vivienda == 'apartamento' ? '☑' : '☐' }} | 
                        Habitación {{ $ficha->tipo_vivienda == 'habitacion' ? '☑' : '☐' }} | 
                        Rancho {{ $ficha->tipo_vivienda == 'rancho' ? '☑' : '☐' }} | 
                        Palafito {{ $ficha->tipo_vivienda == 'palafito' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->tipo_vivienda_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Material de construcción</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Bloque {{ $ficha->material_construccion == 'bloque' ? '☑' : '☐' }} | 
                        Madera {{ $ficha->material_construccion == 'madera' ? '☑' : '☐' }} | 
                        Barro {{ $ficha->material_construccion == 'bahareque' ? '☑' : '☐' }} | 
                        Cartón {{ $ficha->material_construccion == 'carton' ? '☑' : '☐' }} | 
                        Zinc {{ $ficha->material_construccion == 'zinc' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->material_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Techos</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Placa {{ $ficha->tipo_techo == 'placa' ? '☑' : '☐' }} | 
                        Asbesto {{ $ficha->tipo_techo == 'asbesto' ? '☑' : '☐' }} | 
                        Acerolit {{ $ficha->tipo_techo == 'acerolit' ? '☑' : '☐' }} | 
                        Guano {{ $ficha->tipo_techo == 'guano' ? '☑' : '☐' }} | 
                        Zinc {{ $ficha->tipo_techo == 'zinc' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->techo_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Pisos</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Lozas {{ $ficha->tipo_piso == 'losas' ? '☑' : '☐' }} | 
                        Cemento {{ $ficha->tipo_piso == 'cemento' ? '☑' : '☐' }} | 
                        Tierra {{ $ficha->tipo_piso == 'tierra' ? '☑' : '☐' }} | 
                        Madera {{ $ficha->tipo_piso == 'madera' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->piso_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Estado constructivo</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Buena {{ $ficha->estado_constructivo == 'buena' ? '☑' : '☐' }} | 
                        Regular {{ $ficha->estado_constructivo == 'regular' ? '☑' : '☐' }} | 
                        Mala {{ $ficha->estado_constructivo == 'mala' ? '☑' : '☐' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Hacinamiento</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Sí {{ $ficha->hacinamiento ? '☑' : '☐' }} | 
                        No {{ !$ficha->hacinamiento ? '☑' : '☐' }} | 
                        N° de Habitantes: {{ $ficha->numero_habitantes ?? '' }} | 
                        N° de Habitaciones: {{ $ficha->numero_habitaciones ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Servicio eléctrico</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Sí {{ $ficha->servicio_electrico ? '☑' : '☐' }} | 
                        No {{ !$ficha->servicio_electrico ? '☑' : '☐' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Abasto de agua</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Pozos {{ $ficha->abasto_agua == 'pozos' ? '☑' : '☐' }} | 
                        Acueducto {{ $ficha->abasto_agua == 'acueducto' ? '☑' : '☐' }} | 
                        Manantial {{ $ficha->abasto_agua == 'manantial' ? '☑' : '☐' }} | 
                        Río {{ $ficha->abasto_agua == 'rio' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->agua_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Baño Sanitario</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Baño {{ $ficha->bano_sanitario == 'bano' ? '☑' : '☐' }} | 
                        Letrina {{ $ficha->bano_sanitario == 'letrina' ? '☑' : '☐' }} | 
                        No posee {{ $ficha->bano_sanitario == 'no_posee' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->bano_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Destino final residuales líquidos</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Alcantarillado {{ $ficha->destino_residuales == 'alcantarillado' ? '☑' : '☐' }} | 
                        Pozos séptico {{ $ficha->destino_residuales == 'pozos_septico' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->residuales_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Destino final desechos sólidos</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Recogida local {{ $ficha->destino_desechos == 'recogida_local' ? '☑' : '☐' }} | 
                        Vertederos {{ $ficha->destino_desechos == 'vertederos' ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->desechos_otros ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Animales domésticos</td>
                    <td class="border border-slate-900 p-1" colspan="6">
                        Perros {{ $ficha->tiene_perros ? '☑' : '☐' }} | 
                        Gatos {{ $ficha->tiene_gatos ? '☑' : '☐' }} | 
                        Otros: {{ $ficha->otros_animales ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="border border-slate-900 p-1 font-bold bg-gray-100">Vectores</td>
                    <td class="border border-slate-900 p-1 text-left" colspan="6">{{ $ficha->vectores ?? '' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Discusión y Evaluación COMPLETA --}}
    <div>
        <h3 class="font-bold text-sm mb-1">6 - DISCUSIÓN Y EVALUACIÓN FAMILIAR</h3>
        <div class="border border-slate-900 p-2 text-xs min-h-24 bg-white whitespace-pre-wrap">{{ $ficha->discusion_evaluacion ?? '' }}</div>
    </div>

</div>
