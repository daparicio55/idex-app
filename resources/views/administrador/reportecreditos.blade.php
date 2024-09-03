@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Reporte de Ventas</h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <th>DNI</th>
            <th>APELLIDOS, Nombres</th>
            <th>P. Crédito</th>
            <th>P. Normal</th>
            <th>En ventas</th>
        </thead>
        <tbody>
            @foreach ($matriculas_arr as $matricula)
                <tr>
                    <td>{{ $matricula['dni'] }}</td>
                    <td>{{ Str::upper($matricula['nombres']) }}</td>
                    <td>{{ $matricula['pago'] }}</td>
                    <td>{{ $matricula['pnormal'] }}</td>
                    <td>
                        @foreach ($matricula['ventas'] as $venta)
                            <ul>
                                <li>{{ $venta->numero }} - {{ $venta->total }}</li>
                            </ul>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">SUMAS TOTALES</td>
                <td>
                    @php
                        $c_pago = array_column($matriculas_arr,'pago');
                    @endphp
                    {{ array_sum($c_pago) }}
                </td>
                <td>
                    @php
                        $n_pago = array_column($matriculas_arr,'pnormal');
                    @endphp
                    {{ array_sum($n_pago) }}
                </td>
            </tr>
        </tfoot>
    </table>
@stop