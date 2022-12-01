@extends('adminlte::page')
@section('title', 'Cepre Consolidaciones')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Lista de Cepres IDEX PJ</h1>
@stop
@section('content')
{!! Form::open(['route'=>'cepres.sumativos.consolidados.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('idCepre', 'Periodo de Cepre', [null]) !!}
    {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control','target'=>'_blank']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-hand-pointer"></i> Consolidar Notas
    </button>
</div>
{!! Form::close() !!}
@stop