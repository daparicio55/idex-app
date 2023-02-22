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
                <th colspan="11"><h1>Reporte Sitema de Ventas</h1></th>
            </tr>
            <tr>
                <th colspan="11">
                    Fechas de: {{ date('d-m-Y',strtotime($datos[2])) }} hasta: {{ date('d-m-Y',strtotime($datos[3])) }}
                </th>
            </tr>
            <tr>
                <th colspan="11">
                    @if ($datos[4]==0)
                        Servicio: TODOS
                    @else
                        Servicio: {{ $servicio }}
                    @endif
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>T. Pago</th>
                <th>Comp.</th>
                <th>Num.</th>
                <th>DNI</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Observacion</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($ventas as $key=>$venta)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $venta->tipoPago }}</td>
            <td>{{ $venta->tipo }}</td>
            <td>{{ $venta->numero }}</td>
            <td>{{ $venta->cliente->dniRuc }}</td>
            <td>{{ $venta->cliente->apellido }}, {{ $venta->cliente->nombre }}</td>
            <td>
                @foreach ($venta->detalles as $detalle)
                    {{ $detalle->servicio->nombre }}
                @endforeach
            </td>
            <td>{{ $venta->comentario }}</td>
            <td>{{ date('d-m-Y',strtotime($venta->fecha)) }}</td>
            <td>{{ $venta->total }}</td>
            <td>{{ $venta->estado }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="8"></td>
            <td>Total</td>
            <td>{{ $sumaTotal->sumaTotal }}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>