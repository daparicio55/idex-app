<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .verticalText{
            display: inline;
            line-height: 1;
            position: relative;
            -webkit-transform: rotate(89deg);
            transform: rotate(180deg);
            white-space: nowrap;
            -webkit-writing-mode: vertical-rl;
            writing-mode: vertical-rl;
        }
    </style>
</head>
<body>
    <table>
        @php
            $contador = 1;
        @endphp
        <thead>
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    <b>Programa de Estudios: </b>
                </th>
            </tr>
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    {{  $carr->nombreCarrera }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    <b>Semestre Academico: </b>  
                </th>
            </tr>
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    {{ $periodo->nombre }}
                </th>
            </tr> 
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    <b>Ciclo:</b>
                </th>
            </tr>
            <tr>
                <th colspan="{{ 9+count($modulos) }}">
                    {{ $ciclo }}
                </th>
            </tr>
            <tr>
                <th colspan="9"></th>
                <th colspan="{{ count($modulos) }}">Unidades Didacticas</th>
            </tr>
            <tr>
                <th style="vertical-align: bottom;background:lightgray">N°</th>
                <th style="vertical-align: bottom;background:lightgray">DNI</th>
                <th style="vertical-align: bottom;background:lightgray">APELLIDOS, Nombres</th>
                <th style="vertical-align: bottom;background:lightgray">Telefono</th>
                <th style="vertical-align: bottom;background:lightgray">WhatsApp</th>
                <th style="vertical-align: bottom;background:lightgray">Ingreso</th>
                <th style="vertical-align: bottom;background:lightgray">Edad</th>
                <th style="vertical-align: bottom;background:lightgray">Sexo</th>
                <th style="vertical-align: bottom;background:lightgray">Disc.</th>
                @foreach ($modulos as $modulo)
                    <th style="vertical-align: bottom; background:gray; text-align: center"><div class="verticalText">{{ $modulo->nombre }}</div></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
            <tr @if($estudiante->licencia == "SI") style="text-decoration : line-through; background : #F76A4C" @endif>
                <td>{{ $contador }}</td>
                <td>{{ $estudiante->dniRuc }}</td>
                <td><strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}</td>
                <td>{{ $estudiante->telefono }}</td>
                <td>{{ $estudiante->telefono2 }}</td>
                <td>{{ $estudiante->periodo }}</td>
                <td>{{ edad($estudiante->fechaNacimiento) }}</td>
                <td style="text-align: center">
                    @if ($estudiante->sexo == 'Masculino')
                        M
                    @else
                        F
                    @endif
                </td>
                <td style="text-align: center">
                    @if ($estudiante->discapacidad == 0)
                        SI 
                    @else
                        NO
                    @endif
                </td>
                @foreach ($modulos as $modulo)
                    <td style="text-align: center">
                        @if (checkUnidad($estudiante->id,$modulo->id) == "SI")
                            <b style="color: blue">{{ checkUnidad($estudiante->id,$modulo->id) }}</b>
                        @endif
                        @if (checkUnidad($estudiante->id,$modulo->id) == "NM")
                            <b style="color: black">{{ checkUnidad($estudiante->id,$modulo->id) }}</b>
                        @endif
                        @if (checkUnidad($estudiante->id,$modulo->id) == "RE")
                            <b style="color: red">{{ checkUnidad($estudiante->id,$modulo->id) }}</b>
                        @endif
                        @if (checkUnidad($estudiante->id,$modulo->id) == "CV")
                            <b style="color: green">{{ checkUnidad($estudiante->id,$modulo->id) }}</b>
                        @endif
                    </td>
                @endforeach
            </tr>
            @php
                $contador ++;
            @endphp
            @endforeach
            
            @foreach ($eestudiantes as $estudiante)
            {{-- comprobar si no tiene matricula --}}
            @php
                $bandera = false;
            @endphp
            @foreach ($modulos as $modulo)
                @if (checkUnidadeq($estudiante->id,$modulo->id) == "EQ")
                    @php
                        $bandera = true;
                    @endphp
                @endif
            @endforeach
            @if($bandera == true)
            {{-- fin de la coprobacion --}}
                <tr @if($estudiante->licencia == "SI") style="text-decoration : line-through; background : #F76A4C" @endif>
                    <td>{{ $contador }}</td>
                    <td>{{ $estudiante->dniRuc }}</td>
                    <td><strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}</td>
                    <td>{{ $estudiante->telefono }}</td>
                    <td>{{ $estudiante->telefono2 }}</td>
                    <td>{{ $estudiante->periodo }}</td>
                    <td>{{ edad($estudiante->fechaNacimiento) }}</td>
                    <td style="text-align: center">
                        @if ($estudiante->sexo == 'Masculino')
                            M
                        @else
                            F
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if ($estudiante->discapacidad == 0)
                            SI 
                        @else
                            NO
                        @endif
                    </td>
                    @foreach ($modulos as $modulo)
                        <td style="text-align: center">
                            {{-- {{ checkUnidadeq($estudiante->id,$modulo->id) }} --}}
                            @if (checkUnidadeq($estudiante->id,$modulo->id) == "EQ")
                                <b style="color:purple">{{ checkUnidadeq($estudiante->id,$modulo->id) }}</b>
                            @endif
                            @if (checkUnidadeq($estudiante->id,$modulo->id) == "NM")
                                <b style="color: black">{{ checkUnidadeq($estudiante->id,$modulo->id) }}</b>
                            @endif
                        </td>
                    @endforeach
                </tr>
                @php
                    $contador ++;
                @endphp
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>