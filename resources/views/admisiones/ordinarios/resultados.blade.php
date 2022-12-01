<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados Exámen de Admisión {{$admisione->nombre}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <hr>
    {{-- carrera de arquitecturas de la informacion --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Arquitectura de Plataformas y Servicios de Tecnologías de la Información</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Arquitectura de Plataformas y Servicios de Tecnologías de la Información')
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- asistencia administrativa --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Asistencia Administrativa</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Asistencia Administrativa')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- electronica industrial --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Electrónica Industrial</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Electrónica Industrial')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- enfermeria tecnica --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Enfermería Técnica</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Enfermería Técnica')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- laboratirio clinico --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>ELaboratorio Clínico y Anatomía Patológica</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Laboratorio Clínico y Anatomía Patológica')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- mecanicatronica automotriz --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Mecatrónica Automotriz</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Mecatrónica Automotriz')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    {{-- produccion agropecuaria --}}
    <div class="card">
        <img src="https://sisge.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Producción Agropecuaria</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">IDEX Perú Japón {{$admisione->nombre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>}
                    <th>EXP</th>
                    <th>Apellidos y Nombres</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                <tbody>
                    @foreach ($resultados as $resultado)
                        @if ($resultado->carrera->nombreCarrera == 'Producción Agropecuaria')
                        <tr>
                            <td>{{$contador}}</td>
                            <td>{{ $resultado->expediente }}</td>
                            <td><strong>{{Str::upper($resultado->cliente->apellido)}}</strong>, <span>{{Str::title($resultado->cliente->nombre)}}</span></td>
                            <td>{{$resultado->total}}</td>
                            <td>
                                @if ($contador <= vacantes($admisione->id,$resultado->carrera->idCarrera))
                                <b>ingresó</b>
                                @else
                                no ingresó
                                @endif
                            </td>
                        </tr>
                        @php
                            $contador ++;
                        @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>