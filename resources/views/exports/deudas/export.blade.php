<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Deudas</title>
</head>
<body>
    <table>
        <thead>
            <th class="text-center">#</th>
            <th>DNI</th>
            <th>Apellidos y Nombres</th>
            <th>Teléfono</th>
            <th>Carrera</th>
            <th>Servicio</th>
            <th style="width: 100px">Fecha</th>
            <th>Estado</th>
        </thead>
        <tbody>
            <tbody>
                @foreach ($deudas as $deu)
                <tr @if(estadoDeuda($deu->idDeuda)== "en deuda") style="color: red" @endif>
                    <td>{{$deu->numero}}</td>
                    <td>{{$deu->cliente->dniRuc}}</td>
                    <td><strong class="text-uppercase">{{$deu->cliente->apellido}}</strong>, <span class="text-capitalize">{{ Str::lower($deu->cliente->nombre)}}</span></td>
                    <td>{{$deu->cliente->telefono}}</td>
                    <td>
                        @foreach ($deu->cliente->postulaciones as $postulacion)
                            @isset($postulacion->estudiante->postulante)
                                {{ $postulacion->estudiante->postulante->carrera->nombreCarrera }}	
                            @endisset
                        @endforeach
                    </td>
                    <td>{{$deu->servicio->nombre}}</td>
                    <td>{{date('d-m-Y',strtotime($deu->fDeuda))}}</td>
                    <td>{{$deu->estado}}</td>
                </tr>
                @endforeach
            </tbody>
        </tbody>
    </table>
</body>
</html>