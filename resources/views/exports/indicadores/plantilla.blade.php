<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>APELLIDOS, Nombres</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
        @php
            $contador = 1;
        @endphp 
        {{-- recorrido de estudiantes --}}
        @foreach ($estudiantes as $estudiante)
            @if ($estudiante->licencia != "SI")
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $estudiante->estudiante->postulante->cliente->dniRuc }}</td>
                    <td><strong>{{ Str::upper($estudiante->estudiante->postulante->cliente->apellido) }}</strong>,
                        {{  Str::title($estudiante->estudiante->postulante->cliente->nombre) }}</td>
                    <td></td>
                </tr>
                @php
                    $contador ++;
                @endphp
            @endif
            
        @endforeach
        @php
            $contador = 1;
        @endphp 
        @foreach ($eestudiantes as $eestudiante)
            @if ($eestudiante->licencia != "SI")
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $eestudiante->estudiante->postulante->cliente->dniRuc }}</td>
                    <td><strong>{{ Str::upper($eestudiante->estudiante->postulante->cliente->apellido) }}</strong>, 
                        {{  Str::title($eestudiante->estudiante->postulante->cliente->nombre) }}</td>
                    <td></td>
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