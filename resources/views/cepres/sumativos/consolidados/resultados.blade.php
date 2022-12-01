<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados Cepre {{$cepre->periodoCepre}}</title>
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
    {{-- carrera de arquitecturas de la informacion --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Arquitectura de Plataformas y Servicios de Tecnologías de la Información</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Arquitectura de Plataformas y Servicios de Tecnologías de la Información')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- carrera de asistencia administrativa --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Asistencia Administrativa</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Asistencia Administrativa')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- carrera de electronica industrial --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Electrónica Industrial</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Electrónica Industrial')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- carrera de enfermeria tecnica --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Enfermería Técnica</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Enfermería Técnica')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- siguiente carera --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Laboratorio Clínico y Anatomía Patológica</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Laboratorio Clínico y Anatomía Patológica')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- carrera mecanica automotriz --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Mecatrónica Automotriz</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Mecatrónica Automotriz')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
    <hr>
    {{-- carrera produccion agropecuaria --}}
    <div class="card">
        <img src="https://intranet.idexperujapon.edu.pe/img/pjHeaderLargo.jpg" class="card-img-top" alt="...">
        <div class="card-header text-center">
            <h3><strong>Producción Agropecuaria</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary">{Cepre IDEX Perú Japón {{$cepre->periodoCepre}} - <b>RESULTADO FINAL</b></p>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Apellidos y Nombres</th>
                    <th>1er Sumativo</th>
                    <th>2do Sumativo</th>
                    <th>Puntos</th>
                    <th>Condición</th>
                </thead>
                @php
                    $contador = 1;
                @endphp
                @foreach ($resultados as $resultado)
                    @if ($resultado->carrera == 'Producción Agropecuaria')
                    <tr>
                        <td>{{$contador}}</td>
                        <td><strong>{{Str::upper($resultado->apellido)}}</strong>, <span>{{Str::title($resultado->nombre)}}</span></td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[0] }}</td>
                        <td>{{ sumativo($resultado->dni,$cepre->idCepre)[1] }}</td>
                        <td>{{$resultado->puntaje}}</td>
                        <td>
                            @if ($contador == 1 || $contador == 2)
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
            </table>
        </div>
    </div>
</body>
</html>