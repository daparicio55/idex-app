@extends('adminlte::page')

@section('title', 'Consulta Notas')

@section('content_header')
    <h1><i class="fas fa-book text-primary"></i> Consulta de Notas</h1>
@stop

@section('content')
    <p>llena los datos para poder acceder a tus notas.</p>
    {!! Form::open(['route'=>'students.index','method'=>'get','role'=>'seach','id'=>'demo-form']) !!}
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
                {!! Form::label(null, 'Número de DNI', [null]) !!}
                <input type="text" name="dni" class="form-control" required @isset($cliente)
                    value ="{{ $cliente->dniRuc }}"
                @endisset>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <button type="submit" class="g-recaptcha btn btn-primary" data-sitekey="6Lej74khAAAAALiUJfJ9CzcZatEnHdJtp6OLUAlP" data-callback='onSubmit' data-action='submit'>
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    {{-- vamos a enviar el formulario con los datos para enviar el correo  --}}
    <br>
    @isset($cliente)
    <div style="width: 100%" class="alert alert-secondary" role="alert">
        <ul class="list-inline">
            <li>1. Si tus notas no estan registradas puedes pedir la correción por el <i class="fab fa-whatsapp "></i> WhatsApp de <i class="fas fa-headset "></i> Soporte.</li>
            <li>2. Si tienes alguna duda o pregunta puedes contactarde por <i class="fab fa-whatsapp "></i> WhatsApp en el menu <i class="fas fa-headset "></i> Soporte.</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <h5 class="card-header">
                <i class="fas fa-user-alt text-success"></i> Datos Personales
            </h5>
            <div class="card-body">
              <h5 class="card-title">{{  Str::upper($cliente->apellido) }}, {{ Str::title($cliente->nombre) }}</h5>
        </div>
    </div>
    @foreach ($cliente->postulaciones as $postulacion  )
    @isset($postulacion->estudiante)
        
    {{-- carrera --}}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <h5 class="card-header">
                <i class="fas fa-graduation-cap text-danger"></i> Programa de Estudios
            </h5>
            <div class="card-body">
                <h5 class="card-title">
                    {!! Form::open(['route'=>['students.show','student'=>$postulacion->estudiante->id],'method'=>'get']) !!}
                        {{ $postulacion->estudiante->postulante->carrera->nombreCarrera }}
                        <button type="submit" class="btn btn-info" title="imprimir verificación"><i class="fas fa-print"></i></button>
                    {!! Form::close() !!}
                </h5>
                
                <p class="card-text"><small class="text-muted">{{  $postulacion->estudiante->postulante->admisione->nombre }}</small></p>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table style="font-size: 0.9rem" class="table table-striped table-bordered table-condensed table-hover">
                        <tbody>
                            {{-- primer semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE I</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'I')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                            {{-- segundo semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE II</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'II')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                            {{-- tercer semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE III</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'III')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                            {{-- cuarto semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE IV</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'IV')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                            {{-- quinto semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE V</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'V')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                            {{-- sexto semestre --}}
                            <tr>
                                <th colspan="11" style="text-align: center">SEMESTRE VI</th>
                            </tr>
                            <tr>
                                <th>Unidad Didactica</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Nota</th>
                                <th>Observacion</th>
                                <th>Reg.</th>
                                <th>Ext.</th>
                            </tr>
                            @foreach ($postulacion->estudiante->postulante->carrera->modulos as $modulo)
                                   @foreach ($modulo->unidades as $unidad)
                                   @if ($unidad->ciclo == 'VI')
                                    <tr>
                                        <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                        <td>{{ $unidad->creditos }}</td>
                                        <td>{{ $unidad->horas }}</td>
                                        {{-- aca van las notas correspondientes --}}
                                        @php
                                            $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                            $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                            $cont = 0;
                                            $desaprobado = FALSE;
                                        @endphp
                                        @foreach (notas($unidad->id,$postulacion->estudiante->id) as $nota)
                                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                            <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                            @if($nota->nota<13)
                                                @isset($nota->nota)
                                                    @php
                                                        $desaprobado = TRUE;
                                                    @endphp
                                                @endisset
                                            @else
                                                @php
                                                    $desaprobado = FALSE;
                                                @endphp
                                            @endif
                                            @php
                                                $cont++;
                                            @endphp
                                        @endforeach
                                        @for ($i = $cont; $i < 3; $i++)
                                            <td></td>
                                            <td></td>
                                        @endfor
                                        @if($desaprobado == TRUE)
                                            <td style="text-align: right">S/ {{ number_format($reg,2) }}</td>
                                            <td style="text-align: right">S/ {{ number_format($ext,2) }}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        @php
                                            $desaprobado = FALSE;
                                        @endphp
                                    </tr>
                                   @endif
                                   @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @endforeach
    @endisset
@stop
@section('js')
    <script> 
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    } 
    </script>
@stop