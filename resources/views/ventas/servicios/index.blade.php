@extends('adminlte::page')
@section('title', 'Servicios')

@section('content_header')
    <h1>Lista de Servicios
		<a href="{{route('ventas.servicios.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Servicio
		</a>
	</h1>
@stop

@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('ventas.servicios.search')
	</div>
</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Descripcion de Servicio</th>
						<th>Precio</th>
						<th>Días</th>
					</thead>
					<tbody>
						@foreach ($servicios as $ser)
						<tr>
							<td>{{ $ser->nombre}}</td>
							<td>{{ $ser->precio}}</td>
							<td>{{ $ser->dias}}</td>
							<td style="width: 220px; text-align: center">
								<a class="btn btn-info" href="{{ route('ventas.servicios.edit', ['servicio'=>$ser->idServicio]) }}">
									<i class="far fa-edit"></i> Editar
								</a>
								<a class="btn btn-danger" href="" data-target="#modal-delete-{{$ser->idServicio}}" data-toggle="modal">
									<i class="fas fa-trash-alt"></i> Eliminar
								</a>
							</td>
						</tr>
					@include('ventas.servicios.modal')
					@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								{{$servicios->links()}}
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@stop
