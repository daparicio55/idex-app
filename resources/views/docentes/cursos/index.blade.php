@extends('adminlte::page')
@section('title', 'Cursos Asignados')
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
<div class="card">
    <div class="card-header bg-info">
        Cursos Asignados
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Curso</th>
                    <th>Programa de Estudios</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacione)
                    <tr>
                        <td>{{ $asignacione->periodo->nombre }}</td>
                        <td>{{ $asignacione->unidad->nombre }}</td>
                        <td>{{ $asignacione->unidad->modulo->carrera->nombreCarrera }}</td>
                        <td>
                            <!-- vamos a mostrar las capacidades -->
                            <a href="{{ route('docentes.cursos.show',$asignacione->id) }}" class="btn btn-info">
                                <i class="fas fa-sort-numeric-up-alt"></i> Capacidades
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
@stop|