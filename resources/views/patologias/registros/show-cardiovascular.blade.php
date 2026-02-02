<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Cardiovascular - {{ $registro->nombre_completo }}</title>
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
        
        .check-box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 4px;
            text-align: center;
            line-height: 10px;
            font-weight: bold;
        }

        .check-true::before { content: 'X'; }
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

            <div class="w-full border-b-2 border-black mb-3"></div>

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

            {{-- Datos Personales --}}
            <div class="mb-4">
                <h3 class="font-bold text-[11px] mb-2 bg-gray-200 p-2 border border-black">DATOS DEL PACIENTE</h3>
                <table>
                    <tr>
                        <th class="w-1/4">Nombre Completo:</th>
                        <td class="w-3/4">{{ $registro->nombre_completo }}</td>
                    </tr>
                    <tr>
                        <th>Cédula:</th>
                        <td>{{ $registro->cedula_completa }}</td>
                    </tr>
                    <tr>
                        <th>Edad:</th>
                        <td>{{ $registro->edad }} años</td>
                    </tr>
                    <tr>
                        <th>Sexo:</th>
                        <td>{{ $registro->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td>{{ $registro->telefono ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <td>{{ $registro->direccion ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Condiciones Médicas --}}
            <div class="mb-4">
                <h3 class="font-bold text-[11px] mb-2 bg-gray-200 p-2 border border-black">CONDICIONES MÉDICAS</h3>
                <table>
                    <tr>
                        <td class="w-1/3"><span class="check-box {{ $registro->hta ? 'check-true' : '' }}"></span> HTA (Hipertensión)</td>
                        <td class="w-1/3"><span class="check-box {{ $registro->erc ? 'check-true' : '' }}"></span> ERC (Enf. Renal)</td>
                        <td class="w-1/3"><span class="check-box {{ $registro->iam ? 'check-true' : '' }}"></span> IAM (Infarto)</td>
                    </tr>
                    <tr>
                        <td><span class="check-box {{ $registro->acv ? 'check-true' : '' }}"></span> ACV</td>
                        <td><span class="check-box {{ $registro->dislipidemia ? 'check-true' : '' }}"></span> Dislipidemia</td>
                        <td><span class="check-box {{ $registro->fumador ? 'check-true' : '' }}"></span> Fumador</td>
                    </tr>
                </table>
            </div>

            {{-- Tratamiento --}}
            <div class="mb-4">
                <h3 class="font-bold text-[11px] mb-2 bg-gray-200 p-2 border border-black">TRATAMIENTO FARMACOLÓGICO</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $meds = [
                                ['key' => 'amlodipino', 'label' => 'Amlodipino', 'hasDose' => true],
                                ['key' => 'atenolol', 'label' => 'Atenolol', 'hasDose' => true],
                                ['key' => 'atorvastatina', 'label' => 'Atorvastatina', 'hasDose' => true],
                                ['key' => 'captopril', 'label' => 'Captopril', 'hasDose' => true],
                                ['key' => 'carvedilol', 'label' => 'Carvedilol', 'hasDose' => true],
                                ['key' => 'clopidogrel', 'label' => 'Clopidogrel', 'hasDose' => false],
                                ['key' => 'enalapril', 'label' => 'Enalapril', 'hasDose' => true],
                                ['key' => 'losartan', 'label' => 'Losartan Pot.', 'hasDose' => true],
                                ['key' => 'sinvastatina', 'label' => 'Sinvastatina', 'hasDose' => false],
                                ['key' => 'aspirina', 'label' => 'Aspirina 81mg', 'hasDose' => false],
                                ['key' => 'dinitrato_isosorbide', 'label' => 'D. Isosorbide', 'hasDose' => false],
                                ['key' => 'digoxina', 'label' => 'Digoxina', 'hasDose' => false],
                                ['key' => 'furosemida', 'label' => 'Furosemida', 'hasDose' => false],
                                ['key' => 'verapamilo', 'label' => 'Verapamilo', 'hasDose' => false],
                                ['key' => 'alfa_metildopa', 'label' => 'Alfa Metildopa', 'hasDose' => false],
                                ['key' => 'amiodarona', 'label' => 'Amiodarona', 'hasDose' => false],
                            ];
                            $medChunks = array_chunk($meds, 2);
                        @endphp

                        @foreach($medChunks as $chunk)
                            <tr>
                                @foreach($chunk as $med)
                                    <td>
                                        <span class="check-box {{ $registro->{$med['key']} ? 'check-true' : '' }}"></span> 
                                        {{ $med['label'] }}
                                    </td>
                                    <td>
                                        @if($med['hasDose'])
                                            {{ $registro->{$med['key'].'_dosis'} ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                                {{-- Fill empty cells if row handles 2 items but has 1 --}}
                                @if(count($chunk) < 2)
                                    <td></td><td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($registro->otros_medicamentos)
                <div class="mt-2 border border-black p-2 text-xs">
                    <strong>Otros:</strong> {{ $registro->otros_medicamentos }}
                </div>
                @endif
            </div>

            {{-- Ubicación --}}
            <div class="mb-4">
                <h3 class="font-bold text-[11px] mb-2 bg-gray-200 p-2 border border-black">UBICACIÓN Y CENTRO DE SALUD</h3>
                <table>
                    <tr>
                        <th class="w-1/3">Municipio:</th>
                        <td class="w-2/3">{{ $registro->municipio ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/3">Distrito Sanitario:</th>
                        <td class="w-2/3">{{ $registro->distrito ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/3">Centro de Salud:</th>
                        <td class="w-2/3">{{ $registro->centro_salud ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/3">Observaciones:</th>
                        <td class="w-2/3">{{ $registro->observaciones ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Footer --}}
            <div class="mt-6 pt-3 border-t border-gray-300 text-[9px] text-gray-600">
                <p><strong>Fecha de registro:</strong> {{ $registro->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última actualización:</strong> {{ $registro->updated_at->format('d/m/Y H:i') }}</p>
            </div>

        </div>
    </div>

</body>
</html>
