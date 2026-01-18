<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia Clínica Familiar - {{ $familia->apellidos }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page { margin: 0.5cm; }
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
            .page-break { page-break-before: always; }
        }
        body { font-family: 'Arial', sans-serif; font-size: 11px; line-height: 1.3; }
        .input-line { border-bottom: 1px solid black; display: inline-block; padding-left: 4px; }
        .box { border: 1px solid black; padding: 2px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle; }
        .text-left-cell { text-align: left; }
        h1, h2, h3 { font-weight: bold; }
    </style>
</head>
<body class="bg-white text-black p-8 max-w-[21cm] mx-auto">

    {{-- Botón de impresión --}}
    <div class="fixed top-4 right-4 no-print">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            Imprimir Ficha
        </button>
        <a href="{{ route('familias.fichas.index', $familia) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow ml-2">
            Volver
        </a>
    </div>

    {{-- PÁGINA 1 --}}
    
    {{-- BLOQUE 1: ENCABEZADO INSTITUCIONAL --}}
    <div class="text-center mb-6">
        <p>Gobierno Bolivariano | Ministerio del Poder Popular</p>
        <p>de Venezuela | para La Salud</p>
        <div class="h-4"></div>
        <p class="font-normal">República Bolivariana de Venezuela</p>
        <p>Misión Médica Cubana</p>
        <p>Fundación Misión Barrio Adentro</p>
    </div>

    {{-- BLOQUE 2: TÍTULO PRINCIPAL --}}
    <div class="text-center mb-6">
        <div class="h-4"></div>
        <h1 class="text-xl font-bold">HISTORIA CLÍNICA FAMILIAR</h1>
    </div>

    {{-- BLOQUE 3: DATOS DE IDENTIFICACIÓN --}}
    <div class="mb-6 font-bold text-sm">
        <div class="mb-2">
            ASIC.: <span class="input-line w-40 font-normal">{{ $ficha->asic }}</span>
            CONSULTORIO: <span class="input-line w-40 font-normal">{{ $ficha->consultorio }}</span>
            Nº HC.: <span class="input-line w-24 font-normal">{{ $ficha->numero_hc }}</span>
        </div>
        <div class="mb-2">
            FAMILIA: <span class="input-line w-96 font-normal">{{ $familia->apellidos }}</span>
        </div>
        <div class="mb-2">
            DIRECCIÓN: <span class="input-line w-[80%] font-normal">{{ $ficha->direccion }}</span>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">ESTADO: <span class="input-line w-full font-normal">{{ $ficha->estado }}</span></div>
            <div class="flex-1">MUNICIPIO: <span class="input-line w-full font-normal">{{ $ficha->municipio }}</span></div>
            <div class="flex-1">PARROQUIA: <span class="input-line w-full font-normal">{{ $ficha->parroquia }}</span></div>
        </div>
    </div>

    {{-- BLOQUE 4: SECCIÓN 1 - TABLA DE INTEGRANTES --}}
    <div class="mb-8">
        <h3 class="font-bold mb-2">1 - INTEGRANTES DE LA FAMILIA:</h3>
        <table>
            <thead>
                <tr class="bg-gray-100">
                    <th class="w-8">Nº</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th class="w-24">FECHA DE NACIMIENTO</th>
                    <th class="w-12">EDAD</th>
                    <th class="w-12">SEXO</th>
                    <th class="w-24">NÚMERO DE CÉDULA</th>
                    <th>ESCOLARIDAD</th>
                    <th class="w-12">G.D.</th>
                    <th>FACTORES DE RIESGOS Y/O PATOLOGÍAS CRÓNICAS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $integrantes = $familia->integrantes;
                    $totalFilas = 12; // Total de filas requeridas
                @endphp

                @for($i = 0; $i < $totalFilas; $i++)
                    @php
                        $integrante = $integrantes[$i] ?? null;
                    @endphp
                    <tr>
                        <td class="text-center font-bold">{{ $i + 1 }}</td>
                        <td class="text-left-cell">{{ $integrante ? $integrante->name . ' ' . $integrante->apellido : '' }}</td>
                        <td>{{ $integrante && $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->format('d/m/Y') : '' }}</td>
                        <td>{{ $integrante && $integrante->fecha_nacimiento ? \Carbon\Carbon::parse($integrante->fecha_nacimiento)->age : '' }}</td>
                        <td>{{ $integrante->sexo ?? '' }}</td>
                        <td>{{ $integrante->cedula ?? '' }}</td>
                        <td>{{ $integrante->escolaridad ?? '' }}</td>
                        <td>{{ $integrante->grupo_dispensarial ?? '' }}</td>
                        <td>{{ $integrante->patologias ?? '' }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <p class="mt-1 text-xs">G.D.: Grupo Dispensarial.</p>
    </div>

    <div class="page-break"></div>

    {{-- PÁGINA 2 --}}
    
    {{-- BLOQUE 1: TÍTULO --}}
    <div class="mb-6 border-b pb-2">
        <h1 class="text-2xl font-bold"># Solivariani</h1>
        <div class="mt-2">
            <strong>Ciclo: </strong>
        </div>
    </div>

    {{-- BLOQUE 2: SECCIÓN 2 - CLASIFICACIÓN --}}
    <div class="mb-6">
        <h2 class="font-bold mb-4">2-CLASIFICACIÓN DE LA FAMILIA:</h2>
        
        <div class="ml-4 space-y-4">
            <div>
                <p class="font-bold mb-1">- Según Número de Miembros</p>
                <div class="ml-8 space-y-1">
                    <p>- Pequeña <span class="ml-2 font-bold">{{ $ficha->numero_miembros == 'pequena' ? '(X)' : '(_)' }}</span></p>
                    <div class="ml-8">
                        <p>- Mediana <span class="ml-2 font-bold">{{ $ficha->numero_miembros == 'mediana' ? '(X)' : '(_)' }}</span></p>
                        <p>- Grande <span class="ml-2 font-bold">{{ $ficha->numero_miembros == 'grande' ? '(X)' : '(_)' }}</span></p>
                    </div>
                </div>
            </div>

            <div>
                <p class="font-bold mb-1">- Antecedentes de la familia</p>
                <div class="ml-8">
                    <p>- Nuclear <span class="ml-2 font-bold">{{ $ficha->antecedentes_familia == 'nuclear' ? '(X)' : '(_)' }}</span></p>
                    <p>- Extensa <span class="ml-2 font-bold">{{ $ficha->antecedentes_familia == 'extensa' ? '(X)' : '(_)' }}</span></p>
                    <p>- Ampliada <span class="ml-2 font-bold">{{ $ficha->antecedentes_familia == 'ampliada' ? '(X)' : '(_)' }}</span></p>
                </div>
            </div>

            <div>
                <p class="font-bold mb-1">- Número de generaciones</p>
                <div class="ml-8">
                    <p>- Unigeneracional <span class="ml-2 font-bold">{{ $ficha->numero_generaciones == 'unigeneracional' ? '(X)' : '(_)' }}</span></p>
                    <p>- Bigeneracional <span class="ml-2 font-bold">{{ $ficha->numero_generaciones == 'bigeneracional' ? '(X)' : '(_)' }}</span></p>
                    <p>- Trigeneracional <span class="ml-2 font-bold">{{ $ficha->numero_generaciones == 'trigeneracional' ? '(X)' : '(_)' }}</span></p>
                    <p>- Multigeneracional <span class="ml-2 font-bold">{{ $ficha->numero_generaciones == 'multigeneracional' ? '(X)' : '(_)' }}</span></p>
                </div>
            </div>

            <div>
                <p class="font-bold mb-1">- Etapas de desarrollo de la Familia</p>
                <div class="ml-8">
                    <p>- Formación <span class="ml-2 font-bold">{{ $ficha->etapa_desarrollo == 'formacion' ? '(X)' : '(_)' }}</span></p>
                    <p>- Contracción <span class="ml-2 font-bold">{{ $ficha->etapa_desarrollo == 'contraccion' ? '(X)' : '(_)' }}</span></p>
                    <p>- Extensión <span class="ml-2 font-bold">{{ $ficha->etapa_desarrollo == 'extension' ? '(X)' : '(_)' }}</span></p>
                    <p>- Disolución <span class="ml-2 font-bold">{{ $ficha->etapa_desarrollo == 'disolucion' ? '(X)' : '(_)' }}</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- BLOQUE 3: SECCIÓN 4 - CONDICIONES SOCIOECONÓMICAS --}}
    <div class="mb-6">
        <h2 class="font-bold mb-2">4-CONDICIONES SOCIOECONÓMICAS</h2>
        <div class="space-y-2 ml-4">
            <div>
                - Ingreso Percapita: <span class="input-line w-32">{{ $ficha->ingreso_percapita }}</span>
                N° Trabajadores: <span class="input-line w-16">{{ $ficha->numero_trabajadores }}</span>
            </div>
            <div>
                - Cocina: <span class="input-line w-24"></span>
                Gas: <span class="input-line w-8 text-center">{{ $ficha->cocina_gas ? 'X' : '' }}</span>
                Eléctrica: <span class="input-line w-8 text-center">{{ $ficha->cocina_electrica ? 'X' : '' }}</span>
                Leña: <span class="input-line w-8 text-center">{{ $ficha->cocina_lena ? 'X' : '' }}</span>
                Otra: <span class="input-line w-32">{{ $ficha->cocina_otra }}</span>
            </div>
            <div>
                - Equipos electrodomésticos: <span class="input-line w-24"></span>
                Refrigerador: <span class="input-line w-8 text-center">{{ $ficha->tiene_refrigerador ? 'X' : '' }}</span>
                Televisor: <span class="input-line w-8 text-center">{{ $ficha->tiene_televisor ? 'X' : '' }}</span>
                Ventilador: <span class="input-line w-8 text-center">{{ $ficha->tiene_ventilador ? 'X' : '' }}</span>
                Otro: <span class="input-line w-32">{{ $ficha->otros_equipos }}</span>
            </div>
        </div>
    </div>

    {{-- BLOQUE 4: SECCIÓN 5 - CONDICIONES ESTRUCTURALES --}}
    <div class="mb-6">
        <h2 class="font-bold mb-2">5-CONDICIONES ESTRUCTURALES DE LA VIVIENDA:</h2>
        
        <table class="mb-4 text-xs">
            <tr>
                <td class="font-bold bg-gray-100 w-40 text-left-cell">Tipo de vivienda</td>
                <td>Casa {{ $ficha->tipo_vivienda == 'casa' ? '(X)' : '' }}</td>
                <td>Apartamento {{ $ficha->tipo_vivienda == 'apartamento' ? '(X)' : '' }}</td>
                <td>Habitación {{ $ficha->tipo_vivienda == 'habitacion' ? '(X)' : '' }}</td>
                <td>Rancho {{ $ficha->tipo_vivienda == 'rancho' ? '(X)' : '' }}</td>
                <td>Palafito {{ $ficha->tipo_vivienda == 'palafito' ? '(X)' : '' }}</td>
                <td>Otros: {{ $ficha->tipo_vivienda_otros }}</td>
            </tr>
            <tr>
                <td class="font-bold bg-gray-100 text-left-cell">Material de construcción</td>
                <td>Bloque {{ $ficha->material_construccion == 'bloque' ? '(X)' : '' }}</td>
                <td>Madera {{ $ficha->material_construccion == 'madera' ? '(X)' : '' }}</td>
                <td>Barrio {{ $ficha->material_construccion == 'bahareque' ? '(X)' : '' }}</td>
                <td>Cartón {{ $ficha->material_construccion == 'carton' ? '(X)' : '' }}</td>
                <td>Zinc {{ $ficha->material_construccion == 'zinc' ? '(X)' : '' }}</td>
                <td>Otros: {{ $ficha->material_otros }}</td>
            </tr>
            <tr>
                <td class="font-bold bg-gray-100 text-left-cell">Techos</td>
                <td>Placa {{ $ficha->tipo_techo == 'placa' ? '(X)' : '' }}</td>
                <td>Asbesto {{ $ficha->tipo_techo == 'asbesto' ? '(X)' : '' }}</td>
                <td>Acerolí {{ $ficha->tipo_techo == 'acerolit' ? '(X)' : '' }}</td>
                <td>Guano {{ $ficha->tipo_techo == 'guano' ? '(X)' : '' }}</td>
                <td>Zinc {{ $ficha->tipo_techo == 'zinc' ? '(X)' : '' }}</td>
                <td>Otros: {{ $ficha->techo_otros }}</td>
            </tr>
            <tr>
                <td class="font-bold bg-gray-100 text-left-cell">Pisos</td>
                <td>Lozas {{ $ficha->tipo_piso == 'losas' ? '(X)' : '' }}</td>
                <td>Cemento {{ $ficha->tipo_piso == 'cemento' ? '(X)' : '' }}</td>
                <td>Tierra {{ $ficha->tipo_piso == 'tierra' ? '(X)' : '' }}</td>
                <td>Madera {{ $ficha->tipo_piso == 'madera' ? '(X)' : '' }}</td>
                <td colspan="2">Otros: {{ $ficha->piso_otros }}</td>
            </tr>
            <tr>
                <td class="font-bold bg-gray-100 text-left-cell">Estado constructivo</td>
                <td>Buena {{ $ficha->estado_constructivo == 'buena' ? '(X)' : '' }}</td>
                <td>Regular {{ $ficha->estado_constructivo == 'regular' ? '(X)' : '' }}</td>
                <td>Mala {{ $ficha->estado_constructivo == 'mala' ? '(X)' : '' }}</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td class="font-bold bg-gray-100 text-left-cell">Hacinamiento</td>
                <td>Sí {{ $ficha->hacinamiento ? '(X)' : '' }}</td>
                <td>No {{ !$ficha->hacinamiento ? '(X)' : '' }}</td>
                <td colspan="2">N° de Habitantes: {{ $ficha->numero_habitantes }}</td>
                <td colspan="2">N° de Habitaciones: {{ $ficha->numero_habitaciones }}</td>
            </tr>
        </table>

        {{-- Tablas adicionales --}}
        <div class="space-y-2 text-xs">
            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Servicio eléctrico</td>
                    <td>Sí {{ $ficha->servicio_electrico ? '(X)' : '' }}</td>
                    <td>No {{ !$ficha->servicio_electrico ? '(X)' : '' }}</td>
                    <td colspan="4"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Abasto de agua</td>
                    <td>Pozos {{ $ficha->abasto_agua == 'pozos' ? '(X)' : '' }}</td>
                    <td>Acueducto {{ $ficha->abasto_agua == 'acueducto' ? '(X)' : '' }}</td>
                    <td>Manantial {{ $ficha->abasto_agua == 'manantial' ? '(X)' : '' }}</td>
                    <td>Rio {{ $ficha->abasto_agua == 'rio' ? '(X)' : '' }}</td>
                    <td colspan="2">Otros: {{ $ficha->agua_otros }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Baño Sanitario</td>
                    <td>Baño {{ $ficha->bano_sanitario == 'bano' ? '(X)' : '' }}</td>
                    <td>Letrina {{ $ficha->bano_sanitario == 'letrina' ? '(X)' : '' }}</td>
                    <td>No posee {{ $ficha->bano_sanitario == 'no_posee' ? '(X)' : '' }}</td>
                    <td colspan="3">Otros: {{ $ficha->bano_otros }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Destino final residuales líquidos</td>
                    <td>Alcantarillado {{ $ficha->destino_residuales == 'alcantarillado' ? '(X)' : '' }}</td>
                    <td>Pozos séptico {{ $ficha->destino_residuales == 'pozos_septico' ? '(X)' : '' }}</td>
                    <td colspan="4">Otros: {{ $ficha->residuales_otros }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Destino final desechos sólidos</td>
                    <td>Recogida local {{ $ficha->destino_desechos == 'recogida_local' ? '(X)' : '' }}</td>
                    <td>Vertederos {{ $ficha->destino_desechos == 'vertederos' ? '(X)' : '' }}</td>
                    <td colspan="4">Otros: {{ $ficha->desechos_otros }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Animales domésticos</td>
                    <td>Perros {{ $ficha->tiene_perros ? '(X)' : '' }}</td>
                    <td>Gatos {{ $ficha->tiene_gatos ? '(X)' : '' }}</td>
                    <td colspan="4">Otros: {{ $ficha->otros_animales }}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="font-bold bg-gray-100 w-40 text-left-cell">Víctores</td>
                    <td colspan="6" class="text-left-cell">{{ $ficha->vectores }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- BLOQUE 5: SECCIÓN 6 - DISCUSIÓN --}}
    <div>
        <h2 class="font-bold mb-4">6-DISCUSIÓN Y EVALUACIÓN FAMILIAR:</h2>
        <div class="border border-black p-4 min-h-[300px] text-justify leading-relaxed whitespace-pre-wrap">
{{ $ficha->discusion_evaluacion }}
        </div>
    </div>

</body>
</html>
