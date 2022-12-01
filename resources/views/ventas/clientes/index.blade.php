@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
    <h1>Lista de Clientes
		<a href="{{route('ventas.clientes.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Cliente
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
		@include('ventas.clientes.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>DNI/RUC</th>
					<th>Nombres</th>
					<th>direccion</th>
					<th>email</th>
					<th>telefono</th>
				</thead>
				<tbody>
				@foreach ($clientes as $cli)
					<tr>
						<td>{{ $cli->dniRuc}}</td>
						<td>{{ $cli->nombre.' '.$cli->apellido}}</td>
						<td>{{ $cli->direccion}}</td>
						<td>{{ $cli->email}}</td>
						<td>{{ $cli->telefono}}</td> 
						<td style="width: 115px; text-align: center">
							<a title="editar datos del cliente" class="btn btn-info" href="{{route('ventas.clientes.edit',['cliente'=>$cli->idCliente])}}">
								<i class="far fa-edit"></i>
							</a>
							<a title="eliminar datos del cliente" href="" data-target="#modal-delete-{{$cli->idCliente}}" data-toggle="modal"><button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					@include('ventas.clientes.modal')
				@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							{{$clientes->links()}}
						</td>
					</tr>
				</tfoot>
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