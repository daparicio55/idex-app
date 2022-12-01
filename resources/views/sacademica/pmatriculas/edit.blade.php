@extends('adminlte::page')

@section('title', 'Periodo Académico')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Editar Periodo Académico</h1>
@stop
@section('content')
{!! Form::model($periodo, ['id'=>'frm','method'=>'put','autocomplete'=>'off','route'=>['sacademica.pmatriculas.update',$periodo->id]]) !!}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('nombre', 'Nombre del Periodo', [null]) !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('finicio', 'F Inicio', [null]) !!}
                    {!! Form::date('finicio', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('ffin', 'F Fin', [null]) !!}
                    {!! Form::date('ffin', null, ['class'=>'form-control','required']) !!}
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
        <a class="btn btn-danger" href="{{route('sacademica.pmatriculas.index')}}">
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