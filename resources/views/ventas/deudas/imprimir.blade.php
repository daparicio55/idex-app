<!DOCTYPE html>
<html>
<head>
    <title>Sistema IDEX Perú Japón</title>
    <meta lang="es_ES">
    <meta charset="utf-8">
    <style>
        html{ 
            margin: 20px;
        }
        h1{
            text-align: center;
        }
        h6{
            text-align: center;
        }
        h5{
            text-align: center;
        }
        .tablaCuerpo{
            width: 100%;
            height: 97%;
        }
        .tablaColumna
        {
            vertical-align: top;
            style="width: 48%;
            border: black 2px solid;
        }
        .datosResumen
        {
            line-height: 1px;
        }
        .datosTitulo
        {
            line-height: 1px;
        }
        .imagenHeader
        {
            text-align: center;
            line-height: 3px;
        }
        p{
            text-align: justify;
            line-height: 15px;
        }
    </style>
</head>
<body>
    <table class="tablaCuerpo">
        <tbody>
            <tr>
                <td class="tablaColumna">
                    <div class="imagenHeader">
                        <img width="350px" src="https://intranet.idexperujapon.edu.pe/img/pjHeader.jpg" alt="no imagen">
                    </div>
                    <br>
                    <div class="datosTitulo">
                        <h1>Comprobante de Deuda</h1>
                        <h5>resumen de cuotas..</h5>
                    </div>
                    <div class="datosResumen">
                        <h4>Numero: {{$deudas->numero}}</h4>
                        <h4>DNI y Nombre: {{$deudas->dniRuc}} {{$deudas->apellido}} {{$deudas->nombre}}</h4>
                        <h4>Fecha: {{date('d-m-Y',strtotime($deudas->fDeuda))}}</h4>
                        <h4>Servicio: {{$deudas->nombreServicio}}</h4>
                        <p>Observacion: {{$deudas->observacion}}</p>
                    </div>
                    <table style="width: 100%">
                        <tbody>
                            <tr>
                                <td><b>Num.</b></td>
                                <td><b>F. Programada</b></td>
                                <td><b>Monto</b></td>
                                <td><b>Estado</b></td>
                                <td><b>Boleta</b></td>
                                <td><b>Sello Fecha</b></td>
                            </tr>
                            @foreach ($deudasDetalles as $dede)
                                <tr>
                                    <td>{{$dede->orden}}</td>
                                    <td>{{date('d-m-Y',strtotime($dede->fechaPrograma))}}</td>
                                    <td>{{$dede->monto}}</td>
                                    <td>{{$dede->estado}}</td>
                                    <td>@if ($dede->boletaNumero == NULL) sin pago @else {{$dede->boletaNumero}}  @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <table style="width: 100%">
                        <tbody>
                            <tr style="text-align: center">
                                <td style="width: 33%">_______________________</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">_____________</td>
                            </tr>
                            <tr style="text-align: center">
                                <td style="width: 33%">IDEX "PJ"</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">ESTUDIANTE</td>
                            </tr>
                            <tr style="text-align: center">
                                <td style="width: 33%">firma post firma y sello</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">firma</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 4%"></td>
                <td class="tablaColumna">
                    <div class="imagenHeader">
                        <img width="350px" src="https://intranet.idexperujapon.edu.pe/img/pjHeader.jpg" alt="no imagen">
                    </div>
                    <br>
                    <div class="datosTitulo">
                        <h1>Comprobante de Deuda</h1>
                        <h5>resumen de cuotas..</h5>
                    </div>
                    <div class="datosResumen">
                        <h4>Numero: {{$deudas->numero}}</h4>
                        <h4>DNI y Nombre: {{$deudas->dniRuc}} {{$deudas->apellido}} {{$deudas->nombre}}</h4>
                        <h4>Fecha: {{date('d-m-Y',strtotime($deudas->fDeuda))}}</h4>
                        <h4>Servicio: {{$deudas->nombreServicio}}</h4>
                        <p>Observacion: {{$deudas->observacion}}</p>
                    </div>
                    <table style="width: 100%">
                        <tbody>
                            <tr>
                                <td><b>Num.</b></td>
                                <td><b>F. Programada</b></td>
                                <td><b>Monto</b></td>
                                <td><b>Estado</b></td>
                                <td><b>Boleta</b></td>
                                <td><b>Sello Fecha</b></td>
                            </tr>
                            @foreach ($deudasDetalles as $dede)
                                <tr>
                                    <td>{{$dede->orden}}</td>
                                    <td>{{date('d-m-Y',strtotime($dede->fechaPrograma))}}</td>
                                    <td>{{$dede->monto}}</td>
                                    <td>{{$dede->estado}}</td>
                                    <td>@if ($dede->boletaNumero == NULL) sin pago @else {{$dede->boletaNumero}}  @endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <table style="width: 100%">
                        <tbody>
                            <tr style="text-align: center">
                                <td style="width: 33%">_______________________</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">_____________</td>
                            </tr>
                            <tr style="text-align: center">
                                <td style="width: 33%">IDEX "PJ"</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">ESTUDIANTE</td>
                            </tr>
                            <tr style="text-align: center">
                                <td style="width: 33%">firma post firma y sello</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">firma</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>