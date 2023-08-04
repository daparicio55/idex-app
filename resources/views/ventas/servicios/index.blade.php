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
{{-- <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('ventas.servicios.search')
	</div>
</div> --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="servicios">
					<thead>
						<th>ID</th>
						<th>Descripcion de Servicio</th>
						<th>Precio</th>
						<th>Días</th>
						<th></th>
					</thead>
					<tbody>
						@foreach ($servicios as $ser)
						<tr>
							<td>{{ $ser->idServicio }}</td>
							<td>{{ $ser->nombre}}</td>
							<td>{{ $ser->precio}}</td>
							<td>{{ $ser->dias}}</td>
							<td style="width: 220px; text-align: center">
								<a class="btn btn-info" href="{{ route('ventas.servicios.edit', ['servicio'=>$ser->idServicio]) }}">
									<i class="far fa-edit"></i> Editar
								</a>
								<a @if($ser->estado == 1) class="btn btn-danger" @else class="btn btn-success" @endif href="" data-target="#modal-delete-{{$ser->idServicio}}" data-toggle="modal">
									@if($ser->estado == 1)
										<i class="fas fa-eye-slash"></i> Ocultar
									@else
										<i class="fas fa-eye"></i> Visible
									@endif
									
								</a>
							</td>
						</tr>
					@include('ventas.servicios.modal')
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

	$('#servicios').DataTable({
            responsive: true,
            autoWidth: false,
            /* columnDefs: [{
                orderable: false,
                width: '100px',
                targets: [2]
            }], */
            language: {
                "decimal":        ".",
                "emptyTable":     "No hay datos disponibles en la tabla",
                "info":           "Mostrando _START_ hasta _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 hasta 0 de 0 registros",
                "infoFiltered":   "(filtrado de _MAX_ registros totales )",
                "lengthMenu":     "Mostrar _MENU_ registros por página",
                "loadingRecords": "Cargando ...",
                "search":         "Buscar:",
                "zeroRecords":    "No se encontraron registros coincidentes",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activar para ordenar columna ascendente",
                    "sortDescending": ": activar para ordenar columna descendente"
                }
            },
        });

	</script>
@stop