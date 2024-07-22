@extends('adminlte::page')
@section('title', 'Cursos Indicadores')
@section('content')

{!! Form::open(['route'=>'docentes.cursos.capacidades.indicadores.create','method'=>'get']) !!}
<div class="row">
    <div class="col-sm-12 mt-2">
        <a href="{{ route('docentes.cursos.show',$capacidade->uasignada_id) }}" class="btn btn-danger">
            <i class="fas fa-long-arrow-alt-left"></i>
        </a>
        <input type="hidden" name="capacidade_id" value="{{ $capacidade->id }}">        
        <button type="submit" class="btn btn-info" @if(capacidad_cerrado($capacidade->uasignada->id) == true) disabled @endif>
            <i class="fas fa-plus-square"></i> Nuevo Indicador
        </button>
    </div>
</div>
{!! Form::close() !!}
<div class="card mt-2">
    <div class="card-header bg-primary">
        <b>Indicadores del la Capacidad: </b>{{ $capacidade->nombre }} <b>Curso: </b>{{ $capacidade->uasignada->unidad->nombre }} - {{ $capacidade->uasignada->unidad->modulo->carrera->nombreCarrera }}
    </div>
    @if (session('info'))
        <div class="alert alert-success mt-2" id='info'>
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-2" id='error'>
            <strong>{{session('error')}}</strong>
        </div>
    @endif
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Fecha cierre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($capacidade->indicadores as $indicadore)
                    <tr>
                        <td>{{ $indicadore->nombre }}</td>
                        <td>{{ $indicadore->descripcion }}</td>
                        <td>{{ date('d-m-Y',strtotime($indicadore->fecha)) }}</td>
                        <td>
                            {{-- <a href="#" class="btn btn-warning">
                                <i class="fas fa-lock"></i> Cerrar
                            </a> --}}
                            <button data-toggle="modal" data-target="#modal-delete-{{ $indicadore->id }}" class="btn btn-danger mt-2 @if(capacidad_cerrado($capacidade->uasignada->id) == true) disabled @endif">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                            <a href="{{ route('docentes.cursos.capacidades.indicadores.edit',$indicadore->id) }}" class="btn btn-success mt-2 @if(capacidad_cerrado($capacidade->uasignada->id) == true) disabled @endif">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('docentes.cursos.capacidades.indicadores.calificar',$indicadore->id) }}" class="btn btn-primary mt-2 @if(calificacion_cerrado($indicadore->id) == true) disabled @endif">
                                <i class="fas fa-sort-numeric-up-alt"></i> Calificaciones
                            </a>
                            @include('docentes.cursos.capacidades.indicadores.modal')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Sistema SISGE-PJ
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
    })
</script>
@stop