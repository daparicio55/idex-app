<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>
        Titulo
    </title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th><b>#</b></th>
                <th><b>DNI</b></th>
                <th><b>APELLIDOS,</b> Nombres</th>
                <th><b>Telefonos</b></th>
                <th><b>P. Estudios</b></th>
                <th><b>Sexo</b></th>
                {{-- preguintas --}}
                @foreach ($survey->questions as $question )
                    <th>
                        {{ $question->name_es }}
                    </th>
                @endforeach
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($survey->sdo as $key=>$sdo )
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $sdo->estudiante->postulante->cliente->dniRuc }}</td>
                    <td>
                        <b class="text-uppercase">{{ strtoupper($sdo->estudiante->postulante->cliente->apellido) }}, </b> <span>{{ ucwords(strtolower($sdo->estudiante->postulante->cliente->nombre)) }}</span>
                    </td>
                    <td>
                        {{ $sdo->estudiante->postulante->cliente->telefono  }} / {{ $sdo->estudiante->postulante->cliente->telefono2  }}
                    </td>
                    <td>
                        {{ $sdo->estudiante->postulante->carrera->nombreCarrera }}
                    </td>
                    <td>
                        {{ $sdo->estudiante->postulante->sexo }}
                    </td>
                    @php
                        $puntos = 0;
                    @endphp
                    @foreach ($sdo->sddo as $sddo )
                        <td>
                            {{ $sddo->alternative->name_es }} {{ $sddo->observation }}
                            @php
                                $puntos = $puntos + $sddo->alternative->point;
                            @endphp
                        </td>
                    @endforeach
                    <td>
                        {{ $puntos }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>