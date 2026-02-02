<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registro Cardiovascular - {{ $registro->nombre_completo }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            font-size: 10px; 
            line-height: 1.2;
            color: #000;
        }
        
        .doc-border {
            border: 2px solid #000;
            padding: 20px;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px;
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
        
        .section-header {
            background-color: #e0e0e0;
            font-weight: bold;
            padding: 8px;
            border: 1px solid #000;
            font-size: 11px;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        
        .header-title {
            font-size: 11px;
            line-height: 1.3;
            margin-bottom: 5px;
        }
        
        .main-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            text-transform: uppercase;
        }
        
        .border-line {
            border-bottom: 2px solid #000;
            margin: 10px 0;
        }
        
        .footer-info {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ccc;
            font-size: 9px;
            color: #666;
        }

        .check-box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            margin-right: 4px;
            text-align: center;
            line-height: 8px;
            font-weight: bold;
            font-family: 'DejaVu Sans', sans-serif;
        }
        
        .check-true {
            background-color: #eee;
        }
        
        .check-true::before {
            content: '✓'; 
            font-size: 8px;
        }
    </style>
</head>
<body>
    
    <div class="doc-border">
        
        {{-- Encabezado --}}
        <div class="header-section">
            <p class="header-title"><strong>República Bolivariana de Venezuela</strong></p>
            <p class="header-title"><strong>Misión Médica Cubana</strong></p>
            <p class="header-title"><strong>Fundación Misión Barrio Adentro</strong></p>
            <h1 class="main-title">Registro de {{ $tipo->nombre }}</h1>
        </div>

        <div class="border-line"></div>

        {{-- Datos Personales --}}
        <div class="section-header">DATOS DEL PACIENTE</div>
        <table>
            <tr>
                <th width="25%">Nombre Completo:</th>
                <td width="75%">{{ $registro->nombre_completo }}</td>
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

        {{-- Condiciones Médicas --}}
        <div class="section-header">CONDICIONES MÉDICAS</div>
        <table>
            <tr>
                <td width="33%"><span class="check-box {{ $registro->hta ? 'check-true' : '' }}"></span> HTA (Hipertensión)</td>
                <td width="33%"><span class="check-box {{ $registro->erc ? 'check-true' : '' }}"></span> ERC (Enf. Renal)</td>
                <td width="33%"><span class="check-box {{ $registro->iam ? 'check-true' : '' }}"></span> IAM (Infarto)</td>
            </tr>
            <tr>
                <td><span class="check-box {{ $registro->acv ? 'check-true' : '' }}"></span> ACV</td>
                <td><span class="check-box {{ $registro->dislipidemia ? 'check-true' : '' }}"></span> Dislipidemia</td>
                <td><span class="check-box {{ $registro->fumador ? 'check-true' : '' }}"></span> Fumador</td>
            </tr>
        </table>

        {{-- Tratamiento --}}
        <div class="section-header">TRATAMIENTO FARMACOLÓGICO</div>
        <table>
            <thead>
                <tr>
                    <th width="35%">Medicamento</th>
                    <th width="15%">Dosis</th>
                    <th width="35%">Medicamento</th>
                    <th width="15%">Dosis</th>
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
        <div style="margin-top: 5px; border: 1px solid #000; padding: 5px; font-size: 10px;">
            <strong>Otros tratamientos:</strong> {{ $registro->otros_medicamentos }}
        </div>
        @endif

        {{-- Ubicación --}}
        <div class="section-header">UBICACIÓN Y CENTRO DE SALUD</div>
        <table>
            <tr>
                <th width="30%">Municipio:</th>
                <td width="70%">{{ $registro->municipio ?? '-' }}</td>
            </tr>
            <tr>
                <th>Distrito Sanitario:</th>
                <td>{{ $registro->distrito ?? '-' }}</td>
            </tr>
            <tr>
                <th>Centro de Salud:</th>
                <td>{{ $registro->centro_salud ?? '-' }}</td>
            </tr>
            <tr>
                <th>Observaciones:</th>
                <td>{{ $registro->observaciones ?? '-' }}</td>
            </tr>
        </table>

        {{-- Footer --}}
        <div class="footer-info">
            <p><strong>Fecha de registro:</strong> {{ $registro->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Última actualización:</strong> {{ $registro->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Generado el:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        </div>

    </div>

</body>
</html>
