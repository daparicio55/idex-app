<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$postulante->cliente->dniRuc}}-ADMISION-{{$postulante->admisione->periodo}}</title>
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
        p{
            line-height : 13px;
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
            width: 35%;
            font-size: 11px;
            background:lightgray;
            text-align: right;
        }
        .filaDatos{
            width: 65%;
            font-size: 11px;
        }
        .tbCuerpo{
            width: 100%;
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
                    <img src="https://intranet.idexperujapon.edu.pe/img/logo.png"  height="70" alt="">
                </td>
                <td class="filaCentrar">&nbsp;</td>
                <td class="filaCentrar">&nbsp;</td>
                <td class="filaCentrar">
                    <img src="https://intranet.idexperujapon.edu.pe/img/pjHeader.jpg" height="70" alt="">
                </td>
            </tr>
        </tbody>
    </table>
    <h4><b>SISTEMA DE GESTION IDEX "Perú Japón"</b></h4>
    <h4><b>CONSTANCIA DE INSCRIPCION</b></h4>
    <h5 style="text-align: center;">Proceso de admision {{$postulante->admisione->periodo}} Exp. {{ $postulante->expediente }}</h5>
    <h5 style="text-align: right;">Fecha: <b>{{date('d-m-Y',strtotime($postulante->fecha))}}</b> Hora: <b>{{$postulante->hora}}</b> de emision | Usuario: {{$postulante->user->email}}</h5>
</header>
<body>
    <table style="width: 100%">
        <tbody>
            <tr>
                <td>
                    <table style="width: 100%">
                        <thead>
                            <th colspan="2" style="text-align: left; background:lightgray;">DATOS PERSONALES:</th>
                        </thead>
                        <tbody>                    
                            <tr>
                                <td class="filaInformacion"><strong>APELLIDOS</strong></td>
                                <td class="filaDatos">{{strtoupper($postulante->cliente->apellido)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>NOMBRES</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->cliente->nombre)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>DNI</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->cliente->dniRuc)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>SEXO</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->sexo)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>DIRECCIÓN</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->cliente->direccion)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>TELEFONOS</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->cliente->telefono)}} - {{strtoupper($postulante->cliente->telefono2)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>CORREO</strong></td>
                                <td class="filaDatos"> {{strtoupper($postulante->cliente->email)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>FECHA NACIMIENTO</strong></td>
                                <td class="filaDatos"> {{date('d-m-Y',strtotime($postulante->fechaNacimiento))}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>DISCAPACIDAD</strong></td>
                                <td class="filaDatos">@if($postulante->discapacidad == 0) SI @else NO @endif {{$postulante->discapacidadNombre}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table style="width: 100%">
                        <thead>
                            <th colspan="2" style="text-align: left; background:lightgray;">DATOS COLEGIO:</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="filaInformacion"><strong>CODIGO</strong></td>
                                <td class="filaDatos">{{$postulante->colegio->COD_MOD}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>COLEGIO NOMBRE</strong></td>
                                <td class="filaDatos">{{$postulante->colegio->CEN_EDU}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>DISTRITO</strong></td>
                                <td class="filaDatos">{{$postulante->colegio->D_DIST}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>PROVINCIA</strong></td>
                                <td class="filaDatos">{{$postulante->colegio->D_PROV}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>DEPARTAMENTO</strong></td>
                                <td class="filaDatos">{{$postulante->colegio->D_DPTO}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table style="width: 100%">
                        <thead>
                            <th colspan="2" style="text-align: left; background:lightgray;">DATOS DE LA INSTITUCION:</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="filaInformacion"><strong>N° BOLETA</strong></td>
                                <td class="filaDatos">{{$postulante->boleta}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>INSTITUCION</strong></td>
                                <td class="filaDatos">PERÚ JAPÓN</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>TIPO DE MODALIDAD</strong></td>
                                <td class="filaDatos">{{strtoupper($postulante->modalidadTipo)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>MODALIDAD</strong></td>
                                <td class="filaDatos">{{strtoupper($postulante->modalidad)}}</td>
                            </tr>
                            <tr>
                                <td class="filaInformacion"><strong>FECHA / HORA EVALUACIÓN</strong></td>
                                @if ($postulante->modalidad == 'Ordinario')
                                    <td class="filaDatos">{{date('d-m-Y',strtotime($postulante->admisione->fecha))}} / {{$postulante->admisione->hora}}</td>
                                @else
                                    <td class="filaDatos">{{date('d-m-Y',strtotime($postulante->admisione->efecha))}} / {{$postulante->admisione->ehora}}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 200px; text-align: center">
                    <img src="{{Storage::url($postulante->url)}}" style="width: 150px" alt="">
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%">
        <thead>
            <th style="background:lightgray;"><h2>PROGRAMA DE ESTUDIO</h2></th>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; text-transform: uppercase;"><h3>{{$postulante->carrera->nombreCarrera}}</h3></td>
            </tr>
        </tbody>
    </table>
    <p>Indicaciones para el proceso de admision:<br>
    1. Presentarse en la sede de aplicación, con 1 hora de anticipación a la hora establecida.<br>
    2. Portar su documento de identificación (DNI) al ingresar al local.<br>
    3. Presentar esta constancia <b>(con foto, sello institucional y firmas del postulante y director (a) de la Institución de Educación Superior).</b></p>
    <p>
    ESTE EL ÚNICO DOCUMENTO QUE LO ACREDITA COMO POSTULANTE CORRECTAMENTE REGISTRADO EN EL SISTEMA DE GESTIÓN Y PERMITE SU ACCESO AL LOCAL PARA RENDIR LAS PRUEBAS.<br>
    Yo Certifico que la información en esta ficha coincide con los datos del documento de identidad del postulante.
    </p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%">
        <tbody>
            <tr style="text-align: center">
                <td style="width: 33%">_______________________</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">_______________________</td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">POSTULANTE</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">OF. ADMISIÓN </td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">firma y huella</td><td style="width: 33%">&nbsp;</td><td style="width: 33%">firma post firma y sello</td>
            </tr>
        </tbody>
    </table>
</body>
</html>