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
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>PERIODO</th>
                            <th>CICLO</th>
                            <th>CURSO</th>
                            <th>PROGRAMA DE ESTUDIOS</th>
                            <th>ESTRUCTURA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignaciones as $asignacione)
                            <tr>
                                <td class="h5">{{ $asignacione->periodo->nombre }}</td>
                                <td class="h5">{{ $asignacione->unidad->ciclo }}</td>
                                <td class="h5">{{ $asignacione->unidad->nombre }}</td>
                                <td class="h5">{{ $asignacione->unidad->modulo->carrera->nombreCarrera }}</td>
                                <td class="h5">
                                    <table class="table p-0 m-0">
                                        <tbody class="text-center p-0 m-0">
                                            <tr class="p-0 m-0 bg-secondary">
                                                @foreach ($asignacione->capacidades as $key => $capacidade)
                                                    <td class="border p-0 m-0" colspan="{{ $capacidade->indicadores()->count() }}">
                                                        CA{{ $key+1 }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr class="p-0 m-0">
                                                @foreach ($asignacione->capacidades as $key => $capacidade)
                                                    @foreach ($capacidade->indicadores as $llave=>$indicadore)
                                                        <td class="border p-0 m-0">
                                                            IN{{ $llave+1 }}
                                                        </td>
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="min-width: 120px">
                                    <!-- vamos a mostrar las capacidades -->
                                    {{-- <a href="{{ route('docentes.cursos.imprimir',$asignacione->id) }}" class="btn btn-warning mb-1">
                                        <i class="fas fa-print"></i> Acta Regular
                                    </a>
                                    @isset($asignacione->unidad->old->id)
                                        <a href="{{ route('docentes.cursos.equivalencia',$asignacione->id) }}" class="btn btn-success mb-1">
                                            <i class="fas fa-print"></i> Equivalencias
                                        </a>    
                                    @endisset --}}
                                    <a href="{{ route('docentes.cursos.show',$asignacione->id) }}" class="btn btn-info" title="Gestion de Calificaciones">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    {!! Form::open(['route'=>'exports.nomina2','method'=>'get','class'=>'d-inline']) !!}
                                        <input type="hidden" name="periodo_id" id="periodo_id" value="{{ $asignacione->periodo->id }}">
                                        <input type="hidden" name="udidactica_id" id="udidactica_id" value="{{ $asignacione->unidad->id }}">
                                        <input type="hidden" name="carrera" id="carrera" value="{{ $asignacione->unidad->modulo->carrera->idCarrera }}">
                                        <input type="hidden" name="ciclo" id="ciclo" value="{{ $asignacione->unidad->ciclo }}">
                                        <button type="submit" class="btn btn-danger" title="Descargar Nómina">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                           {{-- @foreach ($asignacione->capacidades as $capacidade)
                                <tr>
                                    <td colspan="3" class="mb-0 pb-0">
                                        {!! Form::model($capacidade,['route'=>['docentes.cursos.capacidades.update',$capacidade->id],'method'=>'put','id'=>'frm_datos']) !!}
                                        <span class="h5">{{ $capacidade->nombre }}</span>
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
                                    </td>
                                    <td colspan="3" class="mb-0 pb-0">
                                        @isset($capacidade->fecha)
                                        <ul class="mb-0">
                                            @foreach ($capacidade->indicadores as $indicadore)
                                                {!! Form::model($indicadore,['route'=>['docentes.cursos.capacidades.indicadores.update',$indicadore->id],'method'=>'put','id'=>'frm_datos']) !!}
                                                <li>
                                                    {{ $indicadore->nombre }}
                                                    <div class="input-group mt-2 input-group-sm">
                                                        <input type="date" class="form-control" style="max-width: 150px" name="fecha" value="{{ $indicadore->fecha }}">
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
                                                </li>
                                                {!! Form::close() !!}
                                                @if (!isset($indicadore->fecha))
                                                    @php
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </ul>    
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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