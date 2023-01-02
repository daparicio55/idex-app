@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de Usuarios
		<a href="{{route('accesos.usuarios.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Usuario
		</a>
	</h1>
@stop

@section('content')
@if (session('token'))
    <div class="alert alert-primary" id='token'>
		<p>Se genero el token correctamente, recuerde que esta es la unica vez que se mostrara, guardelo de forma adecuada: </p>
        <strong>{{session('token')}}</strong>
    </div>
@endif
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
@include('accesos.usuarios.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombres</th>
                    <th>Correo</th>
                    <th>Oficina</th>
				</thead>
				<tbody>
				@foreach ($usuarios as $usuario)
					<tr>
						<td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->oficina->nombre}}</td>
						<td style="width: 160px; text-align: center">
							<a href="{{ route('accesos.usuarios.show',['usuario'=>$usuario->id]) }}" class="btn btn-warning" title="personal token">
								<i class="fas fa-key"></i>
							</a>
							<a title="editar usuario" class="btn btn-info" href="{{route('accesos.usuarios.edit',['usuario'=>$usuario->id])}}">
								<i class="far fa-edit"></i>
							</a>
							<a title="eliminar usuario" href="" data-target="#modal-delete-{{$usuario->id}}" data-toggle="modal"><button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					@include('accesos.usuarios.modal')
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