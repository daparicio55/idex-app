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
        <h4><a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger mr-2" title="Regresar"><i class="fas fa-backward"></i></a>{{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }}</h4>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                @foreach ($asignacione->capacidades as $key=>$capacidade)
                    <tr>
                        <td class="mb-0 pb-0">
                            {!! Form::model($capacidade,['route'=>['docentes.cursos.capacidades.update',$capacidade->id],'method'=>'put','id'=>'frm_datos']) !!}
                            <span class="h5">{{ $capacidade->nombre }}</span>
                            <small class="d-block">{{ $capacidade->descripcion }}</small>
                            <div class="input-group input-group-sm mt-3">
                                <input type="date" class="form-control"  name="fecha" value="{{ $capacidade->fecha }}" style="max-width: 150px">
                                <div class="input-group-append">
                                <button class="btn btn-outline-info" type="submit">
                                    <i class="fas fa-save"></i>
                                </button>
                                </div>
                            </div>
                            @error('fecha')
                                <small class="text-danger pt-2">{{ $message }}</small>
                            @enderror
                            {!! Form::close() !!}

                            @isset($capacidade->fecha)
                            <ul class="mb-0">
                                @isset($capacidade->fecha)
                                    @foreach ($capacidade->indicadores as $indicadore)
                                        <li>{{ $indicadore->nombre }}: <small> {{ $indicadore->descripcion }}</small></li>
                                        {!! Form::model($indicadore,['route'=>['docentes.cursos.capacidades.indicadores.update',$indicadore->id],'method'=>'put','id'=>'frm_datos']) !!}
                                        <div class="input-group mt-2 input-group-sm">
                                            <input type="date" class="form-control" required style="max-width: 150px" name="fecha" value="{{ $indicadore->fecha }}">
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-info" type="submit">
                                                <i class="fas fa-save"></i>
                                            </button>
                                            @isset($indicadore->fecha)
                                                <a href="{{ route('docentes.cursos.capacidades.indicadores.calificar',$indicadore->id) }}" class="btn btn-primary ml-2 @if(calificacion_cerrado($indicadore->id) == true) disabled @endif">
                                                    <i class="fas fa-sort-numeric-up-alt"></i> Calificaciones {{ calificacion_cerrado($indicadore->id) }}
                                                </a>
                                            @endisset
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    @endforeach
                                @endisset
                            </ul>    
                            @endisset



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('docentes.cursos.imprimir',$asignacione->id) }}" class="btn btn-warning mb-1">
            <i class="fas fa-print"></i> Acta Regular
        </a>
        @isset($asignacione->unidad->old->id)
            <a href="{{ route('docentes.cursos.equivalencia',$asignacione->id) }}" class="btn btn-success mb-1">
                <i class="fas fa-print"></i> Equivalencias
            </a>    
        @endisset
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