@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>
        <a href="{{ url('sacademica/mformativos') }}" title="regresar">
            <i class="far fa-arrow-alt-circle-left"></i>
        </a>
        Unidades Didacticas: {{ $modulo->nombre }}
		<a href="{{ url('sacademica/udidacticas/create/?id='.$modulo->id) }}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo
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
                    <th>Ord.</th>
                    <th>Tipo</th>
                    <th>Unidad Didactica</th>
                    <th>Horas</th>
                    <th>Creditos</th>
                    <th>Ciclo</th>
                    <th>Moodle</th>
                </thead>
                @foreach ($unidades as $unidad)
                    <tr>
                        <td>{{ $unidad->orden }}</td>
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->horas }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        <td>{{ $unidad->ciclo }}</td>
                        <td>{{ $unidad->moodle }}</td>
                        <td style="width: 160px; text-align: center">
                            <a class="btn btn-success" title="editar unidad didactica" href="{{ route('sacademica.udidacticas.edit',$unidad->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" href="" data-target="#modal-delete-{{$unidad->id}}" data-toggle="modal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        @include('sacademica.udidacticas.modal')
                    </tr>
                @endforeach
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