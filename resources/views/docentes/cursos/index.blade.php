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
                            <th>HORARIO</th>
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
                                                        <td class="border p-1 m-0">
                                                            IN{{ $llave+1 }}
                                                        </td>
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="h5">
                                    <ul>
                                        @foreach ($asignacione->horarios as $horario)
                                            <li>
                                                {{ $horario->day }} {{ $horario->hinicio }} {{ $horario->hfin }}
                                            </li>   
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="min-width: 170px">
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
                                    {!! Form::open(['route'=>'docentes.asistencias.index','method'=>'get','id'=>'frm','class'=>'d-inline']) !!}
                                        <input type="hidden" name="asignacione" value="{{ $asignacione->id }}">
                                        <button type="submit" class="btn btn-warning" title="registrar asistencias">
                                            <i class="fas fa-calendar-alt"></i>
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
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