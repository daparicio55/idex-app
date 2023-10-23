<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de DEUDAS</title>
</head>
<body>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>DNI</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Telefonos</th>
                    <th>Programa de Estudios</th>
                    <th>Fecha Registro</th>
                    <th>Servicio</th>
                    <th>Observacion</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deudas as $deuda)
                    <tr>
                        <td>{{ $deuda->numero }}</td>
                        <td>{{ $deuda->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($deuda->cliente->apellido) }}, {{ Str::title($deuda->cliente->nombre) }}</td>
                        <td>{{ $deuda->cliente->telefono }} / {{ $deuda->cliente->telefono2 }}</td>
                        <td>
                            @foreach ($deuda->cliente->postulaciones as $postulacion)
                                @isset($postulacion->estudiante->postulante)
                                    {{ $postulacion->estudiante->postulante->carrera->nombreCarrera }}	
                                @endisset
                            @endforeach
                        </td>
                        <td>{{ date('d-m-Y',strtotime($deuda->fDeuda)) }}</td>
                        <td>{{ $deuda->servicio->nombre }}</td>
                        <td>{{ $deuda->observacion }}</td>
                        <td>@foreach($deuda->deudadetalles as $detalle)<p><b>F. Programada:</b>&nbsp;{{ date('d-m-Y',strtotime($detalle->fechaPrograma)) }}&nbsp;<b>Monto:</b>&nbsp;{{ $detalle->monto }}&nbsp;<b>Estado:</b>&nbsp;{{ $detalle->estado }}<b>&nbsp;Boleta:</b>&nbsp;{{ $detalle->boletaNumero }}</p>@endforeach</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

</body>
</html>