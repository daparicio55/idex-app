@extends('adminlte::page')
@section('title', 'Cursos Criterios')
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
{!! Form::open(['route'=>'docentes.cursos.criterios.create','method'=>'get']) !!}
<div class="row">
    <div class="col-sm-12 mt-2">
        <a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger">
            <i class="fas fa-long-arrow-alt-left"></i>
        </a>
        <input type="hidden" name="asignacione" value="{{ $asignacione->id }}">
        <button type="submit" class="btn btn-info">
            <i class="fas fa-plus-square"></i> Nuevo Criterio
        </button>
    </div>
</div>
{!! Form::close() !!}
<div class="card mt-2">
    <div class="card-header bg-primary">
        <b>Criterios del Curso:</b> {{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }}
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($criterios as $criterio)
                    <tr>
                        <td>{{ $criterio->nombre }}</td>
                        <td>{{ $criterio->descripcion }}</td>
                        <td>
                            <a href="#" class="btn btn-danger">
                                <i class="fas fa-lock"></i> Cerrar
                            </a>
                            <a href="{{ route('docentes.cursos.criterios.calificar',$criterio->id) }}" class="btn btn-info">
                                <i class="fas fa-sort-numeric-up-alt"></i> Calificar
                            </a>
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