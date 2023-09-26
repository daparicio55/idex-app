@extends('adminlte::page')
@section('title', 'Matricula Rapida')
@section('content')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="matriculas">
					<thead>
						<tr>
                            <th>DNI</th>
                            <th>APELLIDOS, Nombres</th>
                            <th>Programa de Estudios</th>
                            <th></th>
                        </tr>
					</thead>
					<tbody>
						@foreach ($matriculas as $key=>$matricula)
                            <tr>
                                <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                                <td>{{ $matricula->estudiante->postulante->cliente->apellido }}, {{ $matricula->estudiante->postulante->cliente->nombre }}</td>
                                <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                                <td>
                                    <a class="btn btn-info">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
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

	$('#matriculas').DataTable({
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