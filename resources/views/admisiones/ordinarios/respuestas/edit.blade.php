@extends('adminlte::page')
@section('title', 'Admisiones Respuestas')
@section('content_header')
    <h1>Editar Respuestas Proceso de Admisión</h1>
    <p>{{$admisione->nombre}}</p>
@stop

@section('content')
{!! Form::model($admisione, ['route'=>['admisiones.alternativas.update',$admisione->id],'method'=>'put','autocomplete'=>'off']) !!}
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 30%">N°</th>
                    <th>Alternativa</th>
                </thead>
                <tbody>
                    @foreach ($admisione->alternativas as $alternativa)
                    <tr>
                        <td>{{$alternativa->numPregunta}} <input type="hidden" name="id[]" value="{{$alternativa->id}}"></td>
                        <td>
                            <input type="text" class="form-control" name="{{$alternativa->id}}" value="{{$alternativa->respuesta}}">
                        </td>
                    </tr>
                    @endforeach
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
                <i class="far fa-save"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('admisiones.configuraciones.index')}}">
                <i class="fas fa-undo"></i> Regresar
            </a>
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