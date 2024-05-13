<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body, html {
            margin-left: 1rem;
            margin-right: 1rem;
            padding: 0;
            
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            //background-color: #333; /* Puedes cambiar el color de fondo según tu preferencia */
            //color: white; /* Puedes cambiar el color del texto según tu preferencia */
            //padding: 10px; /* Puedes ajustar el espacio de relleno según tu preferencia */
        }
       
        .logo {
            width: 80px; /* Puedes ajustar el ancho de la imagen según tu preferencia */
            height: auto;
        }

        .tabla table {
            border-collapse: collapse; /* Combina los bordes de las celdas */
            width: 120px; /* Ancho de la tabla, ajusta según sea necesario */
            font-size: 0.7rem;
        }
        .tabla td {
            border: 1px solid black; /* Establece un borde de 1px sólido en todas las celdas */
            padding: 2px; /* Añade espacio interno a las celdas, ajusta según sea necesario */
        }
        .preHeader p{
            padding: 1px;
            margin: 1px;
            text-align: center;
            font-size: 0.8rem;
        }
        .datos table{
            margin-top: 1.5rem;
            font-size: 0.7rem;
            width: 100%;
            border: 1px black solid;
            padding: 0.5rem;
        }
        .datos table tbody tr th{
            text-align: left;
        }
        .articulos table{
            margin-top: 1.5rem;
            font-size: 0.7rem;
            width: 100%;
            border: 1px black solid;
            padding: 0.5rem;
            border-collapse: collapse; /* Combina los bordes de las celdas */
        }
        .articulos table td {
            border: 1px solid black; /* Establece un borde de 1px sólido en todas las celdas */
            padding: 2px; /* Añade espacio interno a las celdas, ajusta según sea necesario */
        }
        .articulos table th {
            border: 1px solid black; /* Establece un borde de 1px sólido en todas las celdas */
            padding: 2px; /* Añade espacio interno a las celdas, ajusta según sea necesario */
        }
        ul{
            font-size: 0.5rem;
            padding-left: 0.5rem;
        }
        .footer table{
            border: 1px black solid;
            margin-top: 1rem;
            padding-top: 1px;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        .footer span{
            font-weight: 900;
            font-size: 0.5rem;
        }
        .firma{
            display: block;
            border-top: 1px black solid;
            text-align: center;
            margin-left: 1rem;
            margin-right: 1rem;
            margin-top: 4.2rem;
        }
        .aviso p{
            margin-top: 1px;
            margin-bottom: 1px;
            font-size: 0.5rem;
        }
    </style>
</head>
<body>
    <header>
        <table style="width: 100%; border: none">
            <tbody>
                <tr>
                    <td style="width: 33%">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
                    </td>
                    <td style="width: 33%">
                        <h4 style="text-align: center">ORDEN DE COMPRA GUIA DE INTERNAMIENTO</h4>
                    </td>
                    <td style="width: 33%; text-align: center">
                        <table class="tabla" style="margin: auto;">
                            <!-- Aquí va tu tabla -->
                            <thead>
                                <tr>
                                    <td>N°</td>
                                    <td colspan="2" style="text-align: center">{{ ceros($ocompra->numero) }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>DÍA</td>
                                    <td>MES</td>
                                    <td>AÑO</td>
                                </tr>
                                <tr>
                                    <td>{{ date('d',strtotime($ocompra->fecha)) }}</td>
                                    <td>{{ date('m',strtotime($ocompra->fecha)) }}</td>
                                    <td>{{ date('Y',strtotime($ocompra->fecha)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>
    <div class="preHeader">
        <p>FECHA DE ENTREGA: {{ date('d-m-Y',strtotime(agregarDiasHabiles($ocompra->fecha,$ocompra->dias))) }}</p>
        <p>PLAZO DE ENTREGA EN DÍAS: {{ Str::upper(letras($ocompra->dias)) }} ({{ $ocompra->dias }}) CALENDARIO</p>
    </div>
    <main>
        <section class="datos">
            <table>
                <tbody>
                    <tr>
                        <th>SEÑOR(ES):</th>
                        <td>{{ $ocompra->empresa->razonSocial }}</td>
                    </tr>
                    <tr>
                        <th>DIRECCIÓN:</th>
                        <td>{{ $ocompra->empresa->direccion }}</td>
                    </tr>
                    <tr>
                        <th>ENTREGA:</th>
                        <td>ALMACÉN IEST Público Perú Japón - Jr. Amazonas 120 - Chachapoyas</td>
                    </tr>
                    <tr>
                        <th>REFERENCIA:</th>
                        <td>{{ $ocompra->tramite->requerimiento->encabezado }}</td>
                    </tr>
                    <tr>
                        <th>FACTURAR A:</th>
                        <td>20222049807 - INSTITUTO DE EDUCACION SUPERIOR TECNOLOGICO PUBLICO PERU JAPON - JR. AMAZONAS NRO. 120 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="articulos">
            <table>
                <thead>
                    <tr>
                        <th colspan="4">ARTÍCULOS</th>
                        <th colspan="2">VALOR</th>
                    </tr>
                    <tr>
                        <th>Código</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th style="width: 50%">Descripcion</th>
                        <th>Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($ocompra->tramite->tramiteDetalles as $detalle)
                        <tr>
                            <td>{{ $detalle->catalogo->codigo }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->catalogo->unidade->nombre }}</td>
                            <td>{{ $detalle->catalogo->marca->nombre }} - {{ $detalle->catalogo->modelo }} {{ $detalle->catalogo->descripcion }} {{ $detalle->catalogo->observacion }}</td>
                            <td>{{ $detalle->precio->valor }}</td>                          
                            <td>{{ number_format($detalle->cantidad * $detalle->precio->valor,2) }}</td>
                        </tr>
                        @php
                            $total = $total + (number_format($detalle->cantidad * $detalle->precio->valor,2));
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="6" style="text-align: center">&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="aviso">
                            <span style="font-weight: 900">IMPORTANTE: </span>
                            <p>En caso de incumplimiento de entrega de los bienes, dentro del plazo establecido, el proveedor se hará acreedor a las penalidades por cada día de retraso injustificado.</p>
                            <p>SE CANCELARÁ LA TOTALIDAD DEL MONTO ASIGNADO PREVIA CONFORMIDAD DEL ÁREA USUARIA.</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td style="font-weight: 900; text-align: center">S/ {{ number_format($total,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="footer">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td>
                            <span class="firma" style="width: 30%">JEFE DE ADQUISICIONES</span>
                            <span>NOTA:</span>
                            <ul>
                                <li>ESTA ORDEN ES NULA SIN LA FIRMA DEL DIRECTOR DE ABASTECIMIENTO</li>
                                <li>CADA ORDEN DE COMPRA SE DEBE DE FACTURAR POR SEPARADO EN ORIGINAL Y (2) COPIAS Y REMITIRLAS A LA OFICINA DE ADMINISTRACIÓN</li>
                                <li>NOS RESERVAMOS EL DERECHO DE DEVOLVER LA MERCADERIA QUE NO ESTE DE ACUERDO CON NUESTRAS ESPECIFICACIONES</li>
                            </ul>
                        </td>
                        {{-- <td >
                            <span class="firma">JEFE DE ADQUISICIONES</span>
                        </td> --}}
                        <td style="width: 30%">
                            <span class="firma">RECIBÍ CONFORME</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>