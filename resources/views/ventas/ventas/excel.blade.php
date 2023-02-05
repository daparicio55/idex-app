<!DOCTYPE html>
@php
    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename='.$filename);
@endphp
<html>
<head>
    <title>Sistema IDEX Perú Japón</title>
</head>
<body>
<section>

    <table class="table table-condensed">
        <thead>
            <tr >
                <td colspan="9">
                    <h1>REPORTE DE VENTAS</h1>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <h5><b>Fecha de Inicio:</b> {{date('d-m-y',strtotime($datos[2]))}} <b>Fecha de Fin: </b>{{date('d-m-y',strtotime($datos[3]))}} <b>T. Pago: </b>{{$datos[1]}}</h5>
                </td>
            </tr>
            <tr>
                <td colspan="9">
                    <h6><b>Servicios: </b>{{$servicio}}</h6>
                </td>
            </tr>
        </thead>
    <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th style="width: 5%">T Pago</th>
            <th style="width: 5%">Comp.</th>
            <th style="width: 5%">Num</th>
            <th>Nombre Cliente</th>
            <th>Observacion</th>
            <th style="width: 10%">Fecha</th>
            <th style="width: 5%">Monto</th>
            <th style="width: 5%">Estado</th>
        </tr>
    </thead>
        <input type="hidden" value="{{$i=1}}">
    <tbody>
        @foreach ($ventas as $vent)
            <tr>
                <td>{{$i}} <input type="hidden" value="{{$i++}}"></td>
                <td>{{ $vent->tipoPago}}</td>
                <td>{{ $vent->tipo}}</td>
                <td>{{ $vent->numero}}</td>
                <td>{{ $vent->nombre.' '.$vent->apellido}}</td>
                <td>{{ $vent->comentario}}</td>
                <td>{{ date('d-m-Y', strtotime($vent->fecha))}}</td>
                <td>{{ $vent->total}}</td>
                <td>{{ $vent->estado}}</td>
            </tr>
        @endforeach
    </tbody>
        
    </table>

</section>
<footer>
        <h3><b>Total</b> {{$sumaTotal->sumaTotal}}</h3>
</footer>
</body>
</html>