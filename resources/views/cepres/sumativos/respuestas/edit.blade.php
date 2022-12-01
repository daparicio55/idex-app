@extends('adminlte::page')
@section('title', 'Sumativo Crear')
@section('content_header')
    <h1>Editar Respuestas Sumativo</h1>
    <p>{{$sumativo->nombre}}</p>
@stop

@section('content')
{!! Form::model($sumativo, ['route'=>['cepres.sumativos.respuestas.update',$sumativo->id],'method'=>'put','autocomplete'=>'off']) !!}
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th style="width: 30%">N°</th>
                    <th>Alternativa</th>
                </thead>
                <tbody>
                    @foreach ($sumativo->alternativas as $alternativa)
                    <tr>
                        <td>{{$alternativa->pregunta}} <input type="hidden" name="id[]" value="{{$alternativa->id}}"></td>
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
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('cepres.sumativos.configuraciones.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
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