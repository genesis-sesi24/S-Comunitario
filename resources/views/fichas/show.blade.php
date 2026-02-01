<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Clínica Familiar - {{ $familia->apellidos }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page { margin: 1cm; size: letter; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
            .print-border { border: 1px solid #000 !important; }
        }
        
        body { 
            font-family: 'Arial', sans-serif; 
            font-size: 10px; 
            line-height: 1.2;
            color: #000;
        }
        
        .doc-border {
            border: 2px solid #000;
        }
        
        .field-underline { 
            border-bottom: 1px solid #000; 
            display: inline-block; 
            min-width: 60px;
            padding: 0 4px;
        }
        
        .checkbox {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            text-align: center;
            line-height: 12px;
            margin: 0 2px;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        th, td { 
            border: 1px solid #000; 
            padding: 3px 4px;
            font-size: 9px;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        
        .text-xxs { font-size: 8px; }
        .leading-tight { line-height: 1.1; }
    </style>
</head>
<body class="bg-white p-4">

    {{-- Botones de acción (no imprimibles) --}}
    <div class="no-print fixed top-4 right-4 z-50 flex gap-2">
        <button onclick="window.print()" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg transition-all">
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Imprimir
        </button>
        <a href="{{ route('familias.fichas.index', $familia) }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg transition-all">
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
        </a>
    </div>

    {{-- Contenedor principal del documento --}}
    <div class="max-w-[21cm] mx-auto bg-white doc-border print-border">
        
        {{-- ==================== PÁGINA 1 ==================== --}}
        <div class="p-8">
            
            {{-- Encabezado Superior --}}
            <div class="flex justify-between items-end mb-2">
                <div class="flex items-center">
                    {{-- Logo Gobierno "Un poquis más y más largo" también en reporte --}}
                    <img src="{{ asset('images/logos/gobierno-salud.png') }}" alt="Gobierno Bolivariano" class="h-24 w-auto object-contain" style="height: 6rem;">
                </div>
                <div>
                    <img src="{{ asset('images/logos/barrio-adentro.jpg') }}" alt="Barrio Adentro" class="h-16 object-contain">
                </div>
            </div>

            {{-- Línea Separadora --}}
            <div class="w-full border-b-2 border-black mb-3"></div>

            {{-- Sección Inferior: Títulos y Logo Circular --}}
            <div class="relative mb-6 h-24">
                {{-- Títulos Centrados --}}
                <div class="absolute inset-x-0 top-0 text-center text-[10px] leading-tight">
                    <p class="font-bold">República Bolivariana de Venezuela</p>
                    <p class="font-bold">Misión Médica Cubana</p>
                    <p class="font-bold">Fundación Misión Barrio Adentro</p>
                    <h1 class="text-lg font-bold mt-4">HISTORIA CLÍNICA FAMILIAR</h1>
                </div>

                {{-- Logo Circular a la Derecha --}}
                <div class="absolute top-0 right-0 flex flex-col items-center">
                    <span class="text-[9px] font-bold mb-1">MODELO 18 - 02</span>
                    <img src="{{ asset('images/logos/mision-medica.jpg') }}" alt="Misión Médica Cubana" class="h-24 w-24 object-contain rounded-full" style="height: 6rem; width: 6rem;">
                </div>
            </div>

            {{-- Sección de identificación --}}
            <div class="mb-3 text-[9px] space-y-1">
                <div class="flex gap-4">
                    <div class="flex-1">
                        <span class="font-bold">ASIC.:</span>
                        <span class="field-underline">{{ $ficha->asic ?? '' }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="font-bold">CONSULTORIO:</span>
                        <span class="field-underline">{{ $ficha->consultorio ?? '' }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="font-bold">Nº HC.:</span>
                        <span class="field-underline">{{ $ficha->numero_hc ?? '' }}</span>
                    </div>
                </div>
                
                <div>
                    <span class="font-bold">FAMILIA:</span>
                    <span class="field-underline w-[85%]">{{ $familia->apellidos }}</span>
                </div>
                
                <div>
                    <span class="font-bold">DIRECCIÓN:</span>
                    <span class="field-underline w-[82%]">{{ $ficha->direccion ?? '' }}</span>
                </div>
                
                <div class="flex gap-4">
                    <div class="flex-1">
                        <span class="font-bold">ESTADO:</span>
                        <span class="field-underline w-[70%]">{{ $ficha->estado ?? '' }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="font-bold">MUNICIPIO:</span>
                        <span class="field-underline w-[65%]">{{ $ficha->municipio ?? '' }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="font-bold">PARROQUIA:</span>
                        <span class="field-underline w-[60%]">{{ $ficha->parroquia ?? '' }}</span>
                    </div>
                </div>
            </div>

            {{-- Tabla de integrantes --}}
            <div class="mb-4">
                <h3 class="font-bold text-[10px] mb-2">1 - INTEGRANTES DE LA FAMILIA:</h3>
                <table class="text-xxs">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="w-6">Nº</th>
                            <th class="text-left">NOMBRES Y APELLIDOS</th>
                            <th class="w-16">FECHA DE<br>NACIMIENTO</th>
                            <th class="w-10">EDAD</th>
                            <th class="w-10">SEXO</th>
                            <th class="w-20">NÚMERO DE<br>CÉDULA</th>
                            <th class="w-24">ESCOLARIDAD</th>
                            <th class="w-10">G.D.</th>
                            <th class="w-32">FACTORES DE RIESGOS Y/O<br>PATOLOGÍAS CRÓNICAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $integrantes = $familia->integrantes;
                            $totalFilas = 12;
                        @endphp
                        
                        @for($i = 0; $i < $totalFilas; $i++)
                            @php
                                $integrante = $integrantes[$i] ?? null;
                                $edad = $integrante && $integrante->fecha_nacimiento 
                                    ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->age 
                                    : '';
                            @endphp
                            <tr>
                                <td class="text-center font-bold">{{ $i + 1 }}</td>
                                <td class="text-left">{{ $integrante ? ($integrante->name . ' ' . $integrante->apellido) : '' }}</td>
                                <td class="text-center">{{ $integrante && $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->format('d/m/Y') : '' }}</td>
                                <td class="text-center">{{ $edad }}</td>
                                <td class="text-center">{{ $integrante ? strtoupper(substr($integrante->sexo ?? '', 0, 1)) : '' }}</td>
                                <td class="text-center">{{ $integrante->cedula ?? '' }}</td>
                                <td class="text-left px-1">{{ $integrante->escolaridad ?? '' }}</td>
                                <td class="text-center">{{ $integrante->grupo_dispensarial ?? '' }}</td>
                                <td class="text-left px-1">{{ $integrante->patologias ?? '' }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <p class="text-xxs mt-1 italic">G.D.: Grupo Dispensarial.</p>
            </div>

        </div>

        {{-- ==================== PÁGINA 2 ==================== --}}
        <div class="page-break"></div>
        
        <div class="p-8">
            {{-- Contenedor Flex para Secciones Superiores de Página 2 --}}
            <div class="flex gap-4 mb-4">
                
                {{-- COLUMNA IZQUIERDA: Clasificación y Socioeconómicas --}}
                <div class="w-[55%]">
                    
                    {{-- Sección 2: Clasificación --}}
                    <div class="mb-4">
                        <h3 class="font-bold text-[10px] mb-2">2 - CLASIFICACIÓN DE LA FAMILIA:</h3>
                        
                        <div class="ml-3 space-y-2 text-[9px]">
                            {{-- Según número de miembros --}}
                            <div>
                                <p class="font-bold">Según Número de Miembros</p>
                                <div class="ml-4 flex gap-6">
                                    <div>
                                        Pequeña 
                                        <span class="checkbox">{{ $ficha->numero_miembros == 'pequena' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Mediana 
                                        <span class="checkbox">{{ $ficha->numero_miembros == 'mediana' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Grande 
                                        <span class="checkbox">{{ $ficha->numero_miembros == 'grande' ? 'X' : '' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Antecedentes --}}
                            <div>
                                <p class="font-bold">Según Tipos de la Familia</p>
                                <div class="ml-4 flex gap-6">
                                    <div>
                                        Nuclear 
                                        <span class="checkbox">{{ $ficha->antecedentes_familia == 'nuclear' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Extensa 
                                        <span class="checkbox">{{ $ficha->antecedentes_familia == 'extensa' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Ampliada 
                                        <span class="checkbox">{{ $ficha->antecedentes_familia == 'ampliada' ? 'X' : '' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Número de generaciones --}}
                            <div>
                                <p class="font-bold">Número de generaciones</p>
                                <div class="ml-4 space-y-1">
                                    <div class="flex gap-4">
                                        <div>
                                            Unigeneracional 
                                            <span class="checkbox">{{ $ficha->numero_generaciones == 'unigeneracional' ? 'X' : '' }}</span>
                                        </div>
                                        <div>
                                            Multigeneracional 
                                            <span class="checkbox">{{ $ficha->numero_generaciones == 'multigeneracional' ? 'X' : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div>
                                            Bigeneracional 
                                            <span class="checkbox">{{ $ficha->numero_generaciones == 'bigeneracional' ? 'X' : '' }}</span>
                                        </div>
                                        <div>
                                            Trigeneracional 
                                            <span class="checkbox">{{ $ficha->numero_generaciones == 'trigeneracional' ? 'X' : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Etapas de desarrollo --}}
                            <div>
                                <p class="font-bold">Etapas de desarrollo de la Familia</p>
                                <div class="ml-4 flex gap-4 flex-wrap">
                                    <div>
                                        Formación 
                                        <span class="checkbox">{{ $ficha->etapa_desarrollo == 'formacion' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Contracción 
                                        <span class="checkbox">{{ $ficha->etapa_desarrollo == 'contraccion' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Extensión 
                                        <span class="checkbox">{{ $ficha->etapa_desarrollo == 'extension' ? 'X' : '' }}</span>
                                    </div>
                                    <div>
                                        Disolución 
                                        <span class="checkbox">{{ $ficha->etapa_desarrollo == 'disolucion' ? 'X' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sección 4: Condiciones socioeconómicas --}}
                    <div>
                        <h3 class="font-bold text-[10px] mb-2">4 - CONDICIONES SOCIOECONÓMICAS</h3>
                        <div class="ml-3 space-y-1 text-[9px]">
                            <div>
                                <span class="font-bold">Ingreso Percápita:</span>
                                <span class="field-underline">{{ $ficha->ingreso_percapita ?? '' }}</span>
                                <span class="ml-2 font-bold">N° Trabajadores:</span>
                                <span class="field-underline">{{ $ficha->numero_trabajadores ?? '' }}</span>
                            </div>
                            
                            <div>
                                <span class="font-bold">Cocina:</span>
                                <span class="ml-1">Gas <span class="checkbox">{{ $ficha->cocina_gas ? 'X' : '' }}</span></span>
                                <span class="ml-1">Eléc. <span class="checkbox">{{ $ficha->cocina_electrica ? 'X' : '' }}</span></span>
                                <span class="ml-1">Leña <span class="checkbox">{{ $ficha->cocina_lena ? 'X' : '' }}</span></span>
                                <span class="ml-1">Otra: <span class="field-underline w-8">{{ $ficha->cocina_otra ?? '' }}</span></span>
                            </div>
                            
                            <div>
                                <span class="font-bold">Equipos electrodomésticos:</span>
                                <div class="ml-2">
                                    Refrigerador <span class="checkbox">{{ $ficha->tiene_refrigerador ? 'X' : '' }}</span>
                                    Televisor <span class="checkbox">{{ $ficha->tiene_televisor ? 'X' : '' }}</span>
                                </div>
                                <div class="ml-2">
                                    Ventilador <span class="checkbox">{{ $ficha->tiene_ventilador ? 'X' : '' }}</span>
                                    Otro: <span class="field-underline">{{ $ficha->otros_equipos ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- COLUMNA DERECHA: Familiograma --}}
                <div class="w-[45%]">
                    <h3 class="font-bold text-[10px] mb-2">3 - FAMILIOGRAMA</h3>
                    <div class="border border-black h-full min-h-[300px] bg-gray-50">
                        {{-- Espacio para familiograma --}}
                    </div>
                </div>

            </div>

            {{-- Sección 5: Condiciones estructurales --}}
            <div class="mb-4">
                <h3 class="font-bold text-[10px] mb-2">5 - CONDICIONES ESTRUCTURALES DE LA VIVIENDA:</h3>
                
                <table class="text-xxs mb-2">
                    <tr>
                        <td class="font-bold bg-gray-100 w-32">Tipo de vivienda</td>
                        <td>Casa <span class="checkbox inline-block">{{ $ficha->tipo_vivienda == 'casa' ? 'X' : '' }}</span></td>
                        <td>Apartamento <span class="checkbox inline-block">{{ $ficha->tipo_vivienda == 'apartamento' ? 'X' : '' }}</span></td>
                        <td>Habitación <span class="checkbox inline-block">{{ $ficha->tipo_vivienda == 'habitacion' ? 'X' : '' }}</span></td>
                        <td>Rancho <span class="checkbox inline-block">{{ $ficha->tipo_vivienda == 'rancho' ? 'X' : '' }}</span></td>
                        <td>Palafito <span class="checkbox inline-block">{{ $ficha->tipo_vivienda == 'palafito' ? 'X' : '' }}</span></td>
                        <td>Otros: {{ $ficha->tipo_vivienda_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Material de construcción</td>
                        <td>Bloque <span class="checkbox inline-block">{{ $ficha->material_construccion == 'bloque' ? 'X' : '' }}</span></td>
                        <td>Madera <span class="checkbox inline-block">{{ $ficha->material_construccion == 'madera' ? 'X' : '' }}</span></td>
                        <td>Barro <span class="checkbox inline-block">{{ $ficha->material_construccion == 'bahareque' ? 'X' : '' }}</span></td>
                        <td>Cartón <span class="checkbox inline-block">{{ $ficha->material_construccion == 'carton' ? 'X' : '' }}</span></td>
                        <td>Zinc <span class="checkbox inline-block">{{ $ficha->material_construccion == 'zinc' ? 'X' : '' }}</span></td>
                        <td>Otros: {{ $ficha->material_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Techos</td>
                        <td>Placa <span class="checkbox inline-block">{{ $ficha->tipo_techo == 'placa' ? 'X' : '' }}</span></td>
                        <td>Asbesto <span class="checkbox inline-block">{{ $ficha->tipo_techo == 'asbesto' ? 'X' : '' }}</span></td>
                        <td>Acerolit <span class="checkbox inline-block">{{ $ficha->tipo_techo == 'acerolit' ? 'X' : '' }}</span></td>
                        <td>Guano <span class="checkbox inline-block">{{ $ficha->tipo_techo == 'guano' ? 'X' : '' }}</span></td>
                        <td>Zinc <span class="checkbox inline-block">{{ $ficha->tipo_techo == 'zinc' ? 'X' : '' }}</span></td>
                        <td>Otros: {{ $ficha->techo_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Pisos</td>
                        <td>Lozas <span class="checkbox inline-block">{{ $ficha->tipo_piso == 'losas' ? 'X' : '' }}</span></td>
                        <td>Cemento <span class="checkbox inline-block">{{ $ficha->tipo_piso == 'cemento' ? 'X' : '' }}</span></td>
                        <td>Tierra <span class="checkbox inline-block">{{ $ficha->tipo_piso == 'tierra' ? 'X' : '' }}</span></td>
                        <td>Madera <span class="checkbox inline-block">{{ $ficha->tipo_piso == 'madera' ? 'X' : '' }}</span></td>
                        <td colspan="2">Otros: {{ $ficha->piso_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Estado constructivo</td>
                        <td>Buena <span class="checkbox inline-block">{{ $ficha->estado_constructivo == 'buena' ? 'X' : '' }}</span></td>
                        <td>Regular <span class="checkbox inline-block">{{ $ficha->estado_constructivo == 'regular' ? 'X' : '' }}</span></td>
                        <td>Mala <span class="checkbox inline-block">{{ $ficha->estado_constructivo == 'mala' ? 'X' : '' }}</span></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Hacinamiento</td>
                        <td>Sí <span class="checkbox inline-block">{{ $ficha->hacinamiento ? 'X' : '' }}</span></td>
                        <td>No <span class="checkbox inline-block">{{ !$ficha->hacinamiento ? 'X' : '' }}</span></td>
                        <td colspan="2">N° de Habitantes: {{ $ficha->numero_habitantes ?? '' }}</td>
                        <td colspan="2">N° de Habitaciones: {{ $ficha->numero_habitaciones ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Servicio eléctrico</td>
                        <td>Sí <span class="checkbox inline-block">{{ $ficha->servicio_electrico ? 'X' : '' }}</span></td>
                        <td>No <span class="checkbox inline-block">{{ !$ficha->servicio_electrico ? 'X' : '' }}</span></td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Abasto de agua</td>
                        <td>Pozos <span class="checkbox inline-block">{{ $ficha->abasto_agua == 'pozos' ? 'X' : '' }}</span></td>
                        <td>Acueducto <span class="checkbox inline-block">{{ $ficha->abasto_agua == 'acueducto' ? 'X' : '' }}</span></td>
                        <td>Manantial <span class="checkbox inline-block">{{ $ficha->abasto_agua == 'manantial' ? 'X' : '' }}</span></td>
                        <td>Río <span class="checkbox inline-block">{{ $ficha->abasto_agua == 'rio' ? 'X' : '' }}</span></td>
                        <td colspan="2">Otros ¿Cuáles?: {{ $ficha->agua_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Baño Sanitario</td>
                        <td>Baño <span class="checkbox inline-block">{{ $ficha->bano_sanitario == 'bano' ? 'X' : '' }}</span></td>
                        <td>Letrina <span class="checkbox inline-block">{{ $ficha->bano_sanitario == 'letrina' ? 'X' : '' }}</span></td>
                        <td>No posee <span class="checkbox inline-block">{{ $ficha->bano_sanitario == 'no_posee' ? 'X' : '' }}</span></td>
                        <td colspan="3">Otros: {{ $ficha->bano_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Destino final residuales líquidos</td>
                        <td colspan="2">Alcantarillado <span class="checkbox inline-block">{{ $ficha->destino_residuales == 'alcantarillado' ? 'X' : '' }}</span></td>
                        <td colspan="2">Pozos séptico <span class="checkbox inline-block">{{ $ficha->destino_residuales == 'pozos_septico' ? 'X' : '' }}</span></td>
                        <td colspan="2">Otros ¿Cuáles?: {{ $ficha->residuales_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Destino final desechos sólidos</td>
                        <td colspan="2">Recogida local <span class="checkbox inline-block">{{ $ficha->destino_desechos == 'recogida_local' ? 'X' : '' }}</span></td>
                        <td colspan="2">Vertederos <span class="checkbox inline-block">{{ $ficha->destino_desechos == 'vertederos' ? 'X' : '' }}</span></td>
                        <td colspan="2">Otros ¿Cuáles?: {{ $ficha->desechos_otros ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Animales domésticos</td>
                        <td>Perros <span class="checkbox inline-block">{{ $ficha->tiene_perros ? 'X' : '' }}</span></td>
                        <td>Gatos <span class="checkbox inline-block">{{ $ficha->tiene_gatos ? 'X' : '' }}</span></td>
                        <td colspan="4">Otros: {{ $ficha->otros_animales ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold bg-gray-100">Vectores</td>
                        <td colspan="6" class="text-left">{{ $ficha->vectores ?? '' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Sección 6: Discusión --}}
            <div>
                <h3 class="font-bold text-[10px] mb-2">6 - DISCUSIÓN Y EVALUACIÓN FAMILIAR:</h3>
                <div class="border border-black p-3 min-h-[200px] text-[9px] leading-relaxed whitespace-pre-wrap">{{ $ficha->discusion_evaluacion ?? '' }}</div>
            </div>

        </div>
    </div>

</body>
</html>
