@extends('adminlte::page')
@section('title', 'Estudios Realizados')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Estudios Profesionales Realizados
            <a class="btn btn-primary" href="{{ route('docentes.cv.estudios.create') }}">
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
                    <th>Titulo</th>
                    <th>Institucion</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                </thead>
                <tbody>
                    @foreach ($personal->estudios->sortByDesc('esAnioInicio') as $estudio)
                    <tr>
                        <td>{{$estudio->esTitulo}}</td>
                        <td>{{$estudio->esInstitucion}}</td>
                        <td>{{$estudio->esAnioInicio}}</td>
                        <td>{{$estudio->esAnioFin}}</td>
                        <td style="text-align: center; width: 160px">
                            <a class="btn btn-info" href="{{ route('docentes.cv.estudios.show',$estudio->id) }}">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{ route('docentes.cv.estudios.edit',$estudio->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" data-target="#modal-delete-{{$estudio->id}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @include('docentes.cv.estudios.modal')
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