@extends('adminlte::page')

@section('title', 'It.Formativos')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Editar Itineario Formativo</h1>
@stop
@section('content')
{!! Form::model($itinerario, ['id'=>'frm','method'=>'put','autocomplete'=>'off','route'=>['sacademica.iformativos.update',$itinerario->id]]) !!}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::label('nombre', 'Nombre del Itinerario', [null]) !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('creditos', 'Creditos', [null]) !!}
                    {!! Form::number('creditos', null, ['class'=>'form-control','step'=>0.1,'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
        <a class="btn btn-danger" href="{{route('sacademica.iformativos.index')}}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    </script>
@stop