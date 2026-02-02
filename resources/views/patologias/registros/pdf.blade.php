<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registro de {{ $tipo->nombre }} - {{ $registro->nombre_completo }}</title>
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
        
        .field-underline { 
            border-bottom: 1px solid #000; 
            display: inline-block; 
            min-width: 60px;
            padding: 0 4px;
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
            width: 33%;
        }
        
        td {
            width: 67%;
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

        {{-- Información del Paciente --}}
        <div class="section-header">DATOS DEL PACIENTE</div>
        <table>
            <tr>
                <th>Nombre Completo:</th>
                <td>{{ $registro->nombre_completo }}</td>
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
            @if(isset($registro->telefono) && $registro->telefono)
            <tr>
                <th>Teléfono:</th>
                <td>{{ $registro->telefono }}</td>
            </tr>
            @endif
            @if(isset($registro->direccion) && $registro->direccion)
            <tr>
                <th>Dirección:</th>
                <td>{{ $registro->direccion }}</td>
            </tr>
            @endif
        </table>

        @php
            $camposPorGrupo = $tipo->campos->groupBy('grupo');
        @endphp

        {{-- Iterar grupos de campos --}}
        @foreach($camposPorGrupo as $grupo => $campos)
            @if($grupo && !in_array($grupo, ['Datos Personales', 'Contacto']))
            <div class="section-header">{{ strtoupper($grupo) }}</div>
            <table>
                @foreach($campos as $campo)
                    @if(!in_array($campo->nombre, ['nombre', 'apellido', 'cedula', 'cedula_tipo', 'edad', 'sexo', 'telefono', 'direccion']))
                        <tr>
                            <th>{{ $campo->etiqueta }}:</th>
                            <td>
                                @if($campo->tipo_campo == 'date')
                                    {{ $registro->{$campo->nombre} ? $registro->{$campo->nombre}->format('d/m/Y') : '-' }}
                                @elseif($campo->tipo_campo == 'select')
                                    @if($campo->opciones && isset($campo->opciones[$registro->{$campo->nombre}]))
                                        {{ $campo->opciones[$registro->{$campo->nombre}] }}
                                    @else
                                        {{ $registro->{$campo->nombre} ?? '-' }}
                                    @endif
                                @else
                                    {{ $registro->{$campo->nombre} ?? '-' }}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            @endif
        @endforeach

        {{-- Información de registro --}}
        <div class="footer-info">
            <p><strong>Fecha de registro:</strong> {{ $registro->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Última actualización:</strong> {{ $registro->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Generado el:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        </div>

    </div>

</body>
</html>
