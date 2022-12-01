@extends('adminlte::page')
@section('title', 'Cepre')

@section('content_header')
    <h1>Lista de Sumativos Cepres
		<a href="{{route('cepres.sumativos.configuraciones.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Sumativo
		</a>
	</h1>
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
{{-- @include('cepres.estudiantes.search') --}}
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Periodo</th>
                    <th>Nombre</th>
                    <th>Preguntas</th>
                    <th>Correcta</th>
                    <th>Encontra</th>
                </thead>
                @foreach ($sumativos as $sumativo)
                <tr>
                    <td>{{date('d-m-Y',strtotime($sumativo->fecha))}}</td>
                    <td>{{$sumativo->cepre->periodoCepre}}</td>
                    <td>{{$sumativo->nombre}}</td>
                    <td>{{$sumativo->preguntas}}</td>
                    <td>{{$sumativo->puntos}}</td>
                    <td>{{$sumativo->encontra}}</td>
                    <td style="width: 160px">
                        <a href="{{route('cepres.sumativos.configuraciones.show',['configuracione'=>$sumativo->id])}}" class="btn btn-primary" title="cargar alternativas">
                            <i class="far fa-question-circle"></i>
                        </a>
                        <a href="{{route('cepres.sumativos.configuraciones.edit',['configuracione'=>$sumativo->id])}}" class="btn btn-success" title="editar sumativo">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="btn btn-danger" data-target="#modal-delete-{{$sumativo->id}}" data-toggle="modal" title="elminar sumativo">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    @include('cepres.sumativos.configuraciones.modal')
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
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
	</script>
@stop