<!DOCTYPE html>
<html>
<head>
    <title>Sistema IDEX Perú Japón</title>
    <meta lang="es_ES">
    <meta charset="utf-8">
    <style>
        body{
            font-size: 11px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        h2{
            text-align: center;
        }
        h4{
            text-align: center;
        }
        .cabezera{
            width: 100%;
        }
        .filaCentrar{
            width: 25%;
            text-align: center;
        }
        .informacion{
            width: 100%;
            border-collapse: collapse;
            border: black 1px solid;
        }
        .filaInformacion{
            width: 20%;
            border: black 1px solid;
            font-size: 11px;
            background:lightgray;
        }
        .filaDatos{
            width: 30%;
            border: black 1px solid;
            font-size: 11px;
        }
        .tbCuerpo{
            width: 100%;
            border: black 1px solid;
            border-collapse: collapse;
            font-size: 12px;
        }
    </style>
</head>
<header>
    <table class="cabezera">
        <tbody>
            <tr>
                <td class="filaCentrar">
                    <img src="https://sisge.idexperujapon.edu.pe/img/logo.png"  height="70" alt="">
                </td>
                <td class="filaCentrar">&nbsp;</td>
                <td class="filaCentrar">&nbsp;</td>
                <td class="filaCentrar">
                    <img src="https://sisge.idexperujapon.edu.pe/img/pjHeader.jpg" height="70" alt="">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Fecha Matricula: {{date("d-m-Y", strtotime($matricula->fecha))}}</td>
            </tr>
        </tbody>
    </table>
    <h2><b>Sistema de Control IDEX "Perú Japón"</b></h2>
    <h2><b>Ficha de Matrícula Semestral ({{ $matricula->tipo }})</b></h2>
</header>
<body>
    <table class="informacion">
        <tbody>
            <tr>
                <td class="filaInformacion"><b>Institución</b></td>
                <td class="filaDatos">IDEX 'Perú Japón'</td>
                <td class="filaInformacion"><b>DRE</b></td>
                <td class="filaDatos">Amazonas</td>
            </tr>
            <tr>
                <td class="filaInformacion"><b>Programa de Estudios</b> </td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->carrera->nombreCarrera}}</td>
                <td class="filaInformacion"><b>Periodo de Clases</b></td>
                <td class="filaDatos">{{$matricula->matricula->nombre}}</td>
            </tr>
            <tr>
                <td class="filaInformacion"><b>Apellidos y Nombres</b> </td>
                <td class="filaDatos"><strong>{{Str::upper($matricula->estudiante->postulante->cliente->apellido)}}</strong>, {{Str::title($matricula->estudiante->postulante->cliente->nombre)}}</td>
                <td class="filaInformacion"><b>DNI</b></td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->cliente->dniRuc}}</td>
            </tr>
            <tr>
                <td class="filaInformacion"><b>Dirección</b> </td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->cliente->direccion}}</td>
                <td class="filaInformacion"><b>Telefono / WhatsApp</b></td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->cliente->telefono}} / {{$matricula->estudiante->postulante->cliente->telefono2}}</td>
            </tr>
            <tr>
                <td class="filaInformacion"><b>Correo</b> </td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->cliente->email}}</td>
                <td class="filaInformacion"><b>N° Boleta</b></td>
                <td class="filaDatos"></td>
            </tr>
            <tr>
                <td class="filaInformacion"><b>Año Ingreso</b> </td>
                <td class="filaDatos">{{$matricula->estudiante->postulante->admisione->nombre}}</td>
                <td class="filaInformacion"><b>Usuario Sistema</b></td>
                <td class="filaDatos">{{$matricula->user->email}}</td>
            </tr>
        </tbody>
    </table>
    <h4>UNIDADES DIDACTICAS REGULARES</h4>
    <table class="tbCuerpo">
        
        <tbody style="border: black 1px solid">
            @php
                $cont=1;
                $horas=0;
                $creditos=0;
            @endphp
            <tr style="font-weight:bold; background:lightgray">
                    <td>N°</td>
                    <td>Ciclo</td>
                    <td>Tipo</td>
                    <td>Unidad Didáctica</td>
                    <td>Horas</td>
                    <td>T. Matrícula</td>
                    <td>Créditos</td>
            </tr>
            @foreach ($matricula->detalles as $detalle)
            @if ($detalle->tipo == 'Regular')
            <tr style="border: black 1px solid">
                <td style="border: black 1px solid">{{$cont}}</td>
                <td style="border: black 1px solid; text-align: center">{{$detalle->unidad->ciclo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->tipo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->nombre}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->horas}}</td>    
                <td style="border: black 1px solid">{{$detalle->tipo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->creditos}}</td>
            </tr>
            @php
                $horas=$horas+$detalle->unidad->horas;
                $creditos=$creditos+$detalle->unidad->creditos;
                $cont++;
            @endphp
            @endif
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td style="text-align: center" colspan="2"><b>Total Horas Semanales: {{$horas}}</b></td>
                <td colspan="2" style="text-align: center"><b>Total Creditos: {{$creditos}}</b></td>
            </tr>
        </tbody>
    </table>
    <h4>UNIDADES DIDACTICAS REPITENCIA</h4>
    <table class="tbCuerpo">
        
        <tbody style="border: black 1px solid">
            @php
                $cont=1;
                $horas=0;
                $creditos=0;
            @endphp
            <tr style="font-weight:bold; background:lightgray">
                    <td>N°</td>
                    <td>Ciclo</td>
                    <td>Tipo</td>
                    <td>Unidad Didáctica</td>
                    <td>Horas</td>
                    <td>T. Matrícula</td>
                    <td>Créditos</td>
            </tr>
            @foreach ($matricula->detalles as $detalle)
            @if ($detalle->tipo == 'Repitencia')
            <tr style="border: black 1px solid">
                <td style="border: black 1px solid">{{$cont}}</td>
                <td style="border: black 1px solid; text-align: center">{{$detalle->unidad->ciclo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->tipo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->nombre}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->horas}}</td>    
                <td style="border: black 1px solid">{{$detalle->tipo}}</td>
                <td style="border: black 1px solid">{{$detalle->unidad->creditos}}</td>
            </tr>
            @php
                $horas=$horas+$detalle->unidad->horas;
                $creditos=$creditos+$detalle->unidad->creditos;
                $cont++;
            @endphp
            @endif
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td style="text-align: center" colspan="2"><b>Total Horas Semanales: {{$horas}}</b></td>
                <td colspan="2" style="text-align: center"><b>Total Creditos: {{$creditos}}</b></td>
            </tr>
        </tbody>
    </table>
    {{-- <h4>UNIDADES DIDACTICAS DE REPITENCIA</h4>
    <table class="tbCuerpo">
        <tbody style="border: black 1px solid">
            @php
                $cont=1;
                $horas=0;
                $creditos=0;
            @endphp
            <tr style="font-weight:bold; background:lightgray">
                    <td>N°</td>
                    <td>Ciclo</td>
                    <td>Unidad Didáctica</td>
                    <td>Tipo</td>
                    <td>Horas</td>
                    <td>T. Matrícula</td>
                    <td>Créditos</td>
            </tr>
            @foreach ($matriculas as $mat)
            @if ($mat->tipoMatricula == 'Repitencia')
            <tr style="border: black 1px solid">
                <td style="border: black 1px solid">{{$cont}}</td>
                <td style="border: black 1px solid; text-align: center">{{$mat->ciclo}}</td>
                <td style="border: black 1px solid">{{$mat->unidadDidactica}}</td>
                <td style="border: black 1px solid">{{$mat->tipoModulo}}</td>
                <td style="border: black 1px solid">{{$mat->horas}}</td>    
                <td style="border: black 1px solid">{{$mat->tipoMatricula}}</td>
                <td style="border: black 1px solid">{{$mat->creditos}}</td>
            </tr>
            @php
                $horas=$horas+$mat->horas;
                $creditos=$creditos+$mat->creditos;
                $cont++;
            @endphp
            @endif
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td style="text-align: center" colspan="2"><b>Total Horas Semanales: {{$horas}}</b></td>
                <td colspan="2" style="text-align: center"><b>Total Creditos: {{$creditos}}</b></td>
            </tr>
        </tbody>
    </table> --}}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%">
        <tbody>
            <tr style="text-align: center">
                <td style="width: 33%">_______________________</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">_____________</td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">SECRETARIA ACADÉMICA</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">ESTUDIANTE</td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">firma post firma y sello</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">firma</td>
            </tr>
        </tbody>
    </table>
</body>
</html>