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
                    <th>Estructura</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacione)
                    <tr>
                        <td>{{ $asignacione->periodo->nombre }}</td>
                        <td>{{ $asignacione->unidad->nombre }}</td>
                        <td>{{ $asignacione->unidad->modulo->carrera->nombreCarrera }}</td>
                        <td>
                            <table class="table border p-0 m-0">
                                <tbody class="text-center border p-0 m-0">
                                    <tr class="border p-0 m-0">
                                        @foreach ($asignacione->capacidades as $key => $capacidade)
                                            <td class="border p-0 m-0" colspan="{{ $capacidade->indicadores()->count() }}">
                                                CA{{ $key+1 }}
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="border p-0 m-0">
                                        @foreach ($asignacione->capacidades as $key => $capacidade)
                                            @foreach ($capacidade->indicadores as $llave=>$indicadore)
                                                <td class="border p-0 m-0">
                                                    I{{ $llave+1 }}
                                                </td>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <!-- vamos a mostrar las capacidades -->
                            <a href="{{ route('docentes.cursos.show',$asignacione->id) }}" class="btn btn-info mb-1">
                                <i class="fas fa-sort-numeric-up-alt"></i> Capacidades
                            </a>
                            <a href="{{ route('docentes.cursos.imprimir',$asignacione->id) }}" class="btn btn-warning mb-1">
                                <i class="fas fa-print"></i> Acta Regular
                            </a>
                            @isset($asignacione->unidad->old->id)
                                <a href="{{ route('docentes.cursos.equivalencia',$asignacione->id) }}" class="btn btn-success mb-1">
                                    <i class="fas fa-print"></i> Equivalencias
                                </a>    
                            @endisset
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