@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Ventas registradas</h1>
	<div class="d-block mt-2">
		<a href="{{ route('ventas.ventas.create') }}" class="btn btn-success">
			<i class="fas fa-dollar-sign"></i> Nueva venta
		</a>
		@can('ventas.ventas.anular')
			<a data-target="#modal-anular-1" data-toggle="modal">
				<button class="btn btn-danger">
					<i class="fas fa-minus-circle" aria-hidden="true"></i> Anular
				</button>
			</a>
		@endcan
	</div>	
	@include('ventas.ventas.anular')
	<x-Alert />
@stop

@section('content')
	@include('ventas.ventas.search')
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>Comprob</th>
						<th>T. Pago</th>
						<th class="text-center">Num</th>
						<th>Fecha</th>
						<th>DNI | Nombre Cliente</th>
						<th class="text-right">Monto</th>
						<th>Est.</th>
					</thead>
					<tbody>
						@foreach ($ventas as $venta)
							<tr @if ($venta->estado == 'anulado')
								class="text-danger"
							@endif>
								<td>{{ $venta->tipo }}</td>
								<td>{{ $venta->tipoPago }}</td>
								<td class="text-center">
									{{ $venta->numero }}
									@can('ventas.ventas.edit')
										<a class="btn btn-sm btn-warning" data-target="#modal-editar-{{ $venta->idVenta }}" data-toggle="modal" title="editar numero de boleta">
											<i class="fas fa-pen"></i>
										</a>	
									@endcan
								</td>
								<td>{{ date('d-m-Y',strtotime($venta->fecha)) }}</td>
								<td>{{ $venta->cliente->dniRuc }} | {{ Str::upper($venta->cliente->apellido) }}, {{ Str::title($venta->cliente->nombre) }}</td>
								<td class="text-right">{{ $venta->total }}</td>
								<td>{{ $venta->estado }}</td>
								<td>
									<a href="{{route('ventas.ventas.show',['venta'=>$venta->idVenta])}}">
										<button class="mt-1 btn btn-info"><i class="fa fa-search-plus" aria-hidden="true" title="detalles"></i></button></a>
									<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="{{route('ventas.ventas.imprimir',['id'=>$venta->idVenta])}}">
										<button class="mt-1 btn btn-success" title="imprimir"><i class="fa fa-print" aria-hidden="true"></i></button></a>
									<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="" data-target="#modal-anular-{{$venta->idVenta}}" data-toggle="modal">
										<button class="mt-1 btn btn-secondary" title="anular / activar"><i class="fa fa-ban" aria-hidden="true"></i></button></a>
									<a @if (oficinaNombre() == 'Unidad Académica') hidden @endif href="" data-target="#modal-delete-{{$venta->idVenta}}" data-toggle="modal">
										<button class="mt-1 btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
								</td>
								@include('ventas.ventas.modal')
							</tr>
						@endforeach
					</tbody>
					@if(!isset($_GET['buscar']))
						<tfoot>
							<tr>
								<td colspan="7">
									{{ $ventas->links() }}
								</td>
							</tr>
						</tfoot>
					@endisset
					
				</table>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script>
		let botton = document.getElementById('btn_enviar');
		var protocolo = window.location.protocol;
		var host = window.location.hostname;
		var ruta = window.location.pathname;
		var consulta = window.location.search;
		botton.addEventListener('click',function(){
			let url = protocolo+'//'+host+'/ventas/reportes/create'+consulta;
			window.location.href = url;
		});
		let excel = document.getElementById('btn_excel');
		excel.addEventListener('click',function(){
			let url = protocolo+'//'+host+'/ventas/reportes/excel'+consulta;
			window.location.href = url;
		});	
	</script>
@stop