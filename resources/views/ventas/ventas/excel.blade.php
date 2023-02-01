<!DOCTYPE html>
@php
    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename='.$filename);
@endphp
<html>
<head>
    <title>Sistema IDEX Perú Japón</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            font-size: 12px;
        }
        b{
            color: blue;
        }
        h2{
            text-align: center;
        }
    </style>
</head>
<body>
<section class="content">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
    <thead class="thead-dark">
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
</div>
</div>
</section>
<footer class="main-footer">
    <div class="pull-right hidden-xs" style="text-align: right">
        <h3><b>Total</b> {{$sumaTotal->sumaTotal}}</h3>
    </div>
</footer>
</body>
</html>