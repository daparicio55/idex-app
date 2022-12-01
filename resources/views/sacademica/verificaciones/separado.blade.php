<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Verificaciones Separadas {{ $periodo->nombre }}</title>
    <style>
        .verticalText{
            writing-mode: vertical-lr;
            display: inline;
        }
        td{
            border: 1px solid #000;
            border-spacing: 0;
        }
        h4{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
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
    {!! Form::open(['route'=>'sacademica.verificaciones.store','method'=>'post','autocomplete'=>'off']) !!}
    <table style="width: 100%">
        <tbody>
            <td style="background:lightblue"><b>Programa de Estudios</b></td>
            <td>{{ $carr->nombreCarrera }}</td>
            <td style="background:lightblue"><b>Semestre Academico</b></td>
            <td style="text-align: center">{{ $periodo->nombre }}</td>
            <td style="background:lightblue"><b>Ciclo</b></td>
            <td style="text-align: center"><b>{{ $ciclo }}</b></td>
        </tbody>
    </table>
    <br>
    @foreach ($modulos as $modulo)
            {{-- aca vamos con los estudiantes de este curso --}}
        <table style="width: 100%">
            <thead>
                <tr>
                    <td colspan="8" style="background:lightseagreen"><h3>{{ $modulo->nombre }}</h3></td>
                </tr>
                <tr>
                    <td style="vertical-align: bottom;background:lightgray">N°</td>
                    <td style="vertical-align: bottom;background:lightgray">DNI</td>
                    <td style="vertical-align: bottom;background:lightgray">APELLIDOS, Nombres</th>
                    <td style="vertical-align: bottom;background:lightgray">NOTA</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $contador = 1;
                @endphp
                @foreach ($estudiantes as $estudiante)
                    @if ($estudiante->unidad == $modulo->nombre)
                        @if($estudiante->licencia == "NO")
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $estudiante->dniRuc }}</td>
                                <td><strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}</td>
                                <td>
                                    <input style="text-align: right" type="hidden" name="id[]" value="{{ detalle($estudiante->id,$modulo->id)->id }}">
                                    <input class="form-control" style="text-align: right" type="number" name="notas[]" min="0" max="20" value="{{ detalle($estudiante->id,$modulo->id)->nota }}">
                                </td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary" type="submit">
                                        guardar
                                    </button>
                                </td>
                            </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endif
                @endforeach
            </tbody>
            </table>
    @endforeach
    {!! Form::close() !!}
</body>
</html>