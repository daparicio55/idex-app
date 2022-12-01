@extends('adminlte::page')
@section('title', 'Matriculas')

@section('content_header')
    <h1>Matriculas
		<a href="{{route('sacademica.matriculas.create')}}" class="btn btn-success">
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
{!! Form::open(['route'=>'sacademica.matriculas.index','method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese número de DNI a buscar..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
{!! Form::close() !!}
            <a href="{{route('sacademica.matriculas.index')}}" class="btn btn-danger">
                <i class="fas fa-recycle"></i> Limpiar
            </a>
        </span>
    </div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>DNI</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th>Telefono</th>
                    <th>WhatsApp</th>
                    <th style="width: 100px">Fecha</th>
                    <th>Periodo</th>
                </thead>
                <tbody>
                @foreach ($matriculas as $matricula)
                        <tr @if($matricula->licencia == "SI") style="text-decoration : line-through" @endif>
                            <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                            <td><strong>{{Str::upper($matricula->estudiante->postulante->cliente->apellido)}}</strong>, {{Str::title($matricula->estudiante->postulante->cliente->nombre)}}</td>
                            <td>{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td>{{ $matricula->estudiante->postulante->cliente->telefono }}</td>
                            <td>{{ $matricula->estudiante->postulante->cliente->telefono2 }}</td>
                            <td>{{ date('d-m-Y',strtotime($matricula->fecha)) }}</td>
                            <td>{{ $matricula->matricula->nombre }}</td>
                            <td style="width: 120px; text-align: center">
                                <a target="_blank" href="{{ route('sacademica.matriculas.show',['matricula'=>$matricula->id]) }}" class="btn btn-warning">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a data-target="#modal-delete-{{$matricula->id}}" data-toggle="modal" href="" class="btn btn-danger" title="eliminar matricula">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>                        
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary" data-target="#modal-licencia-{{$matricula->id}}" data-toggle="modal">
                                    Licencia
                                </a>
                            </td>
                            <td colspan="6" class="text-danger">
                                {{ $matricula->licenciaObservacion }}
                            </td>
                            <td style="text-align: center">
                                <a data-target="#modal-dlicencia-{{$matricula->id}}" data-toggle="modal" href="" class="btn btn-primary" title="eliminar licencia">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('sacademica.ematriculas.delete')
                @endforeach
                </tbody>
                <tfoot>
                    @if (!isset($searchText))
                        {{ $matriculas->links() }}
                    @endif
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