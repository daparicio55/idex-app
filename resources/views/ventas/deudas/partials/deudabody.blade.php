<header>
    <table class="table-size">
        <tr>
            <td>
                <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px" alt="a">
            </td>
            <td>
                Familia Tecnológica, la unidad es la medalla que nos distinge ...
            </td>
            <td>
                <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png" width="150px" alt="b">
            </td>
        </tr>
    </table>
</header>
<main>
    <table class="table-size">
        <tr>
            <td style="width: 20%">
                <h2 style="padding-left: 20px">COMPROBANTE DE DEUDA</h2>
            </td>
            <td style="width: 35%"></td>
            <td class="cuadro">
                <h3>IEST Público Perú Japón</h3>
                <p>Deuda - <span style="font-weight: 900">{{ ceros($deuda->numero) }}</span></p>
                <p>Fecha - {{ date('d-m-Y',strtotime($deuda->fDeuda)) }}</p>
            </td>
        </tr>
    </table>
</main>
<section>
    <table>
        <tr>
            <td>DNI</td>
            <td>{{ $deuda->cliente->dniRuc }}</td>
        </tr>
        <tr>
            <td>APELLIDOS, Nombres</td>
            <td>{{ Str::upper($deuda->cliente->apellido) }}, {{ Str::title($deuda->cliente->nombre) }}</td>
        </tr>
        <tr>
            <td>PROGRAMA</td>
            <td>
                <ul style="margin-bottom: 3px;margin-top: 3px">
                    @foreach ($deuda->cliente->postulaciones as $postulacione)
                        @if(isset($postulacione->estudiante->id))
                            <li>{{ $postulacione->carrera->nombreCarrera }}</li>
                        @endif
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td>SERVICIO</td>
            <td>{{ $deuda->servicio->nombre }}</td>
        </tr>
        <tr>
            <td>OBSERVACIÓN</td>
            <td>{{ $deuda->observacion }}</td>
        </tr>
    </table>
</section>
<footer>
    <table class="cuotas">
        <thead>
            <tr>
                <th colspan="6">RESUMEN DE CUOTAS</th>
            </tr>
            <tr>
                <td>N°</td>
                <td>F. Programada</td>
                <td>Monto</td>
                <td>Estado</td>
                <td>Boleta</td>
                <td>Sello Fecha</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($deuda->detalles as $key => $detalle)
                <tr>
                    <td>{{ $detalle->orden }}</td>
                    <td>{{ date('d-m-Y',strtotime($detalle->fechaPrograma)) }}</td>
                    <td>S/ {{ $detalle->monto }}</td>
                    <td>{{ $detalle->estado }}</td>
                    <td>{{ $detalle->boletaNumero }}</td>
                    <td></td>                        
                </tr>
            @endforeach
        </tbody>
    </table>
</footer>
<div class="firmas">
    <table class="table-size">
        <tr>
            <td style="width: 33%">
                <p class="subline">___________________________</p>
                <p>IEST Público Perú Japón</p>
                <p>Firma y Sello</p>
            </td>
            <td style="width: 33%">
                
            </td>
            <td style="width: 33%">
                <p class="subline">___________________________</p>
                <p>Estudiante IESTP PJ</p>
                <p>Firma</p>
            </td>
        </tr>
    </table>
</div>