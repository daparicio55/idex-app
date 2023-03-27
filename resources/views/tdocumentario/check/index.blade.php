<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <title>Trámite Documentario</title>
</head>
<body>
    <div class="container mt-2">
        
        
        <div class="card">
            <img class="card-img-top" src="{{ asset('img/banertramite.webp') }}" alt="Card image cap">
            {!! Form::open(['route'=>'tdocumentario.check.index','method'=>'get','id'=>'demo-form']) !!}
            <div class="card-body">
                <h5 class="card-title">
                    <b>Consulta de expedientes presentados</b>
                </h5>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <i class="far fa-calendar"></i> {!! Form::label('anios', 'Año', [null]) !!}
                        @if(isset($_GET['anios']))
                            {!! Form::select('anios', $anios, $_GET['anios'], ['class'=>'form-control']) !!}
                        @else
                            {!! Form::select('anios', $anios, null, ['class'=>'form-control']) !!}
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <i class="fas fa-id-card"></i> {!! Form::label('dni', 'Número de DNI.', [null]) !!}
                        @if(isset($_GET['dni']))
                            {!! Form::text('dni', $_GET['dni'], ['class'=>'form-control','required']) !!}
                        @else
                            {!! Form::text('dni', null, ['class'=>'form-control','required']) !!}
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <i class="fas fa-hashtag"></i> {!! Form::label('expediente', 'Número de Expediente.', [null]) !!}
                        @if(isset($_GET['expediente']))
                            {!! Form::text('expediente', $_GET['expediente'], ['class'=>'form-control','required']) !!}
                        @else
                            {!! Form::text('expediente', null, ['class'=>'form-control','required']) !!}
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" data-sitekey="6Lej74khAAAAALiUJfJ9CzcZatEnHdJtp6OLUAlP" data-callback='onSubmit' data-action='submit' class="card-link btn btn-primary mt-2 g-recaptcha">
                            <i class="fas fa-search"></i> Consultar
                        </button>
                    </div>
                </div>
                
              {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
            </div>
            {!! Form::close() !!}
            @isset($documento)
                <div class="card-body">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">
                            DETALLE DE EXPEDIENTE - {{ $documento->numero }} - {{ date('d-m-Y',strtotime($documento->fecha)) }}
                            </h5>         
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-danger" style="text-align: center">
                                <b>Infomación</b>
                            </h5>
                            <div class="row">
                                <div class="col-sm-6" style="text-align:right">
                                    <b class="text-right">Asunto:</b>
                                </div>
                                <div class="col-sm-6">
                                    {{ $documento->asunto }}
                                </div>
                                <div class="col-sm-6" style="text-align:right">
                                    <b class="text-right">Folios:</b>
                                </div>
                                <div class="col-sm-6">
                                    {{ $documento->folios }}
                                </div>
                                <div class="col-sm-6" style="text-align:right">
                                    <b class="text-right">Observacion:</b>
                                </div>
                                <div class="col-sm-6">
                                    {{ $documento->observacion }}
                                </div>
                                <div class="col-sm-6" style="text-align:right">
                                    <b class="text-right">Tipo:</b>
                                </div>
                                <div class="col-sm-6">
                                    {{ $documento->tipo->nombre }}
                                </div>
                                <div class="col-sm-6" style="text-align:right">
                                    <b class="text-right">Finalizado:</b>
                                </div>
                                <div class="col-sm-6">
                                    {{ $documento->finalizado }}
                                </div>
                            </div>
                            <h5 class="card-title text-danger mt-2" style="text-align: center">
                                <b>Movimientos</b>
                            </h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>fecha</th>
                                        <th>hora</th>
                                        <th>para</th>
                                        <th>oficina</th>
                                        <th>observación</th>
                                        <th>Folios</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalfolios = $documento->folios;
                                    @endphp
                                    @foreach ($documento->movimientos as $key => $movimiento)
                                        <tr @if($documento->finalizado == "SI") class='text-primary' @else @if($movimiento->revisado == 'NO') class='text-danger' @else class='text-success' @endif @endif>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @isset($movimiento->rfecha)
                                                    {{ date('d-m-Y',strtotime($movimiento->rfecha)) }}
                                                @endisset
                                            </td>
                                            <td>{{ $movimiento->rhora }}</td>
                                            <td>{{ $movimiento->receptor->email }}</td>
                                            <td>{{ $movimiento->receptor->oficina->nombre }}</td>
                                            <td>{{ $movimiento->observacion }}</td>
                                            <td>{{ $movimiento->folios }}</td>
                                        </tr>
                                        @php
                                            $totalfolios = $totalfolios + $movimiento->folios;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: right">
                                            <h4>
                                                total folios: 
                                            </h4>
                                        </td>
                                        <td>
                                            <h4>
                                                {{ $totalfolios }}
                                            </h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endisset
            <div class="card-footer text-center bg-primary text-white">
                <b>
                    SISGE I.E.S.T.P. Perú Japón
                <p>
                    © 2023 - Oficina de Soporte Técnologico - Derechos Reservados
                </p>
                </b>
            </div>
            {{-- <div class="card-body">
              <a href="#" class="card-link btn btn-primary">Card link</a>
            </div> --}}
          </div>
        
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://google.com/recaptcha/api.js"></script>
    <script> 
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        } 
    </script>
</body>
</html>