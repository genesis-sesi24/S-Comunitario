<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de {{ $tipo->nombre }} - {{ $registro->nombre_completo }}</title>
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
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        th, td { 
            border: 1px solid #000; 
            padding: 6px 8px;
            font-size: 10px;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
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
        <a href="{{ route('patologias.pdf', [$tipo->slug, $registro->id]) }}" 
           class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg transition-all">
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Descargar PDF
        </a>
        <a href="{{ route('patologias.index', $tipo->slug) }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2.5 px-5 rounded-lg shadow-lg transition-all">
            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver
        </a>
    </div>

    {{-- Contenedor principal del documento --}}
    <div class="max-w-[21cm] mx-auto bg-white doc-border print-border">
        
        <div class="p-8">
            
            {{-- Encabezado --}}
            <div class="flex justify-between items-end mb-2">
                <div class="flex items-center">
                    <img src="{{ asset('images/logos/gobierno-salud.png') }}" alt="Gobierno Bolivariano" class="h-24 w-auto object-contain" style="height: 6rem;">
                </div>
                <div>
                    <img src="{{ asset('images/logos/barrio-adentro.jpg') }}" alt="Barrio Adentro" class="h-16 object-contain">
                </div>
            </div>

            {{-- Línea Separadora --}}
            <div class="w-full border-b-2 border-black mb-3"></div>

            {{-- Sección Inferior: Títulos --}}
            <div class="relative mb-6 h-24">
                <div class="absolute inset-x-0 top-0 text-center text-[10px] leading-tight">
                    <p class="font-bold">República Bolivariana de Venezuela</p>
                    <p class="font-bold">Misión Médica Cubana</p>
                    <p class="font-bold">Fundación Misión Barrio Adentro</p>
                    <h1 class="text-lg font-bold mt-4">REGISTRO DE {{ strtoupper($tipo->nombre) }}</h1>
                </div>

                <div class="absolute top-0 right-0 flex flex-col items-center">
                    <span class="text-[9px] font-bold mb-1">{{ $tipo->slug }}</span>
                    <img src="{{ asset('images/logos/mision-medica.jpg') }}" alt="Misión Médica Cubana" class="h-24 w-24 object-contain rounded-full" style="height: 6rem; width: 6rem;">
                </div>
            </div>

            @php
                $camposPorGrupo = $tipo->campos->groupBy('grupo');
            @endphp

            @foreach($camposPorGrupo as $grupo => $campos)
                <div class="mb-4">
                    <h3 class="font-bold text-[11px] mb-2 bg-gray-200 p-2 border border-black">{{ strtoupper($grupo ?: 'Información General') }}</h3>
                    <table>
                        @foreach($campos as $campo)
                            <tr>
                                <th class="w-1/3">{{ $campo->etiqueta }}:</th>
                                <td class="w-2/3">
                                    @if($campo->tipo_campo == 'date')
                                        {{ $registro->{$campo->nombre} ? \Carbon\Carbon::parse($registro->{$campo->nombre})->format('d/m/Y') : '-' }}
                                    @elseif($campo->tipo_campo == 'select')
                                        @if($campo->opciones && isset($campo->opciones[$registro->{$campo->nombre}]))
                                            {{ $campo->opciones[$registro->{$campo->nombre}] }}
                                        @else
                                            {{ $registro->{$campo->nombre} ?? '-' }}
                                        @endif
                                    @elseif($campo->tipo_campo == 'cedula')
                                        {{ $registro->{$campo->nombre . '_tipo'} ?? '' }}-{{ $registro->{$campo->nombre} ?? '' }}
                                    @elseif($campo->tipo_campo == 'checkbox')
                                        {{ $registro->{$campo->nombre} ? 'Sí' : 'No' }}
                                    @else
                                        {{ $registro->{$campo->nombre} ?? '-' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endforeach

            {{-- Información de registro --}}
            <div class="mt-6 pt-3 border-t border-gray-300 text-[9px] text-gray-600">
                <p><strong>Fecha de registro:</strong> {{ $registro->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última actualización:</strong> {{ $registro->updated_at->format('d/m/Y H:i') }}</p>
            </div>

        </div>
    </div>

</body>
</html>
