@extends('adminlte::page')
@section('title', 'Experiencias laborales')
@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Lista de Experiencias Laborales (Trabajos)
            <a class="btn btn-primary" href="{{ route('docentes.cv.experiencias.create')}}">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                Registrar Nuevo
            </a>
            <a class="btn btn-danger" href="{{ route('docentes.cvs.index') }}">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Regresar
            </a>
        </h3>
        <p>registre la formacion iniciando de la mas reciente a la mas antigua</p>
	</div>
</div>
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
{{-- tabla --}}
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Empresa / Institucion</th>
                    <th>Cargo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                </thead>
                <tbody>
                    @foreach ($personal->experiencias->sortByDesc('exFechaInicio') as $experiencia)
                    <tr>
                        <td>{{ $experiencia->exEmpresa }}</td>
                        <td>{{ $experiencia->exCargo }}</td>
                        <td>{{date('d-m-Y',strtotime($experiencia->exFechaInicio))}}</td>
                        <td>{{date('d-m-Y',strtotime($experiencia->exFechaFin))}}</td>
                        <td style="text-align: center; width: 160px">
                            <a class="btn btn-info" href="{{ route('docentes.cv.experiencias.show',$experiencia->id) }}">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{ route('docentes.cv.experiencias.edit',$experiencia->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" data-target="#modal-delete-{{$experiencia->id}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @include('docentes.cv.experiencias.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- fin tabla --}}
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
    })
</script>
@stop