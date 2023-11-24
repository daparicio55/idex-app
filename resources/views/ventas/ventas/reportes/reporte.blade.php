@extends('adminlte::page')

@section('title', 'Reporte de Ventas')

@section('content_header')
    <h1>Reporte de Ventas</h1>
@stop

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="bg-secondary">
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
                    <tr @if($venta->estado == "anulado") class="text-danger" @endif>
                        <td class="mt-0 mb-0 pt-0 pb-0">{{ $key + 1 }}</td>
						<td class="mt-0 mb-0 pt-0 pb-0">{{ $venta->tipoPago }}</td>
                        <td class="mt-0 mb-0 pt-0 pb-0">{{ $venta->tipo }}</td>
						<td class="text-center mt-0 mb-0 pt-0 pb-0">{{ $venta->numero }}</td>
						<td class="mt-0 mb-0 pt-0 pb-0">{{ date('d-m-Y',strtotime($venta->fecha)) }}</td>
						<td class="mt-0 mb-0 pt-0 pb-0">{{ $venta->cliente->dniRuc }}</td>
                        <td class="mt-0 mb-0 pt-0 pb-0">{{ Str::upper($venta->cliente->apellido) }}, {{ Str::title($venta->cliente->nombre) }}</td>
                        <td class="mt-0 mb-0 pt-0 pb-0">
                            <ul>
                            @foreach ($venta->detalles as $detalle)
                                <li>{{ $detalle->servicio->nombre }}</li>    
                            @endforeach
                            </ul>
                        </td>
                        <td class="mt-0 mb-0 pt-0 pb-0">{{ $venta->observacion }}</td>
						<td class="text-right mb-0 pt-0 pb-0">{{ $venta->total }}</td>
						<td class="mt-0 mb-0 pt-0 pb-0">{{ $venta->estado }}</td>
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
                <tr class="text-danger">
                    <td colspan="9" class="text-right">Total Anulados</td>
                    <td colspan="2" class="text-center">
                        S/ {{ number_format($totalanulado,2) }}
                    </td>
                </tr>
                <tr class="text-primary">
                    <td colspan="9" class="text-right"><b><h3>TOTAL:</h3></b></td>
                    <td colspan="2" class="text-center">
                        <h3>
                            S/ {{ number_format($totalactivo,2) }}
                        </h3>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@stop