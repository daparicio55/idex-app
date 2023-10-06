<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $practica->estudiante->postulante->cliente->dniRuc }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
</head>
<body>
    <div class="container">
        {{-- encabezado --}}
        <div class="row">
            <div class="col-sm-4">
                <img src="https://intranet.idexperujapon.edu.pe/img/pjHeader.jpg" style="width: 260px" alt="Este es el ejemplo de un texto alternativo">
            </div>
            <div class="col-sm-8 text-right">
                <div class="pt-4">
                    <p class="m-0">{{ $practica->estudiante->postulante->carrera->itinerario->nombre }}</p>
                    <b>{{ $practica->estudiante->postulante->admisione->periodo }}</b>
                </div>
            </div>
            <div class="col-sm-12 mt-1">
                <h3 class="text-center">FICHA DE SEGUIMIENTO DE LAS EXPERIENCIAS FORMATIVAS EN SITUACIONES REALES DE TRABAJO DE LOS MODULOS FORMATIVOS</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h5><strong>I. DATOS GENERALES:</strong></h5>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>NOMBRES Y APELLIDO</b>
            </div>
            <div class="col-md-7">
                {{ Str::upper($practica->estudiante->postulante->cliente->apellido) }}, {{ Str::title($practica->estudiante->postulante->cliente->nombre) }}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>DNI</b>
            </div>
            <div class="col-md-7">
                {{ Str::upper($practica->estudiante->postulante->cliente->dniRuc) }}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>CARRERA PROFESIONAL</b>
            </div>
            <div class="col-md-7">
                {{ $practica->estudiante->postulante->carrera->nombreCarrera }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <h5><strong>II. MÓDULO PROFESIONAL:</strong></h5>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>DENOMINACION DEL MODULO</b>
            </div>
            <div class="col-md-7">
                {{ $practica->modulo->nombre }}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>INSTITUCIÓN DONDE REALIZO LA PRÁCTICA</b>
            </div>
            <div class="col-md-7">
                {{ $practica->empresa->razonSocial }}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>FECHA DE PRESENTACION DEL INFORME</b>
            </div>
            <div class="col-md-7">
                {{ date('d-m-Y',strtotime($practica->fpresentacion))  }} <b>EXPEDIENTE: </b> {{$practica->expediente}}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>ADJUNTA</b>
            </div>
            <div class="col-md-7">
                Informe, Ficha, Constancia.
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>DURACIÓN DE LA PRÁCTICA</b>
            </div>
            <div class="col-md-7">
                <b>DEL</b> {{ date('d-m-Y',strtotime($practica->finicio)) }} <b>AL</b> {{ date('d-m-Y',strtotime($practica->ffin)) }} <b>CON</b> {{ $practica->horas }} <b>HORAS</b> 
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>CALIFICACIÓN DEL CENTRO DE PRÁCTICA</b>
            </div>
            <div class="col-md-7">
                {{$practica->calificacionEmpresa}}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>CALIFICACIÓN DEL INFORME DEL MÓDULO</b>
            </div>
            <div class="col-md-7">
                {{$practica->calificacionDocente}}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>PROMEDIO DEL MÓDULO</b>
            </div>
            <div class="col-md-7">
                {{number_format(($practica->calificacionEmpresa + $practica->calificacionDocente)/2,2)}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <h5><strong>III. CAPACIDADES LOGRADAS:</strong></h5>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                <table class="table table-condensed">
                <thead class="thead-dark">
                    <tr>
                        <th>N</th>
                        <th>Capacidad</th>
                        <th>CUMPLE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($practica->modulo->abilitys as $key=>$ability)
                    <tr>
                        <td class="p-0 text-center">{{ $key+1 }}</td>
                        <td class="p-0">{{ $ability->nombre }}</td>
                        <td class="p-0 text-center">SI</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>OBSERVACION</b>
            </div>
            <div class="col-md-7">
                {{ $practica->observacion }}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <b>SUPERVISOR</b>
            </div>
            <div class="col-md-7">
                {{ $practica->user->name }}
            </div>
        </div>
    </div>
</body>
</html>