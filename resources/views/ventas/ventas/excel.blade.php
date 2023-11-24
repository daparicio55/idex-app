<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Excel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="11" style="text-align:center">REPORTE DE VENTAS</th>
            </tr>
            <tr>
                <th>#</th>
                <th>T. Pago</th>
                <th>Com.</th>
                <th>Núm.</th>
                <th>Fecha</th>
                <th>DNI</th>
                <th>APELLIDO, Nombre</th>
                <th>Servicio</th>
                <th>Observacion</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalactivo=0;
                $totalanulado=0;
            @endphp
            @foreach ($ventas as $key=>$venta)
                <tr @if($venta->estado == "anulado") @endif>
                    <td>{{ $key + 1 }}</td>
					<td>{{ $venta->tipoPago }}</td>
                    <td>{{ $venta->tipo }}</td>
					<td>{{ $venta->numero }}</td>
					<td>{{ date('d-m-Y',strtotime($venta->fecha)) }}</td>
					<td>{{ $venta->cliente->dniRuc }}</td>
                    <td>{{ Str::upper($venta->cliente->apellido) }}, {{ Str::title($venta->cliente->nombre) }}</td>
                    <td>
                        <ul>
                        @foreach ($venta->detalles as $detalle)
                            <li>{{ $detalle->servicio->nombre }}</li>    
                        @endforeach
                        </ul>
                    </td>
                    <td>{{ $venta->observacion }}</td>
					<td>{{ $venta->total }}</td>
					<td>{{ $venta->estado }}</td>
                </tr>
                @php
                    if($venta->estado == "activo"){
                        $totalactivo = $totalactivo + $venta->total;
                    }
                    if($venta->estado == "anulado"){
                        $totalanulado = $totalanulado + $venta->total;
                    }
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" style="text-align: right">Total Anulados:</td>
                <td>
                    {{ number_format($totalanulado,2) }}
                </td>
            </tr>
            <tr>
                <td colspan="9" style="text-align: right"><b><h3>TOTAL:</h3></b></td>
                <td>
                    <h3>
                        {{ number_format($totalactivo,2) }}
                    </h3>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>