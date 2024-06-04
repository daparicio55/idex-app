<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
    @media all {
        div.saltopagina{
            display: none;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 1px;
            //aqui el resto de tus estilos
        }
        .vertical-text {
            writing-mode: vertical-rl; /* Establece la orientación vertical */
            transform: rotate(180deg); /* Rota el texto para que esté en posición vertical */
            white-space: nowrap;
        }
        .table th{
            padding: 0;
        }
    }
    @media print{
        body {
            margin-bottom: 0; /* Restaura el margen a cero al imprimir */
        }
        div.saltopagina{
            display:block;
            page-break-before:always;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            //aqui el resto de tus estilos
        }
        #tasistencia {
            font-size: 0.6rem;
        }
        #tactafinal {
            font-size: 0.5rem;
        }
        #htactafinal{
            font-size: 0.6rem;
        }
        #tresumen{
            font-size: 0.6rem;
        }
        #tregistro{
            font-size: 0.6rem;
        }
        #tregistro{
            font-size: 0.6rem;
        }
        .vertical-text {
            writing-mode: vertical-rl; /* Establece la orientación vertical */
            transform: rotate(180deg); /* Rota el texto para que esté en posición vertical */
            white-space: nowrap;
        }
        .table th{
            padding: 0;
        }
        .table td{
            padding: 0;
            text-align: center;
        }
    }
    </style>
    <title>@yield('titulo')</title>
</head>
<body style="background-color: white">
    <header>
        <div class="container p-0">
            <div class="row">
                <div class="col-sm-12 mt-3 text-center">
                    <h6>FAMILIA TECNOLÓGICA: "LA UNIDAD ES LA MEDALLA QUE NOS DISTINGUE"</h6>
                </div>
                <div class="col-sm-12 d-flex justify-content-between mt-3">
                    <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px" alt="a">
                    <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png" width="150px" alt="b">
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <h5><b> INSTITUTO SUPERIOR TECNOLÓGICO PÚBLICO "PERÚ JAPÓN"</b></h5>
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <label for="" class="h1 p-5 border border-primary border-2">REGISTRO DE EVALUACIÓN</label>
                </div>
                <span class="text-center h4">@yield('tipo')</span>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 mx-auto mt-3">
                    <p class="mb-0 h4">Programa de Estudios:</p>
                    <p class="h5">@yield('programa')</p>
                    <p class="mb-0 h4">Módulo:</p>
                    <p class="h5">@yield('modulo')</p>
                </div>
                <div class="col-sm-10 text-center mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>UNIDAD DIDÁCTICA</h4>
                        </div>
                        <div class="card-body">
                            <h4 class="text-black text-bold">
                                <b>
                                    @yield('udidactica')
                                </b>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 mx-auto mt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-0">Periodo Académico</td>
                                <td class="p-0">@yield('periodo')</td>
                            </tr>
                            <tr>
                                <td class="p-0">Ciclo Académico</td>
                                <td class="p-0">@yield('ciclo')</td>
                            </tr>
                            <tr>
                                <td class="p-0">Créditos</td>
                                <td class="p-0">@yield('creditos')</td>
                            </tr>
                            <tr>
                                <td class="p-0">Horas Semanales</td>
                                <td class="p-0">@yield('horas')</td>
                            </tr>
                            <tr>
                                <td class="p-0">Docente</td>
                                <td class="p-0">@yield('docente')</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<div class="saltopagina"></div>

    @include('layouts.registros.header')
    <main>
        <table class="table" id="tregistro">
            <thead>
                <tr class="p-0">
                    <th class="p-0 text-center border border-1">#</th>
                    <th class="p-0 border border-1">DNI</th>
                    <th class="p-0 border border-1">Apellidos y Nombres</th>
                    <th class="p-0 border border-1">Ingreso</th>
                </tr>
            </thead>
            <tbody>
                @yield('alumnos')
            </tbody>
        </table>
    </main>

<div class="saltopagina"></div>
    @include('layouts.registros.header')
    <main>
        <table class="table" id="tasistencia">
            <thead>
                <tr>
                    @yield('fechas_asistencia')
                </tr>
            </thead>
            <tbody>
                    @yield('asistencias')
            </tbody>
        </table>
    </main>
