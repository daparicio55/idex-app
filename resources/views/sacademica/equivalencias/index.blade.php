@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Equivalencias de U. Didácticas
		<a href="{{route('sacademica.equivalencias.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Equivalencia
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
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Unidad Antiguia</th>
                <th>Unidad Equivalente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidades as $key=>$unidad)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>Ciclo: {{ $unidad->ciclo }} - {{ $unidad->nombre }} - {{ $unidad->modulo->carrera->nombreCarrera }}</td>
                    <td>Ciclo: {{ $unidad->equivalencia->ciclo }} - {{ $unidad->equivalencia->nombre }} - {{ $unidad->equivalencia->modulo->carrera->nombreCarrera }}</td>
                    <td>
                        <a data-toggle="modal" data-target="#eliminar-{{ $unidad->id }}" class="btn btn-danger" title="eliminar">
                            <i class="fa fa-trash"></i>
                        </a>
                        @include('sacademica.equivalencias.modal')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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