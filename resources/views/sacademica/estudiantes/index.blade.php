@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Lista de Estudiantes
		<a href="{{route('sacademica.estudiantes.create')}}" class="btn btn-success">
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
@include('sacademica.estudiantes.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Programa de Estudios</th>
                    <th>Promoción</th>             
                </thead>
                <tbody>
                    @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->postulante->cliente->dniRuc }}</td>
                        <td><strong class="text-uppercase">{{$estudiante->postulante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($estudiante->postulante->cliente->nombre)}}</span> </td>
                        <td> {{$estudiante->postulante->carrera->nombreCarrera}} </td>
                        <td> {{$estudiante->postulante->admisione->periodo}}</td>
                        @include('sacademica.estudiantes.modal')
                    </tr> 
                    <tr>
                        <td colspan="4">
                            <a class="btn btn-info" target="_blank" href="{{route('admisiones.postulantes.show',['postulante'=>$estudiante->postulante->id])}}">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{route('admisiones.postulantes.edit',['postulante'=>$estudiante->postulante->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            {{-- aca verificamos si ya tiene matricula --}}
                            @if (veriManual($estudiante->id,'I') == false)
                                <a class="btn btn-dark" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":I"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - I</i>
                                </a>
                            @endif
                            @if (veriManual($estudiante->id,'II') == false)
                                <a class="btn btn-warning" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":II"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - II</i>
                                </a>
                            @endif
                            @if (veriManual($estudiante->id,'III') == false)
                                <a class="btn btn-dark" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":III"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - III</i>
                                </a>
                            @endif
                            @if (veriManual($estudiante->id,'IV') == false)
                                <a class="btn btn-warning" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":IV"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - IV</i>
                                </a>
                            @endif
                            @if (veriManual($estudiante->id,'V') == false)
                                <a class="btn btn-dark" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":V"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - V</i>
                                </a>
                            @endif
                            @if (veriManual($estudiante->id,'VI') == false)
                                <a class="btn btn-warning" href="{{ route('sacademica.estudiantes.show',['estudiante'=>$estudiante->id.":VI"]) }}">
                                    <i class="fas fa-spell-check" aria-hidden="true"> - VI</i>
                                </a>
                            @endif
                            <a class="btn btn-danger" data-target="#modal-delete-{{$estudiante->id}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <caption>
                    @if(!isset($searchText))
                        {{ $estudiantes->links() }}
                    @endif
                </caption>
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