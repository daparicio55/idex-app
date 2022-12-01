@extends('adminlte::page')
@section('title', 'Roles')
@section('content_header')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Roles
			<a href="{{route('accesos.roles.create')}}">
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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Nombre del ROL</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($roles as $rol)
						<tr>
							<td>{{$rol->name}}</td>
							<td style="width: 220px; text-align: center">
								<a class="btn btn-primary" href="{{route('accesos.roles.edit',['role'=>$rol])}}">
									<i class="fas fa-edit"></i> Editar
								</a>
								<a class="btn btn-danger" href="" data-target="#modal-delete-{{$rol->id}}" data-toggle="modal">
									<i class="fas fa-trash-alt"></i> Eliminar
								</a>
							</td>
						</tr>
						@include('accesos.roles.modal')
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