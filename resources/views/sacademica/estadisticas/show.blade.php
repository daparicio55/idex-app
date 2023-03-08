<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $periodo->nombre  }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
@php
    use Illuminate\Support\Carbon;
@endphp
<body>
    <table class="table">
        <thead>
            <tr>
                <th colspan="9">Reporte de Matriculas periodo {{ $periodo->nombre }}</th>
            </tr>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>APELLIDOS, Nombres</th>
                <th>Correo</th>
                <th>F. Nacimiento</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Discapacidad</th>
                <th>Programa de Estudios</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $key => $matricula )
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                <td>{{ Str::upper($matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title(strtolower($matricula->estudiante->postulante->cliente->nombre)) }}</td>
                <td>{{ $matricula->estudiante->postulante->cliente->email }}</td>
                <td>{{ date('d-m-Y',strtotime($matricula->estudiante->postulante->fechaNacimiento)) }}</td>   
                <td>{{ edad($matricula->estudiante->postulante->fechaNacimiento) }}</td>
                <td>{{ $matricula->estudiante->postulante->sexo }}</td>
                <td>
                    @if ($matricula->estudiante->postulante->discapacidad==1)
                        NO
                    @else
                        SI
                    @endif
                </td>
                <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>         
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>