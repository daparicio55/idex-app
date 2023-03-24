<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        td{
            border: 1px solid #000;
            border-spacing: 0;
        }
        h4{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="9">
                    <b>
                        Unidad Didactica:
                    </b>
                </th>
            </tr>
            <tr>
                <th colspan="9">
                    <b>
                        {{ Str::title($unidad->nombre)  }}
                    </b>
                </th>
            </tr>
            <tr>
                <th colspan="9">
                    <b>
                        Programa de Estudios
                    </b>
                </th>
            </tr>
            <tr>
                <th colspan="9">
                    <b>
                        {{ Str::title($carrera->nombreCarrera)  }}
                    </b>
                </th>
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
            </tr>
        </thead>
        <tbody>
            @php
                $contador = 1;
            @endphp 
            {{-- recorrido de estudiantes --}}
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
                </tr>
                @php
                    $contador ++;
                @endphp

            @endforeach

            @foreach ($eestudiantes as $estudiante)
                    @isset($unidad->old->nombre)
                        @if ($estudiante->unidad == $unidad->old->nombre)
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
                            </tr>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                    @endisset
                @endforeach




        </tbody>
    </table>
</body>
</html>