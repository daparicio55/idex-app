@extends('adminlte::page')
@section('title', 'Oficinas')

@section('content_header')
    <h1>Lista de Oficinas
		<a href="{{route('accesos.oficinas.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nueva Oficina
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
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre Oficina</th>
				</thead>
				<tbody>
				@foreach ($oficinas as $oficina)
					<tr>
                        <td>{{$oficina->nombre}}</td>
						<td style="width: 125px; text-align: center">
							<a title="editar oficina" class="btn btn-info" href="{{route('accesos.oficinas.edit',['oficina'=>$oficina->idOficina])}}">
								<i class="far fa-edit"></i>
							</a>
							<a title="eliminar oficina" href="" data-target="#modal-delete-{{$oficina->idOficina}}" data-toggle="modal"><button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
						</td>
					</tr>
					@include('accesos.oficinas.modal')
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