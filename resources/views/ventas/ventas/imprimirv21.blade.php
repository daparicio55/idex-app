<!DOCTYPE html>
<html>
<head>
<title>Venta Nueva</title>
<style type="text/css">
    @page{
        margin: 0cm;
    }
    #numero{
        font-family: 'Times New Roman', Times, serif;
        background-color: white;
        position: absolute;
        top: 3.6cm;
        left: 10cm;
        /* border: 1px;
        border: black 1px solid; */
    }
    #fecha{
        font-family: 'Times New Roman', Times, serif;
        font-size: 18px;
        background-color: white;
        position: absolute;
        top: 4.15cm;
        left: 12.2cm;
        /* border: black 1px solid; */
    }
    #dni{
        font-family: 'Times New Roman', Times, serif;
        font-size: 18px;
        background-color: white;
        position: absolute;
        width: 2cm;
        top: 4.3cm;
        left: 9.8cm;
        /* border: black 1px solid; */
    }
    #nombre{
        text-transform: uppercase;
        font-family: 'Times New Roman', Times, serif;
        font-size: 12px;
        background-color: white;
        position: absolute;
        width: 7.2cm;
        top: 3.9cm;
        left: 2.1cm;
        /* border: black 1px solid; */
    }
    #direccion{
        text-transform: lowercase;
        font-family: 'Times New Roman', Times, serif;
        font-size: 9px;
        background-color: white;
        position: absolute;
        width: 6.9cm;
        top: 4.5cm;
        left: 2.5cm;
        /* border: black 1px solid; */
    }
    #tabla{
        text-transform: lowercase;
        font-family: 'Times New Roman', Times, serif;
        font-size: 13px;
        background-color: white;
        position: absolute;
        width: 13.9cm;
        height: 3.3cm;
        top: 5.5cm;
        left: 1.1cm;
        /* border: black 1px solid; */
    }
    #total{
        font-family: 'Times New Roman', Times, serif;
        font-size: 18px;
        background-color: white;
        position: absolute;
        top: 9cm;
        left: 12.7cm;
        /* border: black 1px solid; */
    }
    #observacion{
        font-family: 'Times New Roman', Times, serif;
        font-size: 16px;
        background-color: white;
        position: absolute;
        top: 9.7cm;
        left: 0.5cm;
        /* border: black 1px solid; */
    }
</style>
</head>
 <body>
    <div id="numero">
        {{$ventas->numero}}
    </div>
    <div id="fecha">
        {{ date('d-m-Y', strtotime($ventas->fecha))}}
    </div>
    <div id="dni">
        {{$ventas->dniRuc}}
    </div>
    <div id="nombre">
        {{$ventas->apellido}}, {{$ventas->nombre}}
    </div>
    <div id="direccion">
        {{$ventas->direccion}}
    </div>

    <table id="tabla">
        <tbody>
            @foreach ($detalles as $detalle)
            <tr style="vertical-align:text-top">
                <td style="width: 9.6%;text-align: center">{{$detalle->cantidad}}</td>
                <td style="width: 62%">{{$detalle->descripcion}}</td>
                <td style="width: 13%;text-align: center">{{$detalle->precio}}</td>
                <td style="text-align: center">{{$detalle->importe}}</td>
            </tr>
            @endforeach
        </tbody>
        <tr>
            <td></td>
            <td>Observacion: {{$ventas->comentario}}</td>
        </tr>
    </table>
    <div id="total">
        {{$ventas->total}}
    </div>
    <div id="observacion">
        
    </div>
 </body>
</html>










