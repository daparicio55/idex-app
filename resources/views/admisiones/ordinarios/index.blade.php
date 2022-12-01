@extends('adminlte::page')
@section('title', 'Admisiones Exonerados')

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
{!! Form::open(['route'=>'admisiones.ordinarios.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
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
            <h3><strong> Proceso de Admisión IDEX Perú Japón - {{$admision->nombre}}</strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary"><strong>Total alumnos:</strong> {{count($postulantes)}}</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="4">
                        <a data-target="#modal-bonificaciones-{{$admision->id}}" data-toggle="modal" href="" class="btn btn-warning" href="">
                            <i class="fas fa-binoculars fa-2x"> 1. </i> Bonos
                        </a>
                        <a title="cargar el archivo CSV del escaner optico" data-target="#modal-csv-{{$admision->id}}" data-toggle="modal" href="" class="btn btn-primary">
                            <i class="fas fa-file-csv fa-2x"> 2. </i> Subir Fichas
                        </a>
                        <a target="_blank" href="{{route('admisiones.ordinarios.resultados',['id'=>$admision->id])}}" class="btn btn-dark">
                            <i class="far fa-address-book fa-2x"> 3. </i> Resultados
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>Exp.</th>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th>Bono</th>
                    <th>Puntaje</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postulantes as $postulante)
                    <tr>
                        <td>{{ $postulante->expediente }}</td>
                        <td>{{ $postulante->cliente->dniRuc }}</td>
                        <td><strong>{{Str::upper($postulante->cliente->apellido)}}</strong>, {{Str::title($postulante->cliente->nombre)}}</td>
                        <td>{{ $postulante->carrera->nombreCarrera }}</td>
                        <td>
                            <a href="" data-target="#modal-bono-{{ $postulante->id }}" data-toggle="modal"><i class="fas fa-edit"></i></a> {{ $postulante->bonificacion }} 
                        </td>
                        <td>{{ $postulante->puntaje }}</td>
                        <td>{{ $postulante->total }}</td>
                    </tr>
                    @include('admisiones.ordinarios.modal')
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
