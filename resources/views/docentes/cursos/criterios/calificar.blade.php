@extends('adminlte::page')
@section('title', 'Calificar Criterios')
@section('content_header')
<h4 class="h4">Lista de Alumnos</h4>
@stop
@section('content')
{!! Form::open(['route'=>['docentes.cursos.criterios.calificarstore',$criterio->id],'method'=>'post']) !!}
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Tipo</th>
                    <th>Observacion</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $key=>$estudiante)
                    <tr>
                        <td>
                            <input type="hidden" name="ematricula_detalle_id[]" value="{{ $estudiante->id }}">
                            {{ $key+1 }}
                        </td>
                        <td>                            
                            <span class="text-uppercase">{{ $estudiante->apellido }}, </span><span class="text-capitalize">{{ strtolower($estudiante->nombre) }}</span>
                        </td>
                        <td>
                            <input type="hidden" name="tipo[]" value="{{ $estudiante->tipo }}">
                            {{ $estudiante->tipo }}
                        </td>
                        <td>{{ $estudiante->observacion }}</td>
                        <td>
                            <input type="number" @if($estudiante->tipo == "Convalidacion") readonly @endif value="{{ notacriterio($criterio->id,$estudiante->id) }}" max=20 min=0 step=1 name="notas[]" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-success"> 
            <i class="far fa-save"></i> Guardar
        </button>
    </div>
</div>
{!! Form::close() !!}
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