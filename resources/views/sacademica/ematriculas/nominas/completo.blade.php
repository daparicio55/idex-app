<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nóminas</title>
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
        td{
            border: 1px solid #000;
            border-spacing: 0;
        }
        h4{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .button {
            background-color: #4CAF50; /* Green */
            color: white;
            font-size: 15px
        }
    </style>
</head>
<header>
    <table style="border: 0px; with 100%">
        <th>
            <img src="https://sisge.idexperujapon.edu.pe/img/pjHeader.jpg" height="80" alt="">
        </th>
        <th>
            <h4>Sistema de Control IDEX "Perú Japón" Nómina por Programa de Estudio y ciclo</h4>
        </th>
    </table>
</header>
<body>
    <table style="width: 100%">
        <tbody>
            <td style="background:lightblue"><b>Programa de Estudios</b></td>
            <td>{{ $carr->nombreCarrera }}</td>
            <td style="background:lightblue"><b>Semestre Academico</b></td>
            <td style="text-align: center">{{ $periodo->nombre }}</td>
            <td style="background:lightblue"><b>Ciclo</b></td>
            <td style="text-align: center"><b>{{ $ciclo }}</b></td>
            <td style="text-align: center">
                {!! Form::open(['route'=>'exports.nomina1','method'=>'get']) !!}
                    <input type="hidden" name="carrera_id" id="carrera_id" value = {{ $carr->idCarrera }}>
                    <input type="hidden" name="periodo_id" id="periodo_id" value = {{ $periodo->id }}>
                    <input type="hidden" name="ciclo" id="ciclo" value = {{ $ciclo }}>
                    <button type="submit" class="button"> <i class="fa-solid fa-file-excel"></i> Excel</button>
                {!! Form::close() !!}
            </td>
        </tbody>
    </table>
    <br>
    <table style="width: 100%">
        @php
            $contador = 1;
        @endphp
        <thead>
            <tr>
                <td style="vertical-align: bottom;background:lightgray">N°</td>
                <td style="vertical-align: bottom;background:lightgray">DNI</td>
                <td style="vertical-align: bottom;background:lightgray">APELLIDOS, Nombres</th>
                <td style="vertical-align: bottom;background:lightgray">Telefono</td>
                <td style="vertical-align: bottom;background:lightgray">WhatsApp</td>
                <td style="vertical-align: bottom;background:lightgray">Ingreso</td>
                <td style="vertical-align: bottom;background:lightgray">Edad</td>
                <td style="vertical-align: bottom;background:lightgray">Sexo</td>
                <td style="vertical-align: bottom;background:lightgray">Disc.</td>
                @foreach ($modulos as $modulo)
                    <td style="vertical-align: bottom; background:gray; text-align: center"><div class="verticalText">{{ $modulo->nombre }}</div></td>
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