@extends('adminlte::page')
@section('title', 'Admisiones Estudiantes')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Seleccione el Periodo de Admisión</h1>
@stop
@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
{!! Form::open(['route'=>'admisiones.estudiantes.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Admisión', [null]) !!}
    {!! Form::select('id', $admisiones, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@if (isset($admision))

    {{-- voy a mostrar todos los aluimnos que tengo en exonerados para este periodo --}}
    <div class="card border-success">
        <div class="card-header text-center">
            <h3><strong> Proceso de Admisión IDEX Perú Japón - {{$admision->nombre}}</strong></h3>
        </div>
        <div class="card-body">
        {{-- <p class="text-right text-primary"><strong>Total alumnos:</strong> </p> --}}
        
        @foreach ($carreras as $carrera)
        @php
            $contador = 1;
        @endphp
        <div class="card border-success">
            <div class="card-header text-center">
                <h5><strong> {{ $carrera->nombreCarrera }}</strong></h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>DNI</th>
                        <th>APELLIDOS, Nombres</th>
                        <th>Modalidad</th>
                        <th style="text-align: center">Estu.</th>
                    </thead>
                    <tbody>
                        @foreach ($pOrdinarios as $ordinario)
                            @if ($contador > vacantes($admision->id,$carrera->idCarrera))
                                @php
                                    break;
                                @endphp
                            @endif
                            @if ($ordinario->idCarrera == $carrera->idCarrera)
                                <tr>
                                    {{-- {!! Form::hidden('postulante_id[]',$ordinario->id, [null]) !!} --}}
                                    <td>{{ $contador }}</td>
                                    <td>{{ $ordinario->cliente->dniRuc }}</td>
                                    <td><strong>{{Str::upper($ordinario->cliente->apellido)}}</strong>, {{Str::title($ordinario->cliente->nombre)}}</td>
                                    <td>{{ $ordinario->modalidadTipo }}</td>
                                    <td style="text-align: center;with 30px">
                                        @if (existeEstudiante($ordinario->id) == 'SI')
                                            <a data-target="#modal-deleteo-{{$ordinario->id}}" data-toggle="modal" href="" class="btn btn-primary">
                                                {{ existeEstudiante($ordinario->id) }}
                                            </a>
                                        @else
                                            <a data-target="#modal-deleteo-{{$ordinario->id}}" data-toggle="modal" href="" class="btn btn-danger">
                                                {{ existeEstudiante($ordinario->id) }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $contador ++;
                                @endphp
                                @include('admisiones.estudiantes.modal1')
                            @endif
                        @endforeach
                        @foreach ($pExonerados as $exonerado)
                            @if ($exonerado->idCarrera == $carrera->idCarrera)
                                <tr>
                                    {{-- {!! Form::hidden('postulante_id[]',$exonerado->id, [null]) !!} --}}
                                    <td>{{ $contador }}</td>
                                    <td>{{ $exonerado->cliente->dniRuc }}</td>
                                    <td><strong>{{Str::upper($exonerado->cliente->apellido)}}</strong>, {{Str::title($exonerado->cliente->nombre)}}</td>
                                    <td>{{ $exonerado->modalidadTipo }}</td>
                                    <td style="text-align: center;with 30px">
                                        @if (existeEstudiante($exonerado->id) == 'SI')
                                            <a data-target="#modal-deletee-{{$exonerado->id}}" data-toggle="modal"  class="btn btn-primary">
                                                {{ existeEstudiante($exonerado->id) }}
                                            </a>
                                        @else
                                            <a data-target="#modal-deletee-{{$exonerado->id}}" data-toggle="modal"  class="btn btn-danger">
                                                {{ existeEstudiante($exonerado->id) }}
                                            </a>
                                        @endif
                                    </td>
                                    @include('admisiones.estudiantes.modal2')
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
        @endforeach
        
        </div>
{!! Form::open(['method'=>'post','route'=>'admisiones.estudiantes.store']) !!}
    @foreach ($carreras as $carrera)
        @php
            $contador = 1;
        @endphp
        @foreach ($pOrdinarios as $ordinario)
        @if ($contador > vacantes($admision->id,$carrera->idCarrera))
            @php
                break;
            @endphp
        @endif
        @if ($ordinario->idCarrera == $carrera->idCarrera)
                {!! Form::hidden('postulante_id[]',$ordinario->id, [null]) !!}
            @php
                $contador ++;
            @endphp
        @endif
        @endforeach
    @endforeach
    @foreach ($pExonerados as $exonerado)
        {!! Form::hidden('postulante_id[]',$exonerado->id, [null]) !!}
    @endforeach
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Registrar todos como estudiantes
            </button>
        </div>
    </div>
{!! Form::close() !!}
@endif
@stop
@section('js')
    <script>
	$(document).ready(function(){
    setTimeout(() => {
        $("#info").hide();
    }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    });
    $('#frm_modal').submit(function(event){
        $("#btn_subir").attr("disabled",true);
    });
	</script>
@stop