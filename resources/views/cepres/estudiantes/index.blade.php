@extends('adminlte::page')
@section('title', 'Cepre')

@section('content_header')
    <h1>Lista de Estudiantes Cepre
		<a href="{{route('cepres.estudiantes.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Estudiante
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
@include('cepres.estudiantes.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Telefono</th>
                    <th>Programa de Estudios</th>
                    <th>Fecha</th>
                    <th>Periodo</th>
                    <th>Aula</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($cepreEstudiantes as $cepreEstudiante)
                    <tr>
                        <td>{{$cepreEstudiante->cliente->dniRuc}}</td>
                        <td><strong class="text-uppercase">{{$cepreEstudiante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($cepreEstudiante->cliente->nombre)}}</span></td>
                        <td>{{$cepreEstudiante->cliente->telefono}}</td>
                        <td>{{$cepreEstudiante->carrera->nombreCarrera}}</td>
                        <td>{{ date('d/m/Y',strtotime($cepreEstudiante->ceEsFecha)) }}</td>
                        <td>{{ $cepreEstudiante->cepre->periodoCepre }}</td>
                        <td>{{ $cepreEstudiante->aula }}</td>
                        <td style="text-align: center; width: 210px">
                            <a href="{{ route('cepres.estudiantes.asistencias.show',$cepreEstudiante->idCepreEstudiante) }}" class="btn btn-secondary">
                                <i class="far fa-calendar-alt"></i>
                            </a>
                            <a class="btn btn-info" target="_blank" href="{{route('cepres.estudiantes.show',['estudiante'=>$cepreEstudiante->idCepreEstudiante])}}">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{route('cepres.estudiantes.edit',['estudiante'=>$cepreEstudiante->idCepreEstudiante])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" data-target="#modal-delete-{{$cepreEstudiante->idCepreEstudiante}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                        @include('cepres.estudiantes.modal')
                    </tr> 
                    @endforeach
                </tbody>
                @if(!isset($_GET['searchText']))
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {{ $cepreEstudiantes->links() }}
                            </td>
                        </tr>
                    </tfoot>    
                @endif
                
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