<div class="saltopagina"></div>
    @include('layouts.registros.header')
    <main>
        <table class="table" id="tregistro">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 50px" class="p-0 text-center border">#</th>
                    @yield('notas_header_capacidades')
                </tr>
                <tr>
                    @yield('notas_header_indicadores')
                </tr>
            </thead>
            <tbody>
                @yield('notas_cuerpo')
            </tbody>
        </table>
    </main>

<div class="saltopagina"></div>
<!-- Resumen de Notas -->

    @include('layouts.registros.header')
    <main>
        <table class="table" id="tresumen">
            <thead>
                <tr>
                    <th style="width: 50px" class="p-0 text-center border">#</th>
                    <th class="p-0 border">DNI</th>
                    <th class="p-0 border">APELLIDOS y Nombres</th>
                    @yield('resumen_header_capacidades')
                    <th class="p-0 text-center border">NOTA FINAL</th>
                </tr>
            </thead>
            <tbody>
                @yield('resumen_cuerpo_notas')
            </tbody>
        </table>
    </main>

<div class="saltopagina"></div>
<!-- ACTA FINAL -->

    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt-3 text-center">
                    <h6>FAMILIA TECNOLÓGICA: "LA UNIDAD ES LA MEDALLA QUE NOS DISTINGUE"</h6>
                </div>
                <div class="col-sm-12 d-flex justify-content-between mt-3">
                    <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px" alt="a">
                    <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png" width="150px" alt="b">
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <h5 class="p-0">ACTA DE EVALUACIÓN FINAL DE LA UNIDAD DIDÁCTICA</h5>
                    <h6 class="p-0"><b> INSTITUTO SUPERIOR TECNOLÓGICO PÚBLICO "PERÚ JAPÓN"</b></h6>
                </div>
            </div>
        </div>
    </header>
    <main>
        <table class="table" id="htactafinal">
            <tbody>
                <tr>
                    <td class="p-0 border"><b>Programa de Estudios</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_carrera')</td>
                    <td class="p-0 border"><b>Sección</b></td>
                    <td class="pl-2 pb-0 pt-0 border">Única</td>
                </tr>
                <tr>
                    <td class="p-0 border"><b>Módulo</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_modulo')</td>
                    <td class="p-0 border"><b>Turno</b></td>
                    <td class="pl-2 pb-0 pt-0 border">Diurno</td>
                </tr>
                <tr>
                    <td class="p-0 border"><b>Unidad Didáctica</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_unidad')</td>
                    <td class="p-0 border"><b>Semestre</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_ciclo')</td>
                </tr>
                <tr>
                    <td class="p-0 border"><b>Docente</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_docente')</td>
                    <td class="p-0 border"><b>Fecha</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_fecha')</td>
                </tr>
                <tr>
                    <td class="p-0 border"><b>Evaluacion</b></td>
                    <td class="pl-2 pb-0 pt-0 border">Semestral</td>
                    <td class="p-0 border"><b>Créditos</b></td>
                    <td class="pl-2 pb-0 pt-0 border">@yield('acta_creditos')</td>
                </tr>
            </tbody>
        </table>
        <table class="table" id="tactafinal">
            <thead>
                <tr>
                    <td class="p-0 border text-center" rowspan="3">N°</td>
                    <td class="p-0 border text-center" rowspan="3">DNI</td>
                    <td class="p-0 border text-center" rowspan="3">APELLIDOS Y NOMBRES</td>
                    <td class="p-0 border text-center" rowspan="3">INGRESO</td>
                    <td class="p-0 border text-center" colspan="3">Evaluación FINAL</td>
                </tr>
                <tr>
                    <td class="p-0 border text-center" colspan="2">Logro Final</td>
                    <td class="p-0 border text-center" rowspan="2">PUNTAJE</td>
                </tr>
                <tr>
                    <td class="p-0 border text-center">números</td>
                    <td class="p-0 border text-center">letras</td>
                </tr>
            </thead>
            <tbody>
                @yield('acta_notas')
            </tbody>
        </table>
    </main>

</body>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex">
                <p class="p-0 m-0 text-center d-block mx-auto border border-secondary border-2 border-end-0 border-start-0 border-bottom-0">
                    Firma del docente
                </p>
            </div>
        </div>
    </div>
</footer>
</html>