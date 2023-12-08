<!DOCTYPE html>
<html>
<head>
    <title>Sistema IDEX Perú Japón</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
</head>
<body>
    <div class="container" style="padding-right: 15%; padding-left: 15%">
        
        <div class="row justify-content-md-center mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                <div style="text-align: center">
                    <h4 class="mt-5"><b>EL DIRECTOR GENERAL DEL INSTITUTO DE EDUCACIÓN SUPERIOR TECNOLÓGICO PÚBLICO "PERÚ JAPÓN" DE CHACHAPOYAS</b></h4>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <div style="text-align: left">
                    <h6>OTORGA LA PRESENTE:</h6>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                <div style="text-align: center">
                    <b><h2>CONSTANCIA DE PRÁCTICA PRE PROFESIONAL</h2></b>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="text-align: center">
                    <b><h3>A: {{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::upper($estudiante->postulante->cliente->nombre) }}</h3></b>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                <p style="font-size: 1.3rem" class="text-justify">
                    Del programa de estudios de <b style="text-decoration: underline" class="text-uppercase">{{ $estudiante->postulante->carrera->nombreCarrera }}</b>
                    quien ha cumplido con realizar y presentar su informe, fichas de evaluacion y demás documentos de sus prácticas pre profesional que corresponden a los siguientes módulos:
                </p>
            </div>
            
            @php
                $suma = 0;
                $contador = 0;
                $nota = 0;
                $promedio = 0;
            @endphp
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @foreach ($estudiante->practicas as $practica)
                    <p style="font-size: 1.3rem">
                        <b>{{ $practica->modulo->nombre }}</b>
                        <small class="d-block">del {{ date('d-m-Y',strtotime($practica->finicio)) }} al {{ date('d-m-Y',strtotime($practica->ffin)) }}</small>
                    </p>
                    @php
                        $nota = ($practica->calificacionDocente + $practica->calificacionEmpresa)/2;
                        $suma = $suma + $nota;
                        $contador ++;
                    @endphp
                @endforeach
            </div>
            @php
                $promedio = round($suma / $contador,0);
            @endphp
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p>
                    Obteniendo un promedio final de <strong> {{ Rmunate\Utilities\SpellNumber::integer($promedio)->toLetters() }} ({{ $promedio }})</strong> , 
                    con registro de fecha {{ __(Carbon\Carbon::parse($practica->fpresentacion)->format('l')) }} {{ date('j',strtotime($practica->fpresentacion)) }} de
                    {{ __(date('F',strtotime($practica->fpresentacion))) }} del {{ date('Y',strtotime($practica->fpresentacion)) }}
                </p>
                <p>
                    Se otorga la presente a solicitud del interesado para los fines que crea por conveniente.
                </p>
                <p style="text-align: right">
                    @php
                        $now = Carbon\Carbon::now()->format('l, j F Y');
                    @endphp
                    {{ __(Carbon\Carbon::parse($now)->format('l')) }} {{ date('j',strtotime($now)) }} de
                    {{ __(date('F',strtotime($now))) }} del {{ date('Y',strtotime($now)) }}
                </p>
            </div>
        </div>
    </div>
</body>
</html>