@extends('adminlte::page')
@section('title', 'Cursos | Capacidades')
@section('content')

{!! Form::open(['route'=>'docentes.cursos.capacidades.create','method'=>'get']) !!}
<div class="row">
    <div class="col-sm-12 mt-2">
        <a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger">
            <i class="fas fa-long-arrow-alt-left"></i>
        </a>
        <input type="hidden" name="asignacione" value="{{ $asignacione->id }}">
        <button type="submit" class="btn btn-info" @if($asignacione->periodo->plan_cerrado == true) disabled @endif>
            <i class="fas fa-plus-square"></i> Nueva Capacidad
        </button>
    </div>
</div>
{!! Form::close() !!}
<div class="card mt-2">
    <div class="card-header bg-primary">
        <b>Capacidades del Curso:</b> {{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }}
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
                @foreach ($capacidades as $capacidade)
                    <tr>
                        <td>{{ $capacidade->nombre }}</td>
                        <td>{{ $capacidade->descripcion }}</td>
                        <td>{{ date('d-m-Y',strtotime($capacidade->fecha)) }}</td>
                        <td>
                            <a href="#" class="btn btn-warning">
                                <i class="fas fa-lock"></i> Cerrar
                            </a>
                            <button data-toggle="modal" @if($asignacione->periodo->plan_cerrado == true) disabled @endif data-target="#modal-delete-{{ $capacidade->id }}" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                            <a href="{{ route('docentes.cursos.capacidades.edit',$capacidade->id) }}" class="btn btn-success @if($asignacione->periodo->plan_cerrado == true) disabled @endif">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('docentes.cursos.capacidades.show',$capacidade->id) }}" class="btn btn-info">
                                <i class="fas fa-sort-numeric-up-alt"></i> Indicadores
                            </a>
                            @include('docentes.cursos.capacidades.modal')
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