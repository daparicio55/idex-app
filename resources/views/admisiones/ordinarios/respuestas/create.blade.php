@extends('adminlte::page')
@section('title', 'Admision')
@section('content_header')
    <h1>Registrar Respuestas Proceso de Admisión</h1>
    <p>{{$admisione->nombre}}</p>
@stop

@section('content')
{!! Form::open(['name'=>'frm_datos','route'=>'admisiones.alternativas.store','method'=>'POST','autocomplete'=>'off']) !!}
<input type="hidden" name="admisione_id" value="{{$admisione->id}}">
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 30%">N°</th>
                    <th>Alternativa</th>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= $admisione->preguntas; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                <input name="pregunta[]" type="text" class="form-control" required>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- botones --}}
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
        <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" id='bt_guardar' name='bt_guardar'>
                <i class="far fa-save"></i></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('admisiones.configuraciones.index')}}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
</script>
@stop