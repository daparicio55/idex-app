@extends('adminlte::page')
@section('title', 'Periodos Académicos')

@section('content_header')
    <h1>Periodos Académicos
		<a href="{{route('sacademica.pmatriculas.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Periodo
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


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Nombre</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th></th>
                </thead>
                @foreach ($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->nombre }}</td>
                        <td>{{ date('d-m-Y',strtotime($periodo->finicio)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($periodo->ffin)) }}</td>
                        <td style="width: 220px; text-align: center">
                            @if ($periodo->plan_cerrado == false)
                            <a data-toggle="modal" data-target="#modal-plan-{{ $periodo->id }}" class="btn btn-primary" title="cerrar planeacion">
                                <i class="fas fa-lock"></i>
                            </a>
                            @else
                            <a data-toggle="modal" data-target="#modal-plan-{{ $periodo->id }}" class="btn btn-warning text-white" title="abrir planeacion">
                                <i class="fas fa-lock-open"></i>
                            </a> 
                            @endif
                            <a href="{{ route('sacademica.pmatriculas.show',$periodo->id) }}" title="reporte de unidades didacticas" class="btn btn-secondary">
                                <i class="fas fa-clipboard-list"></i>
                            </a>
                            <a class="btn btn-success" title="editar modulo formativo" href="{{ route('sacademica.pmatriculas.edit',$periodo->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" href="" data-target="#modal-delete-{{$periodo->id}}" data-toggle="modal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        @include('sacademica.pmatriculas.plan')
                        @include('sacademica.pmatriculas.modal')
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