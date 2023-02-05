@extends('adminlte::page')
@section('title', 'Cepre Calificaciones')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Estudiantes con pago completo para el exámen</h1>
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
{!! Form::open(['route'=>'cepres.sumativos.calificaciones.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Cepre', [null]) !!}
    {!! Form::select('id', $sumativos, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@if(isset($estudiantes))
    <div class="card border-success">
        <div class="card-header text-center">
            <h3><strong> Cepre IDEX Perú Japón - {{$sumativo->nombre}}</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary"><strong>Total alumnos:</strong> {{count($estudiantes)}}</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="4">
                        <a title="normalizar incluye a los estudiantes que tienen el pago completo" class="btn btn-success" href="{{route('cepres.sumativos.calificaciones.normalizar',['id'=>$sumativo->id])}}">
                            <i class="fas fa-gavel fa-2x"></i> Normalizar
                        </a>
                        <a href="{{ route('cepres.sumativos.calificaciones.descargar',$sumativo->cepre_id) }}" class="btn btn-warning">
                            <i class="fas fa-file-excel fa-2x"></i> Descargar Excel
                        </a>
                        <a title="cargar el archivo CSV del escaner optico" data-target="#modal-csv-{{$sumativo->id}}" data-toggle="modal" href="" class="btn btn-primary">
                            <i class="fas fa-file-csv fa-2x"></i> Subir Fichas
                        </a>
                        <a target="_blank" href="{{route('cepres.sumativos.calificaciones.resultados',['id'=>$sumativo->id])}}" class="btn btn-dark">
                            <i class="far fa-address-book fa-2x"></i> Resultados
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th>Sumativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr @if(ceprePorPagar($estudiante->idCepreEstudiante) == 0) style="color : green" @else style="color : red"  @endif>
                        <td>{{$estudiante->cliente->dniRuc}}</td>
                        <td><strong>{{Str::upper($estudiante->cliente->apellido)}}</strong>, {{Str::title($estudiante->cliente->nombre)}}</td>
                        <td>{{$estudiante->carrera->nombreCarrera}}</td>
                        <td>
                            @if($estudiante->sumatorio == 'SI') 
                                <a href="" data-target="#modal-sumatorio-{{$estudiante->idCepreEstudiante}}" data-toggle="modal" class="btn btn-danger">
                                    <i class="fas fa-ban"></i> Excluir
                                </a>
                            @else
                                <a href="" data-target="#modal-sumatorio-{{$estudiante->idCepreEstudiante}}" data-toggle="modal" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Incluir</a>
                            @endif
                        </td>
                    </tr>
                    @include('cepres.sumativos.calificaciones.modal')
                @endforeach
            </tbody>
          </table>
        
        </div>
        <div class="card-footer text-muted">
            Reporte Sistema SISGE-PJ
        </div>
    </div>
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