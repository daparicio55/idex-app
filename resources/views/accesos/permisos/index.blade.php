@extends('adminlte::page')
@section('title', 'Permisos')
@section('content_header')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Permisos
			<a href="{{route('accesos.permisos.create')}}">
				<button class="btn btn-success">
					<i class="fas fa-plus-square"></i> Nuevo
				</button>
			</a>
		</h3>
	</div>
</div>
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
@include('accesos.permisos.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre de la Ruta</th>
						<th>Descripcion de la Ruta</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($permissions as $permission)
						<tr>
							<td>{{$permission->id}}</td>
							<td>{{$permission->name}}</td>
							<td>{{$permission->description}}</td>
							<td style="width: 220px; text-align: center">
								<a class="btn btn-primary" href="{{route('accesos.permisos.edit',['permiso'=>$permission->id])}}">
									<i class="fas fa-edit"></i> Editar
								</a>
								<a class="btn btn-danger" href="" data-target="#modal-delete-{{$permission->id}}" data-toggle="modal">
									<i class="fas fa-trash-alt"></i> Eliminar
								</a>
							</td>
						</tr>
						@include('accesos.permisos.modal')
					@endforeach
					
				</tbody>
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