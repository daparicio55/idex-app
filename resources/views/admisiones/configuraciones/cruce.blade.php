@extends('adminlte::page')
@section('title', 'Cruce de Pagos')

@section('content_header')
    <h1>Cruce de pagos - {{ $admision->nombre }}</h1>
    <a href="">
        EXCEL
    </a>
@stop
@section('content')
    <table class="table">
        <thead>
            <th>#</th>
            <th>DNI</th>
            <th>NOMBRE</th>
            <th>Venta</th>
        </thead>
        <tbody>
            @foreach ($postulantes as $key=>$postulante)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $postulante->cliente->dniRuc }}</td>
                    <td>
                        {{ $postulante->cliente->apellido }}, {{ $postulante->cliente->nombre }} <br>
                        {{ $postulante->modalidadTipo }} <br>
                        {{ $postulante->modalidad }}
                    </td>
                    <td>
                        @if (isset($postulante->cliente->ventas[0]))
                            @foreach ($postulante->cliente->ventas()->orderBy('idVenta','desc')->get() as $venta)
                                @if($venta->estado == "activo")
                                    #{{ $venta->numero }} - Fecha: {{ date('d-m-Y',strtotime($venta->fecha)) }} - {{ $venta->detalles[0]->servicio->nombre }} <br>
                                @endif
                            @endforeach
                        @else
                            No hay
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop